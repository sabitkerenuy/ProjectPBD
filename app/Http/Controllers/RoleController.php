<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // Daftar role
    public function index()
    {
        $role = DB::select('SELECT * FROM V_ROLE');

        return view('role.index', compact('role'));
    }

    // Form tambah
    public function create()
    {
        return view('role.create');
    }

    // Simpan role baru -> SP tambahRole
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
        ], [
            'nama.required' => 'Nama role wajib diisi.',
        ]);

        // tambahRole(p_nama)
        DB::statement('CALL tambahRole(?)', [
            $validated['nama'],
        ]);

        return redirect()->route('role.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    // Form ubah
    public function edit($id)
    {
        $hasil = DB::select('SELECT * FROM V_ROLE WHERE NO = ?', [$id]);

        if (count($hasil) == 0) {
            abort(404);
        }

        $r = $hasil[0];

        return view('role.edit', compact('r'));
    }

    // Simpan perubahan -> SP updateRole
    public function update(Request $request, $id)
    {
        $hasil = DB::select('SELECT * FROM V_ROLE WHERE NO = ?', [$id]);

        if (count($hasil) == 0) {
            abort(404);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
        ], [
            'nama.required' => 'Nama role wajib diisi.',
        ]);

        // updateRole(p_idrole, p_nama)
        DB::statement('CALL updateRole(?, ?)', [
            $id,
            $validated['nama'],
        ]);

        return redirect()->route('role.index')
            ->with('success', 'Role berhasil diperbarui.');
    }
}
