<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Siswa;
use App\Models\Buku;
use App\Models\Setting;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); // 'dipinjam' or 'dikembalikan'
        $terlambatOnly = $request->has('terlambat');
        
        $query = Peminjaman::with(['siswa', 'buku', 'user']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('siswa', function ($sq) use ($search) {
                    $sq->where('nama', 'like', "%{$search}%");
                })->orWhereHas('buku', function ($bq) use ($search) {
                    $bq->where('judul', 'like', "%{$search}%");
                });
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($terlambatOnly) {
            $query->where('status', 'dipinjam')
                  ->where('batas_pengembalian', '<', now()->format('Y-m-d'));
        }
        
        $peminjamans = $query->latest()->get();

        $dendaHarian = (int) Setting::where('key', 'denda_harian')->value('value') ?? 5000;
        
        // Calculate current state for each record
        $today = \Carbon\Carbon::today();
        foreach ($peminjamans as $p) {
            $p->hari_terlambat = 0;
            $p->estimasi_denda = 0;

            if ($p->batas_pengembalian) {
                $batas = \Carbon\Carbon::parse($p->batas_pengembalian)->startOfDay();

                if ($p->status === 'dipinjam') {
                    if ($today->gt($batas)) {
                        $p->hari_terlambat = abs($batas->diffInDays($today));
                    }
                } elseif ($p->status === 'dikembalikan' && $p->tanggal_kembali) {
                    $kembali = \Carbon\Carbon::parse($p->tanggal_kembali)->startOfDay();
                    if ($kembali->gt($batas)) {
                        $p->hari_terlambat = abs($batas->diffInDays($kembali));
                    }
                }
            }

            if ($p->status === 'dikembalikan') {
                $p->estimasi_denda = $p->denda;
            } else {
                $p->estimasi_denda = $p->hari_terlambat * $dendaHarian;
            }
        }

        $totalTerlambat = $peminjamans->filter(fn($p) => $p->hari_terlambat > 0 && $p->status === 'dipinjam')->count();
        $totalDenda = $peminjamans->where('is_paid', false)->sum('estimasi_denda');
            
        return view('peminjamans.index', compact('peminjamans', 'search', 'totalTerlambat', 'totalDenda', 'status'));
    }

    public function create()
    {
        $siswas = Siswa::all();
        $bukus = Buku::where('stok', '>', 0)->get(); 
        return view('peminjamans.tambah', compact('siswas', 'bukus'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'batas_pengembalian' => 'nullable|date',
            'status' => 'required|in:dipinjam,dikembalikan',
        ]);

        if (empty($validatedData['batas_pengembalian'])) {
            $validatedData['batas_pengembalian'] = date('Y-m-d', strtotime($validatedData['tanggal_pinjam'] . ' + 7 days'));
        }

        $validatedData['user_id'] = auth()->id() ?? 1; 

        $buku = Buku::findOrFail($validatedData['buku_id']);
        if ($buku->stok < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        if ($validatedData['status'] == 'dipinjam') {
            $buku->decrement('stok');
        }

        Peminjaman::create($validatedData);

        return redirect('/peminjaman')->with('success', 'Data peminjaman berhasil ditambahkan!');
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        if ($peminjaman->status == 'dipinjam') {
            $peminjaman->status = 'dikembalikan';
            $peminjaman->tanggal_kembali = now()->format('Y-m-d');
            
            // Re-calculate fine if not paid
            if (!$peminjaman->is_paid) {
                $denda = 0;
                if ($peminjaman->batas_pengembalian) {
                    $batas = \Carbon\Carbon::parse($peminjaman->batas_pengembalian)->startOfDay();
                    $kembali = \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->startOfDay();
                    
                    if ($kembali->greaterThan($batas)) {
                        $selisih = abs($kembali->diffInDays($batas));
                        $dendaHarian = (int) Setting::where('key', 'denda_harian')->value('value') ?? 5000;
                        $denda = $selisih * $dendaHarian;
                    }
                }
                $peminjaman->denda = $denda;
                $peminjaman->is_paid = $denda > 0 ? false : true;
            }
            
            $peminjaman->buku->increment('stok');
            $peminjaman->save();
            
            $pesan = 'Buku berhasil dikembalikan.';
            if ($peminjaman->denda > 0 && !$peminjaman->is_paid) {
                $pesan .= ' Silakan lakukan pembayaran denda.';
            }
            
            return redirect('/peminjaman')->with('success', $pesan);
        }
        
        return redirect('/peminjaman')->with('error', 'Buku sudah dikembalikan sebelumnya.');
    }

    public function payFine($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // If paid before returned, save the current estimasi as denda
        if ($peminjaman->status === 'dipinjam') {
            $today = \Carbon\Carbon::today();
            $batas = \Carbon\Carbon::parse($peminjaman->batas_pengembalian)->startOfDay();
            if ($today->gt($batas)) {
                $selisih = abs($batas->diffInDays($today));
                $dendaHarian = (int) Setting::where('key', 'denda_harian')->value('value') ?? 5000;
                $peminjaman->denda = $selisih * $dendaHarian;
            }
        }

        $peminjaman->is_paid = true;
        $peminjaman->save();

        return redirect('/peminjaman')->with('success', 'Denda berhasil dibayar.');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $siswas = Siswa::all();
        $bukus = Buku::all(); 
        return view('peminjamans.edit', compact('peminjaman', 'siswas', 'bukus'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'batas_pengembalian' => 'nullable|date',
            'tanggal_kembali' => 'nullable|date',
            'denda' => 'nullable|integer|min:0',
            'status' => 'required|in:dipinjam,dikembalikan',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        
        // Auto-set status to 'dikembalikan' if tanggal_kembali is filled
        if (!empty($validatedData['tanggal_kembali']) && $validatedData['status'] == 'dipinjam') {
            $validatedData['status'] = 'dikembalikan';
        }

        // Logic for stock and fine calculation
        if ($peminjaman->status == 'dipinjam' && $validatedData['status'] == 'dikembalikan') {
            $peminjaman->buku->increment('stok');
            
            if (empty($validatedData['tanggal_kembali'])) {
                $validatedData['tanggal_kembali'] = now()->format('Y-m-d');
            }

            if (!isset($request->denda) || $request->denda === null || $request->denda === '') {
                $batas = $validatedData['batas_pengembalian'] ?? $peminjaman->batas_pengembalian;
                if ($batas) {
                    $batasDate = \Carbon\Carbon::parse($batas)->startOfDay();
                    $kembaliDate = \Carbon\Carbon::parse($validatedData['tanggal_kembali'])->startOfDay();
                    
                    if ($kembaliDate->greaterThan($batasDate)) {
                        $dendaHarian = (int) Setting::where('key', 'denda_harian')->value('value') ?? 5000;
                        $validatedData['denda'] = abs($kembaliDate->diffInDays($batasDate)) * $dendaHarian;
                        $validatedData['is_paid'] = false;
                    } else {
                        $validatedData['denda'] = 0;
                        $validatedData['is_paid'] = true;
                    }
                }
            }
        } elseif ($peminjaman->status == 'dikembalikan' && $validatedData['status'] == 'dipinjam') {
            $peminjaman->buku->decrement('stok');
            $validatedData['tanggal_kembali'] = null;
            $validatedData['denda'] = 0;
        }

        $peminjaman->update($validatedData);

        return redirect('/peminjaman')->with('success', 'Data peminjaman berhasil diupdate!');
    }

    public function destroy($id)
    {
        Peminjaman::findOrFail($id)->delete();
        return redirect('/peminjaman')->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
