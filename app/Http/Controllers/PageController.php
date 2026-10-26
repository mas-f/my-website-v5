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
                        ['name' => 'Node.js', 'detail' => 'Runtime JavaScript untuk tooling build dan layanan sisi server.'],
                        ['name' => 'MySQL', 'detail' => 'Perancangan tabel, relasi, query, migrasi, dan indexing dasar.'],
                        ['name' => 'PostgreSQL', 'detail' => 'Basis data relasional: tabel, relasi, query, dan migrasi.'],
                        ['name' => 'REST API', 'detail' => 'Endpoint JSON, validasi request, dan penanganan error yang konsisten.'],
                    ],
                ],
                [
                    'title' => 'Frontend',
                    'note' => 'Antarmuka yang responsif, aksesibel, dan dikerjakan dengan alat yang sesuai kebutuhan.',
                    'items' => [
                        ['name' => 'Livewire', 'detail' => 'Komponen interaktif Laravel yang tetap berjalan di atas Blade.'],
                        ['name' => 'Tailwind CSS', 'detail' => 'Design token, layout responsif, dan sistem komponen.'],
                        ['name' => 'Bootstrap', 'detail' => 'Grid, komponen, dan utilitas untuk antarmuka yang konsisten.'],
                        ['name' => 'JavaScript', 'detail' => 'Interaksi vanilla: navigasi, filter, dialog, dan progressive enhancement.'],
                        ['name' => 'TypeScript', 'detail' => 'Tipe statis untuk kontrak data, props komponen, dan refactor yang lebih aman.'],
                        ['name' => 'React', 'detail' => 'Antarmuka berbasis komponen, state, dan props untuk halaman yang interaktif.'],
                        ['name' => 'Next.js', 'detail' => 'Routing, rendering, dan optimasi halaman React.'],
                    ],
                ],
                [
                    'title' => 'Alat kerja',
                    'note' => 'Alat bantu untuk merancang, membangun, menguji, dan melacak pekerjaan.',
                    'items' => [
                        ['name' => 'Git', 'detail' => 'Riwayat perubahan, branch, dan review sebelum rilis.'],
                        ['name' => 'Figma', 'detail' => 'Wireframe, prototipe, dan handoff desain ke implementasi.'],
                        ['name' => 'Postman', 'detail' => 'Koleksi request, pengujian endpoint, dan dokumentasi API.'],
                        ['name' => 'Trello', 'detail' => 'Papan tugas, prioritas, dan pelacakan progres pekerjaan.'],
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
