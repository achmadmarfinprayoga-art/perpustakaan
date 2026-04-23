<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kelas = $request->input('kelas');

        $query = Siswa::withSum(['peminjamans' => function ($query) {
            $query->where('is_paid', false);
        }], 'denda');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        if ($kelas) {
            $query->where('kelas', $kelas);
        }

        $siswas = $query->latest()->get();
        return view('siswas.index', compact('siswas', 'search', 'kelas'));
    }

    public function create()
    {
        return view('siswas.tambah');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis',
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
        ]);

        Siswa::create($validatedData);

        return redirect('/siswa')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswas.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis,' . $id,
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
        ]);

        Siswa::findOrFail($id)->update($validatedData);

        return redirect('/siswa')->with('success', 'Data siswa berhasil diupdate!');
    }

    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();
        return redirect('/siswa')->with('success', 'Data siswa berhasil dihapus!');
    }
}
