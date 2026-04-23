<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori_id = $request->input('kategori_id');

        $query = Buku::with('kategori');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($kategori_id) {
            $query->where('kategori_id', $kategori_id);
        }

        $bukus = $query->latest()->get();
        $kategoris = Kategori::all();
        
        return view('bukus.index', compact('bukus', 'kategoris', 'search', 'kategori_id'));
    }

    public function show($id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);
        // Load relationships like peminjaman count or history if necessary
        return view('bukus.show', compact('buku'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('bukus.tambah', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'tahun_terbit' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
            'rak' => 'nullable|string|max:50',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            $imagePath = $request->file('cover')->store('covers', 'public');
            $validatedData['cover'] = $imagePath;
        }

        Buku::create($validatedData);

        return redirect('/buku')->with('success', 'Data buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        return view('bukus.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'tahun_terbit' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
            'rak' => 'nullable|string|max:50',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            // Delete old cover if exists
            if ($buku->cover && \Storage::disk('public')->exists($buku->cover)) {
                \Storage::disk('public')->delete($buku->cover);
            }
            
            $imagePath = $request->file('cover')->store('covers', 'public');
            $validatedData['cover'] = $imagePath;
        }

        $buku->update($validatedData);

        return redirect('/buku')->with('success', 'Data buku berhasil diupdate!');
    }

    public function destroy($id)
    {
        Buku::findOrFail($id)->delete();
        return redirect('/buku')->with('success', 'Data buku berhasil dihapus!');
    }
}
