<?php

namespace Database\Seeders;

use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DemoProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Contoh — Sistem Manajemen Konten',
                'slug' => 'contoh-sistem-manajemen-konten',
                'category' => 'Web App',
                'summary' => 'Project contoh untuk memperlihatkan bagaimana sebuah studi kasus disusun: masalah, pendekatan, keputusan teknis, dan hasil yang bisa diverifikasi.',
                'problem_statement' => "Tim konten masih memperbarui halaman melalui file dan menunggu developer untuk setiap perubahan. Proses ini lambat, rawan salah, dan tidak punya jejak revisi.\n\nProject contoh ini menggambarkan kebutuhan sebuah panel admin sederhana yang bisa dipakai orang non-teknis tanpa mengorbankan kontrol akses.",
                'solution' => "Membangun panel admin berbasis Laravel dengan autentikasi, otorisasi per peran, validasi server-side, dan pengelolaan konten yang dapat dipublikasikan atau disimpan sebagai draft.\n\nAlur kerja dibuat pendek: masuk, pilih konten, sunting, simpan, lalu publikasikan. Setiap perubahan penting dicatat agar mudah ditelusuri.",
                'description' => "Ini adalah project contoh, bukan klaim pekerjaan nyata. Kontennya sengaja disusun untuk mengisi tampilan awal dan bisa diganti sepenuhnya melalui panel admin.\n\nPendekatan yang ditunjukkan berfokus pada hal-hal yang biasanya menentukan kualitas aplikasi: struktur data yang jelas, validasi di sisi server, pemisahan tanggung jawab antar lapisan, dan antarmuka yang tidak menyulitkan pengguna.\n\nBagian ini bisa dipakai untuk menjelaskan konteks, peran, batasan, dan keputusan teknis pada project yang sesungguhnya.",
                'features' => [
                    'Autentikasi dan otorisasi admin',
                    'Pengelolaan konten dengan status draft dan published',
                    'Validasi form di sisi server',
                    'Pencarian dan filter data',
                ],
                'technologies' => ['Laravel', 'MySQL', 'Blade', 'Tailwind CSS'],
                'is_featured' => true,
                'is_placeholder' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Contoh — Company Profile Studio',
                'slug' => 'contoh-company-profile-studio',
                'category' => 'Company Profile',
                'summary' => 'Project contoh untuk halaman company profile yang menonjolkan karya, layanan, dan jalur kontak tanpa membuat pengunjung menebak.',
                'problem_statement' => "Sebuah studio kecil punya banyak karya, tetapi informasinya tersebar di media sosial dan dokumen presentasi. Calon klien sulit memahami layanan dan cara menghubungi tim.\n\nProject contoh ini menggambarkan situs yang menyatukan identitas, layanan, portofolio, dan kontak dalam satu alur yang tenang dan mudah dipindai.",
                'solution' => "Menyusun halaman company profile dengan hierarki konten yang jelas, navigasi yang konsisten, dan formulir kontak yang menyimpan pesan ke database sebelum mengirim notifikasi.\n\nGambar dan teks dikelola dari admin agar tim bisa memperbarui situs tanpa menyentuh kode.",
                'description' => "Ini adalah project contoh. Tidak ada klien, hasil, atau metrik nyata yang diklaim di halaman ini.\n\nFokus desainnya adalah keterbacaan: ukuran teks yang nyaman, ruang kosong yang cukup, dan aksen warna yang dipakai untuk menandai tindakan penting, bukan untuk menghias setiap bagian.\n\nStruktur seperti ini cocok untuk studio, firma profesional, atau bisnis jasa yang ingin tampil kredibel tanpa terasa berlebihan.",
                'features' => [
                    'Halaman layanan dan portofolio',
                    'Formulir kontak dengan penyimpanan pesan',
                    'Pengelolaan gambar dan teks dari admin',
                    'Metadata SEO dan Open Graph',
                ],
                'technologies' => ['Laravel', 'MySQL', 'Blade', 'Tailwind CSS', 'Vanilla JavaScript'],
                'is_featured' => true,
                'is_placeholder' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Contoh — Katalog Produk',
                'slug' => 'contoh-katalog-produk',
                'category' => 'E-Commerce',
                'summary' => 'Project contoh untuk katalog produk dengan filter kategori, halaman detail, dan alur pengelolaan stok yang sederhana.',
                'problem_statement' => "Katalog produk yang terus bertambah sulit dipindai jika semua item ditampilkan dengan bobot yang sama. Pengunjung perlu cara cepat untuk menyaring produk berdasarkan kategori dan kebutuhan.\n\nProject contoh ini menggambarkan katalog yang tetap ringan di perangkat mobile dan mudah diperbarui oleh admin.",
                'solution' => "Membangun daftar produk dengan filter kategori, pencarian, dan halaman detail yang menyajikan informasi penting lebih dulu. Data produk dikelola melalui admin dengan validasi dan pengurutan yang jelas.\n\nGambar produk disimpan di storage publik dan dioptimalkan sebelum ditampilkan.",
                'description' => "Ini adalah project contoh. Produk, harga, dan nama merek yang mungkin muncul di tampilan awal hanyalah placeholder.\n\nPendekatan yang ditunjukkan menekankan performa: query yang tidak berlebihan, gambar yang tidak memblokir render, dan interaksi filter yang bisa dipakai tanpa JavaScript berat.\n\nStruktur ini bisa dikembangkan menjadi toko lengkap, tetapi halaman ini tidak mengklaim integrasi pembayaran atau transaksi nyata.",
                'features' => [
                    'Daftar produk dengan filter kategori',
                    'Halaman detail produk',
                    'Pengelolaan gambar produk',
                    'Pencarian dan pengurutan',
                ],
                'technologies' => ['Laravel', 'MySQL', 'Blade', 'Tailwind CSS'],
                'is_featured' => false,
                'is_placeholder' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Contoh — Dashboard Operasional',
                'slug' => 'contoh-dashboard-operasional',
                'category' => 'Dashboard',
                'summary' => 'Project contoh untuk dashboard internal yang merangkum data operasional, status pekerjaan, dan tindakan yang perlu diambil.',
                'problem_statement' => "Data operasional tersebar di beberapa spreadsheet. Tim menghabiskan waktu untuk menyusun laporan manual dan sering melewatkan pekerjaan yang terlambat.\n\nProject contoh ini menggambarkan satu layar ringkas yang membantu tim melihat prioritas tanpa tenggelam dalam angka.",
                'solution' => "Merancang dashboard dengan ringkasan metrik, tabel pekerjaan, dan filter tanggal. Setiap angka memiliki konteks dan tautan ke data sumber agar keputusan tidak diambil berdasarkan tampilan kosong.\n\nAkses dibatasi berdasarkan peran dan semua perubahan dicatat.",
                'description' => "Ini adalah project contoh. Angka dan status yang ditampilkan bukan data nyata.\n\nFokusnya adalah information architecture: apa yang perlu dilihat lebih dulu, apa yang cukup menjadi detail, dan bagaimana keadaan kosong atau gagal dijelaskan dengan jujur.\n\nDashboard yang baik bukan yang paling banyak menampilkan grafik, tetapi yang membuat tindakan berikutnya jelas.",
                'features' => [
                    'Ringkasan metrik operasional',
                    'Tabel pekerjaan dengan filter',
                    'Status dan prioritas yang mudah dipindai',
                    'Kontrol akses berbasis peran',
                ],
                'technologies' => ['Laravel', 'MySQL', 'Blade', 'Tailwind CSS'],
                'is_featured' => false,
                'is_placeholder' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $project) {
            Project::query()->firstOrCreate(
                ['slug' => $project['slug']],
                [
                    ...$project,
                    'status' => ProjectStatus::Published,
                    'published_at' => now(),
                ],
            );
        }
    }
}
