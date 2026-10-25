<?php

namespace App\Http\Controllers;

use App\Models\SiteProfile;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about', [
            'profile' => SiteProfile::current(),
        ]);
    }

    public function skills(): View
    {
        return view('pages.skills', [
            'profile' => SiteProfile::current(),
            'groups' => [
                [
                    'title' => 'Backend',
                    'note' => 'Logika aplikasi, data, dan batasan yang dijaga di sisi server.',
                    'items' => [
                        ['name' => 'PHP', 'detail' => 'Bahasa utama untuk aplikasi Laravel.'],
                        ['name' => 'Laravel', 'detail' => 'Routing, controller, Eloquent, validasi, otorisasi, queue, dan testing.'],
                        ['name' => 'MySQL', 'detail' => 'Perancangan tabel, relasi, query, migrasi, dan indexing dasar.'],
                        ['name' => 'REST API', 'detail' => 'Endpoint JSON, validasi request, dan penanganan error yang konsisten.'],
                    ],
                ],
                [
                    'title' => 'Frontend',
                    'note' => 'Antarmuka yang tenang, responsif, dan tidak bergantung pada framework berat.',
                    'items' => [
                        ['name' => 'Blade', 'detail' => 'Template server-side, komponen, layout, dan partial.'],
                        ['name' => 'Tailwind CSS', 'detail' => 'Design token, layout responsif, dan sistem komponen.'],
                        ['name' => 'JavaScript', 'detail' => 'Interaksi vanilla: navigasi, filter, dialog, dan progressive enhancement.'],
                        ['name' => 'Aksesibilitas', 'detail' => 'Struktur semantik, fokus keyboard, kontras, dan reduced motion.'],
                    ],
                ],
                [
                    'title' => 'Alat kerja',
                    'note' => 'Alat yang dipakai untuk menjaga perubahan tetap bisa dilacak dan diuji.',
                    'items' => [
                        ['name' => 'Git', 'detail' => 'Riwayat perubahan, branch, dan review sebelum rilis.'],
                        ['name' => 'Vite', 'detail' => 'Build asset, font, dan optimasi produksi.'],
                        ['name' => 'Pest', 'detail' => 'Feature test untuk alur publik dan admin.'],
                        ['name' => 'Pint', 'detail' => 'Format PHP yang konsisten.'],
                    ],
                ],
            ],
        ]);
    }

    public function services(): View
    {
        return view('pages.services', [
            'profile' => SiteProfile::current(),
            'services' => [
                [
                    'title' => 'Pengembangan aplikasi web',
                    'summary' => 'Aplikasi Laravel dari struktur data sampai antarmuka, dengan panel admin yang benar-benar bisa dipakai.',
                    'deliverables' => ['Perancangan alur dan skema data', 'Implementasi backend dan Blade', 'Panel admin dan otorisasi', 'Pengujian alur utama'],
                    'fit' => 'Cocok untuk bisnis yang butuh sistem internal, katalog, atau aplikasi web khusus.',
                ],
                [
                    'title' => 'Perbaikan dan pemeliharaan',
                    'summary' => 'Menelusuri masalah pada aplikasi yang sudah berjalan, merapikan kode, dan menutup celah yang berisiko.',
                    'deliverables' => ['Audit alur dan query', 'Perbaikan bug', 'Peningkatan validasi dan otorisasi', 'Dokumentasi perubahan'],
                    'fit' => 'Cocok untuk aplikasi Laravel yang sudah dipakai tetapi mulai sulit dirawat.',
                ],
                [
                    'title' => 'Landing page dan company profile',
                    'summary' => 'Situs yang menyajikan identitas, layanan, dan bukti kerja dengan hierarki yang jelas.',
                    'deliverables' => ['Struktur konten', 'Desain responsif', 'Formulir kontak', 'SEO dasar dan metadata'],
                    'fit' => 'Cocok untuk studio, firma, atau bisnis jasa yang ingin tampil kredibel.',
                ],
                [
                    'title' => 'Konsultasi teknis',
                    'summary' => 'Sesi terarah untuk membahas keputusan arsitektur, prioritas perbaikan, atau rencana implementasi.',
                    'deliverables' => ['Pemetaan masalah', 'Rekomendasi pendekatan', 'Prioritas pekerjaan', 'Catatan tindak lanjut'],
                    'fit' => 'Cocok untuk tim kecil yang perlu sudut pandang teknis sebelum membangun.',
                ],
            ],
        ]);
    }
}
