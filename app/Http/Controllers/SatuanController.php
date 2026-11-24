<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class SatuanController extends Controller
    {
    /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $satuanasli = DB::select('SELECT * FROM V_SATUAN');

            return view('satuan.index', compact('satuanasli'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('satuan.create');
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $validated = $request->validate([
                'nama'     => 'required|string|max:45',
            ], [
                'nama.required'     => 'Nama satuan wajib diisi.',
            ]);

            // tambahBarang(p_jenis, p_nama, p_harga, p_idsatuan)
            DB::statement('CALL tambahSatuan(?)', [
                $validated['nama'],
            ]);

            return redirect()->route('satuan.index')
                ->with('success', 'Satuan berhasil ditambahkan.');
        }

        /**
         * Display the specified resource.
         */
        public function show(string $id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
            $hasil = DB::select('SELECT * FROM V_SATUAN WHERE NO = ?', [$id]);

            if (count($hasil) == 0) {
                abort(404);
            }

            $s      = $hasil[0];

            return view('satuan.edit', compact('s'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {
            $hasil = DB::select('SELECT * FROM V_SATUAN WHERE NO = ?', [$id]);

            if (count($hasil) == 0) {
                abort(404);
            }

            $validated = $request->validate([
                'nama'     => 'required|string|max:45',
                'status'   => 'required|in:0,1',
            ], [
                'nama.required'     => 'Nama satuan wajib diisi.',
            ]);

            // updateBarang(p_idbarang, p_jenis, p_nama, p_harga, p_idsatuan)
            DB::statement('CALL updateSatuan(?, ?)', [
                $id,
                $validated['nama'],
            ]);

            // statusBarang(p_idbarang, p_status)
            DB::statement('CALL statusSatuan(?, ?)', [$id, $validated['status']]);

            return redirect()->route('satuan.index')
                ->with('success', 'Satuan berhasil diperbarui.');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            $hasil = DB::select('SELECT * FROM V_SATUAN WHERE NO = ?', [$id]);

            if (count($hasil) == 0) {
                abort(404);
            }

            DB::statement('CALL statusSatuan(?, ?)', [$id, 0]);

            return redirect()->route('satuan.index')
                ->with('success', 'Satuan berhasil dinonaktifkan.');
        }
    }
