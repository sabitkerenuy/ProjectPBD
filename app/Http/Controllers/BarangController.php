<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = DB::select('SELECT * FROM V_STOK_BARANG ORDER BY NO ASC');

        return view('barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $satuan   = DB::select('SELECT * FROM V_AKTIF_SATUAN');

        return view('barang.create', compact('satuan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:45',
            'kategori' => 'required|in:N,S,K,B,C',
            'harga'    => 'required|integer|min:0',
            'satuan'   => 'required|exists:satuan,idsatuan',
        ], [
            'nama.required'     => 'Nama merchandise wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'harga.required'    => 'Harga wajib diisi.',
            'harga.integer'     => 'Harga harus berupa angka bulat.',
            'satuan.required'   => 'Satuan wajib dipilih.',
        ]);

        DB::select(
            'INSERT INTO barang (jenis, nama, status, harga, idsatuan) VALUES (?, ?, 1, ?, ?)',
            [
                $validated['kategori'],
                $validated['nama'],
                $validated['harga'],
                $validated['satuan'],
            ]
        );

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
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
        $hasil = DB::select('SELECT * FROM V_BARANG WHERE NO = ?', [$id]);

        if (count($hasil) == 0) {
            abort(404);
        }

        $b      = $hasil[0];
        $satuan = DB::select('SELECT * FROM V_AKTIF_SATUAN');

        return view('barang.edit', compact('b', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hasil = DB::select('SELECT * FROM V_BARANG WHERE NO = ?', [$id]);

        if (count($hasil) == 0) {
            abort(404);
        }

        $validated = $request->validate([
            'nama'     => 'required|string|max:45',
            'kategori' => 'required|in:N,S,K,B,C',
            'harga'    => 'required|integer|min:0',
            'satuan'   => 'required|exists:satuan,idsatuan',
            'status'   => 'required|in:0,1',
        ], [
            'nama.required'     => 'Nama merchandise wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'harga.required'    => 'Harga wajib diisi.',
            'harga.integer'     => 'Harga harus berupa angka bulat.',
            'satuan.required'   => 'Satuan wajib dipilih.',
        ]);


        DB::select(
            'UPDATE barang
             SET jenis = ?, nama = ?, harga = ?, idsatuan = ?, status = ?
             WHERE idbarang = ?',
            [
                $validated['kategori'],
                $validated['nama'],
                $validated['harga'],
                $validated['satuan'],
                $validated['status'],
                $id,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hasil = DB::select('SELECT * FROM V_BARANG WHERE NO = ?', [$id]);

        if (count($hasil) == 0) {
            abort(404);
        }

        // "hapus" = nonaktifkan, baris tidak dihapus supaya riwayat transaksi aman
        DB::select('UPDATE barang SET status = 0 WHERE idbarang = ?', [$id]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dinonaktifkan.');
    }
}
