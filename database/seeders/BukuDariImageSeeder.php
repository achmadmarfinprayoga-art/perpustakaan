<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;
use App\Models\Kategori;

class BukuDariImageSeeder extends Seeder
{
    public function run()
    {
        // Ensure storage directory exists
        if (!\Storage::disk('public')->exists('images')) {
            \Storage::disk('public')->makeDirectory('images');
        }

        $kategoriSelfImprovement = Kategori::firstOrCreate(
            ['nama_kategori' => 'Self Improvement'],
            ['keterangan' => 'Buku pengembangan diri']
        );
        
        $kategoriNovel = Kategori::firstOrCreate(
            ['nama_kategori' => 'Novel & Sastra'],
            ['keterangan' => 'Buku fiksi dan sastra']
        );

        $kategoriFiksi = Kategori::firstOrCreate(
            ['nama_kategori' => 'Fiksi Remaja'],
            ['keterangan' => 'Fiksi remaja populer']
        );

        $books = [
            [
                'judul' => 'Ancika: Dia yang Bersamaku Tahun 1995',
                'penulis' => 'Pidi Baiq',
                'penerbit' => 'Pastel Books',
                'tahun_terbit' => '2021',
                'stok' => 15,
                'cover' => 'images/ancika.jpg',
                'kategori_id' => $kategoriFiksi->id,
                'rak' => 'Rak A-01'
            ],
            [
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2019',
                'stok' => 30,
                'cover' => 'images/atomic habits2.jpg',
                'kategori_id' => $kategoriSelfImprovement->id,
                'rak' => 'Rak B-01'
            ],
            [
                'judul' => 'Berani Tidak Disukai',
                'penulis' => 'Ichiro Kishimi, Fumitake Koga',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2019',
                'stok' => 20,
                'cover' => 'images/berani tidak disukai.jpg',
                'kategori_id' => $kategoriSelfImprovement->id,
                'rak' => 'Rak B-02'
            ],
            [
                'judul' => 'Bicara Itu Ada Seninya',
                'penulis' => 'Oh Su Hyang',
                'penerbit' => 'Bhuana Ilmu Populer',
                'tahun_terbit' => '2018',
                'stok' => 25,
                'cover' => 'images/bicara itu ada seninya.jpg',
                'kategori_id' => $kategoriSelfImprovement->id,
                'rak' => 'Rak B-03'
            ],
            [
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Lentera Dipantara',
                'tahun_terbit' => '2005',
                'stok' => 10,
                'cover' => 'images/bumi manusia.jpg',
                'kategori_id' => $kategoriNovel->id,
                'rak' => 'Rak C-01'
            ],
            [
                'judul' => 'Bumi',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2014',
                'stok' => 18,
                'cover' => 'images/bumi.jpg',
                'kategori_id' => $kategoriNovel->id,
                'rak' => 'Rak C-02'
            ],
            [
                'judul' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas Penerbit',
                'tahun_terbit' => '2018',
                'stok' => 22,
                'cover' => 'images/filosofi teras.jpg',
                'kategori_id' => $kategoriSelfImprovement->id,
                'rak' => 'Rak B-04'
            ],
            [
                'judul' => 'Gadis Kretek',
                'penulis' => 'Ratih Kumala',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2012',
                'stok' => 12,
                'cover' => 'images/gadis kretek.jpg',
                'kategori_id' => $kategoriNovel->id,
                'rak' => 'Rak C-03'
            ],
            [
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => '2005',
                'stok' => 28,
                'cover' => 'images/lasakar pelagi.jpg',
                'kategori_id' => $kategoriNovel->id,
                'rak' => 'Rak C-04'
            ],
            [
                'judul' => 'Laut Bercerita',
                'penulis' => 'Leila S. Chudori',
                'penerbit' => 'Kepustakaan Populer Gramedia',
                'tahun_terbit' => '2017',
                'stok' => 24,
                'cover' => 'images/laut bercerta.jpg',
                'kategori_id' => $kategoriNovel->id,
                'rak' => 'Rak C-05'
            ],
            [
                'judul' => 'Sebuah Seni untuk Bersikap Bodo Amat',
                'penulis' => 'Mark Manson',
                'penerbit' => 'Grasindo',
                'tahun_terbit' => '2018',
                'stok' => 35,
                'cover' => 'images/seni bersikap bodo amat.jpg',
                'kategori_id' => $kategoriSelfImprovement->id,
                'rak' => 'Rak B-05'
            ],
            [
                'judul' => 'The Psychology of Money',
                'penulis' => 'Morgan Housel',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => '2020',
                'stok' => 40,
                'cover' => 'images/the psychology of money.jpg',
                'kategori_id' => $kategoriSelfImprovement->id,
                'rak' => 'Rak B-06'
            ],
            [
                'judul' => 'Bungkam Suara',
                'penulis' => 'J.S. Khairen',
                'penerbit' => 'Grasindo',
                'tahun_terbit' => '2021',
                'stok' => 12,
                'cover' => 'images/bungkam suara.jpg',
                'kategori_id' => $kategoriNovel->id,
                'rak' => 'Rak C-06'
            ],
            [
                'judul' => 'Cantik Itu Luka',
                'penulis' => 'Eka Kurniawan',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2002',
                'stok' => 8,
                'cover' => 'images/cantik itu luka.jpg',
                'kategori_id' => $kategoriNovel->id,
                'rak' => 'Rak C-07'
            ],
            [
                'judul' => 'Dilan 1990',
                'penulis' => 'Pidi Baiq',
                'penerbit' => 'Pastel Books',
                'tahun_terbit' => '2014',
                'stok' => 20,
                'cover' => 'images/dilan 1990.jpg',
                'kategori_id' => $kategoriFiksi->id,
                'rak' => 'Rak A-02'
            ],
            [
                'judul' => 'Dompet Ayah Sepatu Ibu',
                'penulis' => 'J.S. Khairen',
                'penerbit' => 'Grasindo',
                'tahun_terbit' => '2023',
                'stok' => 15,
                'cover' => 'images/dompet ayah sepatu ibu.jpg',
                'kategori_id' => $kategoriNovel->id,
                'rak' => 'Rak C-08'
            ],
            [
                'judul' => 'Madilog',
                'penulis' => 'Tan Malaka',
                'penerbit' => 'Narasi',
                'tahun_terbit' => '1943',
                'stok' => 10,
                'cover' => 'images/madilok.jpg',
                'kategori_id' => $kategoriSelfImprovement->id,
                'rak' => 'Rak B-07'
            ],
            [
                'judul' => 'Negeri 5 Menara',
                'penulis' => 'Ahmad Fuadi',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2009',
                'stok' => 14,
                'cover' => 'images/negeri 5 menara.jpg',
                'kategori_id' => $kategoriNovel->id,
                'rak' => 'Rak C-09'
            ],
            [
                'judul' => 'Negeri Para Bedebah',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2012',
                'stok' => 16,
                'cover' => 'images/nereri para bedebah.jpg',
                'kategori_id' => $kategoriNovel->id,
                'rak' => 'Rak C-10'
            ],
            [
                'judul' => 'Seporsi Mie Ayam Sebelum Mati',
                'penulis' => 'Brian Khrisna',
                'penerbit' => 'MediaKita',
                'tahun_terbit' => '2022',
                'stok' => 10,
                'cover' => 'images/seporsi mie ayam sebelum mati.jpg',
                'kategori_id' => $kategoriNovel->id,
                'rak' => 'Rak C-11'
            ],
            [
                'judul' => 'Sisi Tergelap Surga',
                'penulis' => 'Brian Khrisna',
                'penerbit' => 'MediaKita',
                'tahun_terbit' => '2021',
                'stok' => 12,
                'cover' => 'images/sisi tergelap surga.jpg',
                'kategori_id' => $kategoriNovel->id,
                'rak' => 'Rak C-12'
            ],
        ];

        foreach ($books as $book) {
            // Copy image from public/images to storage/app/public/images
            $sourcePath = public_path($book['cover']);
            $destPath = 'images/' . basename($book['cover']);
            
            if (file_exists($sourcePath)) {
                if (!\Storage::disk('public')->exists($destPath)) {
                    \Storage::disk('public')->put($destPath, file_get_contents($sourcePath));
                }
            }

            Buku::updateOrCreate(
                ['judul' => $book['judul']],
                $book
            );
        }
    }
}
