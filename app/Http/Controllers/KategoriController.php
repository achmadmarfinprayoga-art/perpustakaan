<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->get();
        return view('kategoris.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategoris.tambah');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Kategori::create($validatedData);

        return redirect('/kategori')->with('success', 'Data kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategoris.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Kategori::findOrFail($id)->update($validatedData);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diupdate!');
    }

    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();
        return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus!');
    }
}
