<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
   /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $vendor = DB::select('SELECT * FROM V_VENDOR');

            return view('vendor.index', compact('vendor'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('vendor.create');
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $validated = $request->validate([
                'nama'     => 'required|string|max:45',
            ], [
                'nama.required'     => 'Nama vendor wajib diisi.',
            ]);

            // tambahBarang(p_jenis, p_nama, p_harga, p_idsatuan)
            DB::statement('CALL tambahVendor(?)', [
                $validated['nama'],
            ]);

            return redirect()->route('vendor.index')
                ->with('success', 'Vendor berhasil ditambahkan.');
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
            $hasil = DB::select('SELECT * FROM V_VENDOR WHERE NO = ?', [$id]);

            if (count($hasil) == 0) {
                abort(404);
            }

            $v      = $hasil[0];

            return view('vendor.edit', compact('v'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {
            $hasil = DB::select('SELECT * FROM V_VENDOR WHERE NO = ?', [$id]);

            if (count($hasil) == 0) {
                abort(404);
            }

            $validated = $request->validate([
                'nama'     => 'required|string|max:45',
                'status'   => 'required|in:A,N',
            ], [
                'nama.required'     => 'Nama vendor wajib diisi.',
            ]);

            // updateBarang(p_idbarang, p_jenis, p_nama, p_harga, p_idsatuan)
            DB::statement('CALL updateVendor(?, ?)', [
                $id,
                $validated['nama'],
            ]);

            // statusBarang(p_idbarang, p_status)
            DB::statement('CALL statusVendor(?, ?)', [$id, $validated['status']]);

            return redirect()->route('vendor.index')
                ->with('success', 'Vendor berhasil diperbarui.');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            $hasil = DB::select('SELECT * FROM V_VENDOR WHERE NO = ?', [$id]);

            if (count($hasil) == 0) {
                abort(404);
            }

            DB::statement('CALL statusVendor(?, ?)', [$id, 0]);

            return redirect()->route('vendor.index')
                ->with('success', 'Vendor berhasil dinonaktifkan.');
        }
    }
