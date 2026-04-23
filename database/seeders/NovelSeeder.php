<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Buku;

class NovelSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriNovel = Kategori::firstOrCreate([
            'nama_kategori' => 'Novel'
        ], [
            'keterangan' => 'Buku fiksi bermakna panjang atau cerita rekaan.'
        ]);
        
        $novelPopuler = [
            [
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'tahun_terbit' => '1980',
                'stok' => 15,
            ],
            [
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'tahun_terbit' => '2005',
                'stok' => 20,
            ],
            [
                'judul' => 'Dilan: Dia adalah Dilanku Tahun 1990',
                'penulis' => 'Pidi Baiq',
                'tahun_terbit' => '2014',
                'stok' => 25,
            ],
            [
                'judul' => 'Ayat-Ayat Cinta',
                'penulis' => 'Habiburrahman El Shirazy',
                'tahun_terbit' => '2004',
                'stok' => 10,
            ],
            [
                'judul' => 'Negeri 5 Menara',
                'penulis' => 'A. Fuadi',
                'tahun_terbit' => '2009',
                'stok' => 12,
            ],
            [
                'judul' => 'Gadis Kretek',
                'penulis' => 'Ratih Kumala',
                'tahun_terbit' => '2012',
                'stok' => 8,
            ],
            [
                'judul' => 'Laut Bercerita',
                'penulis' => 'Leila S. Chudori',
                'tahun_terbit' => '2017',
                'stok' => 18,
            ]
        ];

        foreach ($novelPopuler as $novel) {
            $novel['kategori_id'] = $kategoriNovel->id;
            // Gunakan updateOrCreate untuk menghindari duplikasi saat di-run ulang
            Buku::updateOrCreate(
                ['judul' => $novel['judul']],
                $novel
            );
        }
    }
}
