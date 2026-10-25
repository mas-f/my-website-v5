# MASTER PROMPT: MODERN FULL STACK DEVELOPER PORTFOLIO

## 1. Peran AI

Bertindaklah sebagai Senior Laravel Developer, Full Stack Engineer, UI/UX Designer, dan Software Architect.

Bangun website personal portfolio profesional yang menampilkan kemampuan saya sebagai Full Stack Developer, lengkap dengan halaman publik, project showcase, contact form, serta dashboard admin untuk mengelola konten portfolio.

Website ini merupakan website kelima yang saya bangun. Karena itu, hasilnya harus memiliki kualitas visual yang matang, struktur kode yang rapi, pengalaman pengguna yang baik, serta implementasi backend yang nyata.

Website bukan sekadar mockup atau template statis. Seluruh fitur yang disediakan harus benar-benar berfungsi.

## 2. Referensi desain

Gunakan website berikut sebagai inspirasi visual:

https://dennamandela.vercel.app

Pelajari tata letak, tipografi, whitespace, komposisi section, kartu project, dan interaksi apabila referensi dapat diakses.

Jangan menyalin desainnya secara mentah. Kembangkan identitas visual yang orisinal, modern, minimalis, profesional, dan cocok untuk personal branding seorang developer.

## 3. Identitas dan tujuan

Identitas:
- Nama: [NAMA LENGKAP]
- Profesi: Full Stack Developer
- Lokasi: [KOTA, INDONESIA]
- Email: [EMAIL PROFESIONAL]
- GitHub: [URL GITHUB]
- LinkedIn: [URL LINKEDIN]
- Resume: [URL CV PDF]

Tujuan website:
1. Menjadi portfolio profesional untuk melamar pekerjaan developer.
2. Menunjukkan kemampuan frontend dan backend melalui project nyata.
3. Menjelaskan proses pemecahan masalah dan keputusan teknis.
4. Menarik calon klien freelance.
5. Menyediakan dashboard admin untuk mengelola konten tanpa mengedit kode secara manual.

Gunakan bahasa Indonesia sebagai bahasa utama. Pertahankan istilah teknis dalam bahasa Inggris apabila lebih natural.

Jangan mengarang pengalaman kerja, jumlah klien, sertifikasi, pencapaian, atau klaim teknis yang belum dikonfirmasi.

## 4. Teknologi yang wajib digunakan

Gunakan Laravel sebagai satu-satunya framework aplikasi utama.

### Backend
- Laravel.
- PHP.
- Laravel Routing.
- Laravel Controllers.
- Laravel Middleware.
- Laravel Validation.
- Laravel Eloquent ORM.
- Laravel Migrations dan Seeders.
- Laravel Authentication.
- Laravel Authorization dan Policies apabila diperlukan.
- Laravel Storage untuk pengelolaan file.

### Frontend
- Blade Templates.
- HTML5.
- Tailwind CSS.
- JavaScript murni untuk interaksi browser.
- Lucide Icons atau ikon SVG yang sesuai.
- CSS transitions dan JavaScript untuk animasi ringan.

### Database
- MySQL.

### Pengujian
- PHPUnit atau Pest, sesuai konfigurasi project.
- Laravel Feature Tests.
- Laravel Validation dan Authorization Tests.

### Deployment
- Hosting yang mendukung PHP dan Laravel.
- MySQL production database.
- Environment variables melalui file .env.
- HTTPS pada production.

Jangan gunakan:
- Next.js.
- React.
- Vue.js.
- Prisma.
- Node.js sebagai backend aplikasi.
- API backend terpisah.
- Arsitektur microservices yang tidak diperlukan.

Node.js boleh digunakan hanya sebagai tooling pengembangan frontend apabila diperlukan oleh build tool Tailwind CSS atau Vite. Node.js bukan runtime backend aplikasi.

Gunakan Laravel dan Blade untuk rendering halaman di server. Gunakan JavaScript biasa hanya untuk interaksi yang benar-benar memerlukannya.

Pilih versi Laravel yang stabil dan kompatibel dengan versi PHP serta dependensi yang tersedia ketika project dibuat. Periksa versi yang benar-benar terpasang sebelum menulis kode.

## 5. Design system

Konsep desain: Modern, Minimalist, Editorial, Professional Developer Portfolio.

Karakter visual:
- Light mode sebagai tema utama.
- Background putih atau off-white.
- Teks utama charcoal atau near-black.
- Warna sekunder abu-abu netral.
- Accent color cobalt blue atau electric blue secara terukur.
- Border tipis.
- Shadow lembut.
- Radius komponen yang konsisten.
- Whitespace yang cukup.
- Tipografi modern dan mudah dibaca.
- Layout responsif dari mobile hingga desktop.

Hindari gradient berlebihan, glassmorphism yang tidak perlu, efek neon, animasi berlebihan, dan desain yang terlihat seperti template generik.

Buat design tokens untuk warna, typography, spacing, radius, dan shadow. Pastikan seluruh halaman menggunakan sistem desain yang konsisten.

## 6. Halaman publik

### A. Home — /

Buat hero section yang langsung menjelaskan identitas dan keahlian saya.

Contoh headline:

"Membangun aplikasi web dari antarmuka hingga logika di baliknya."

Tambahkan:
- Deskripsi singkat tentang fokus pengembangan saya.
- CTA "Lihat Project".
- CTA "Hubungi Saya".
- Tombol unduh CV.
- Link GitHub dan LinkedIn.
- Visual pendukung yang relevan dengan dunia software engineering.

Jangan menggunakan statistik pengalaman atau klaim profesional yang belum terverifikasi.

### B. About — /about

Jelaskan perjalanan saya sebagai developer yang terus mengembangkan kemampuan melalui project nyata.

Bahas:
- Full stack web development.
- Pengembangan frontend.
- Backend menggunakan Laravel.
- Pengelolaan database menggunakan MySQL.
- Integrasi alur bisnis dan kebutuhan pengguna.
- Pembelajaran dan peningkatan kualitas kode.

Gunakan gaya bahasa personal, profesional, dan jujur.

### C. Skills — /skills

Kelompokkan kemampuan menjadi:

**Frontend**
- HTML5.
- CSS3.
- Tailwind CSS.
- JavaScript.
- Blade Templates.

**Backend**
- PHP.
- Laravel.
- REST API jika benar-benar pernah diimplementasikan.

**Database**
- MySQL.
- Eloquent ORM.
- Database migrations dan relasi.

**Tools**
- Git.
- GitHub.
- Composer.
- Laravel Artisan.
- Vite jika digunakan dalam build frontend.

Tampilkan teknologi sebagai daftar atau badge yang rapi. Hindari persentase skill yang tidak terukur.

### D. Projects — /projects

Tampilkan empat project terbaik.

Setiap project memiliki:
- Nama.
- Slug.
- Deskripsi singkat.
- Kategori.
- Thumbnail.
- Masalah yang diselesaikan.
- Solusi.
- Fitur utama.
- Teknologi yang benar-benar digunakan.
- Live demo jika tersedia.
- Repository GitHub jika tersedia.
- Status publikasi.

Project harus berasal dari data yang dikelola melalui dashboard admin.

Gunakan kartu project yang responsif, thumbnail yang konsisten, dan hover interaction yang halus.

Sediakan filter kategori jika memang bermanfaat.

### E. Project Detail — /projects/{slug}

Buat halaman detail project menggunakan Laravel routing dan model binding berdasarkan slug.

Tampilkan:
1. Project overview.
2. Masalah atau kebutuhan yang ingin diselesaikan.
3. Solusi yang dibuat.
4. Fitur utama.
5. Arsitektur aplikasi jika relevan.
6. Penjelasan implementasi Laravel.
7. Struktur database dan relasi jika relevan.
8. Tantangan teknis dan cara mengatasinya.
9. Screenshot aplikasi.
10. Link demo dan repository.

Hanya tampilkan project berstatus published pada halaman publik. Project draft tidak boleh dapat diakses hanya dengan mengetahui URL-nya.

### F. Services — /services

Tampilkan layanan yang dapat ditawarkan:
- Pengembangan website bisnis.
- Aplikasi web berbasis Laravel.
- Dashboard admin.
- Sistem CRUD.
- Integrasi database MySQL.
- Pengembangan sistem operasional sesuai kebutuhan.

Jangan mengklaim seluruh layanan telah digunakan oleh klien sebelumnya jika belum ada bukti.

### G. Contact — /contact

Buat form kontak dengan field:
- Nama.
- Email.
- Subjek.
- Pesan.

Implementasikan:
- Validasi Laravel di server.
- Validasi format email.
- Pesan kesalahan yang jelas.
- Status loading atau feedback pengiriman.
- Penyimpanan pesan ke database.
- Perlindungan spam dan rate limiting.
- CSRF protection.
- Feedback sukses hanya setelah proses berhasil.

Sediakan link email, GitHub, dan LinkedIn.

Jika pengiriman email diperlukan, gunakan Laravel Mail dengan provider yang dikonfigurasi melalui environment variables. Penyimpanan pesan dan pengiriman email harus memiliki penanganan error yang sesuai.

## 7. Dashboard admin

Bangun dashboard admin privat menggunakan Laravel, Blade, Tailwind CSS, dan MySQL.

Route yang disarankan:
- /admin/login
- /admin
- /admin/projects
- /admin/projects/create
- /admin/projects/{project}/edit
- /admin/messages
- /admin/profile

### Dashboard overview

Tampilkan:
- Jumlah project.
- Jumlah project published.
- Jumlah project draft.
- Jumlah pesan masuk.
- Pesan terbaru.

Gunakan query agregasi yang efisien. Jangan membuat statistik palsu.

### Manajemen project

Implementasikan CRUD lengkap:
- Tambah project.
- Lihat daftar project.
- Lihat detail internal project.
- Edit project.
- Hapus project dengan konfirmasi.
- Upload thumbnail.
- Kelola galeri gambar.
- Tentukan status draft atau published.
- Tandai featured project.
- Atur urutan tampilan.

Seluruh operasi harus terhubung ke MySQL menggunakan Eloquent ORM.

### Manajemen pesan

Admin dapat:
- Melihat pesan masuk.
- Membaca detail pesan.
- Menandai pesan sebagai sudah dibaca.
- Mengubah status pesan.
- Menghapus pesan apabila diperlukan.

### Autentikasi dan keamanan

- Gunakan mekanisme autentikasi Laravel yang sesuai dengan versi framework.
- Jangan menyediakan registrasi admin publik.
- Lindungi route admin menggunakan middleware autentikasi.
- Gunakan Gates atau Policies jika diperlukan.
- Validasi otorisasi di server pada setiap operasi sensitif.
- Jangan mengandalkan penyembunyian tombol sebagai mekanisme keamanan.
- Gunakan CSRF protection.
- Terapkan rate limiting pada endpoint sensitif.
- Gunakan password hashing yang disediakan Laravel.
- Lindungi session dan cookie dengan konfigurasi aman.
- Jangan menaruh kredensial di source code.
- Jangan menyimpan password dalam bentuk teks biasa.

Sediakan cara membuat akun admin pertama melalui seeder khusus atau perintah Artisan yang aman. Jangan membuat akun admin dengan password default yang dapat digunakan pada production.

## 8. Database dan model Eloquent

Rancang struktur database MySQL dengan migrations.

### Tabel projects

Kolom yang disarankan:
- id.
- title.
- slug.
- summary.
- description.
- problem_statement.
- solution.
- category.
- features.
- technologies.
- thumbnail_path.
- live_url.
- repository_url.
- status.
- is_featured.
- sort_order.
- published_at.
- timestamps.

Gunakan JSON untuk features atau technologies jika sesuai kebutuhan dan didukung oleh konfigurasi model. Gunakan relasi atau tabel terpisah apabila struktur data lebih kompleks.

### Tabel project_images

Opsional, untuk galeri:
- id.
- project_id.
- image_path.
- alt_text.
- sort_order.
- timestamps.

Gunakan relasi one-to-many dengan Project apabila galeri dibutuhkan.

### Tabel contact_messages

Kolom:
- id.
- name.
- email.
- subject.
- message.
- status.
- read_at.
- timestamps.

### Tabel users

Gunakan tabel autentikasi Laravel untuk admin.

Jangan menambahkan model atau tabel yang tidak dibutuhkan. Tentukan foreign keys, indeks, unique constraints, dan aturan penghapusan data secara tepat.

Buat:
- Migrations.
- Eloquent Models.
- Relationships.
- Form Requests untuk validasi jika sesuai.
- Seeders untuk data demonstrasi.
- Factories untuk testing jika diperlukan.

## 9. Upload dan penyimpanan gambar

Gunakan Laravel Filesystem.

Ketentuan:
- Validasi MIME type dan ukuran file.
- Batasi format gambar yang diperbolehkan.
- Simpan file pada disk yang sesuai.
- Gunakan Storage API, bukan mengelola path secara manual tanpa validasi.
- Simpan path gambar di database.
- Gunakan alt text.
- Sediakan penanganan file yang tidak ditemukan.
- Hapus file lama secara aman ketika thumbnail diganti.
- Jangan menghapus file bersama yang masih digunakan project lain.

Untuk penyimpanan lokal, konfigurasi public storage dengan benar. Untuk production, gunakan object storage jika diperlukan.

## 10. Struktur folder Laravel

Gunakan struktur yang mengikuti konvensi Laravel:

app/
  Http/
    Controllers/
      Admin/
      Public/
    Middleware/
    Requests/
  Models/
  Policies/
  Services/

database/
  migrations/
  seeders/
  factories/

resources/
  views/
    layouts/
    components/
    pages/
    projects/
    contact/
    admin/
  css/
  js/

routes/
  web.php
  console.php

public/
  images/

tests/
  Feature/
  Unit/

Struktur ini merupakan panduan. Pertahankan konvensi framework dan hindari membuat abstraksi yang tidak diperlukan.

Gunakan:
- Controllers untuk mengatur alur request.
- Form Requests untuk validasi kompleks.
- Eloquent Models untuk data dan relasi.
- Blade Components untuk UI yang reusable.
- Services hanya ketika terdapat business logic yang layak dipisahkan.
- Policies atau Gates untuk otorisasi.

## 11. Animasi dan interaksi

Gunakan:
- CSS transitions.
- Hover states pada project cards.
- Reveal animation yang ringan.
- Mobile navigation.
- Feedback visual untuk tombol.
- Modal konfirmasi.
- Interaksi form yang jelas.

Gunakan JavaScript biasa bila diperlukan. Jangan menambahkan framework frontend tambahan.

Hormati prefers-reduced-motion dan pastikan konten tetap berfungsi ketika animasi dinonaktifkan.

## 12. Responsive design dan aksesibilitas

Pastikan:
- Layout mobile, tablet, dan desktop berfungsi.
- Tidak ada horizontal overflow.
- Navigasi mobile mudah digunakan.
- Kontras warna memadai.
- Form memiliki label yang jelas.
- Semua kontrol dapat digunakan dengan keyboard.
- Focus state terlihat.
- Gambar memiliki alt text.
- Heading memiliki hierarki semantik.
- Modal memiliki perilaku aksesibilitas yang tepat.

## 13. SEO dan performa

Implementasikan:
- Metadata title dan description.
- Open Graph.
- Canonical URL sesuai domain produksi.
- Sitemap XML.
- robots.txt.
- Semantic HTML.
- Optimasi ukuran gambar.
- Lazy loading untuk gambar yang sesuai.
- Pagination untuk daftar project jika diperlukan.
- Eager loading relasi Eloquent untuk menghindari N+1 queries.
- Cache secara selektif untuk halaman publik.
- Error handling yang sesuai.

Jangan menampilkan halaman admin pada sitemap publik. Jangan mengekspos project draft melalui endpoint publik.

## 14. Environment dan konfigurasi

Sediakan dokumentasi konfigurasi .env.

Variabel yang umum digunakan:
- APP_NAME.
- APP_ENV.
- APP_KEY.
- APP_DEBUG.
- APP_URL.
- DB_CONNECTION.
- DB_HOST.
- DB_PORT.
- DB_DATABASE.
- DB_USERNAME.
- DB_PASSWORD.
- MAIL_MAILER.
- MAIL_HOST.
- MAIL_PORT.
- MAIL_USERNAME.
- MAIL_PASSWORD.
- MAIL_FROM_ADDRESS.

Sesuaikan variabel dengan provider dan konfigurasi yang benar-benar dipakai.

Jangan menuliskan secret asli dalam dokumentasi atau source code. Jangan mengaktifkan APP_DEBUG pada production.

## 15. Testing

Gunakan Laravel Feature Tests untuk memeriksa:
- Halaman home dapat dibuka.
- Daftar project hanya menampilkan project published.
- Project detail dapat diakses melalui slug.
- Project draft tidak dapat dibuka secara publik.
- Form kontak menolak input tidak valid.
- Pesan kontak tersimpan dengan benar.
- Pengunjung tanpa autentikasi tidak dapat mengakses dashboard.
- Admin dapat membuat, mengubah, dan menghapus project.
- Upload gambar mengikuti validasi.
- Otorisasi diterapkan pada operasi administratif.

Jalankan test, pemeriksaan sintaks, dan pemeriksaan kualitas kode yang tersedia. Jangan mengklaim pengujian lulus tanpa benar-benar menjalankannya.

## 16. Workflow pengerjaan

Tahap 1 — Audit dan perencanaan:
- Periksa repository yang tersedia.
- Periksa versi PHP, Laravel, Composer, dan dependensi.
- Pelajari struktur project yang sudah ada.
- Tentukan sitemap, design system, dan arsitektur.
- Identifikasi data personal dan project yang masih belum tersedia.

Tahap 2 — Fondasi:
- Siapkan layout Blade.
- Siapkan Tailwind CSS.
- Buat navbar, footer, komponen reusable, dan design tokens.
- Pastikan responsive design.

Tahap 3 — Halaman publik:
- Bangun Home, About, Skills, Projects, Project Detail, Services, dan Contact.
- Gunakan konten yang dapat dikelola dengan baik.
- Implementasikan SEO dasar dan interaksi.

Tahap 4 — Backend:
- Buat migrations.
- Buat Eloquent Models.
- Buat relasi database.
- Buat validasi dan business logic.
- Implementasikan CRUD project.

Tahap 5 — Dashboard:
- Implementasikan autentikasi.
- Lindungi route admin.
- Bangun dashboard dan manajemen project.
- Implementasikan pengelolaan pesan.
- Implementasikan upload gambar.

Tahap 6 — QA:
- Jalankan tests.
- Periksa validasi dan otorisasi.
- Periksa responsivitas dan aksesibilitas.
- Periksa query database.
- Perbaiki error yang ditemukan.

Tahap 7 — Deployment:
- Dokumentasikan instalasi.
- Siapkan konfigurasi production.
- Jalankan migrations.
- Konfigurasikan storage.
- Konfigurasikan domain dan HTTPS.
- Pastikan APP_DEBUG dinonaktifkan.

## 17. Definition of Done

Website dianggap selesai apabila:
- Seluruh halaman publik berfungsi.
- Empat project dapat ditampilkan dari database.
- Halaman detail project menggunakan slug.
- Dashboard admin memiliki autentikasi dan otorisasi.
- CRUD project berfungsi.
- Upload gambar berfungsi.
- Pesan kontak tersimpan dengan benar.
- Database menggunakan MySQL.
- Tidak ada kredensial yang terekspos.
- Desain responsif dan konsisten.
- SEO dasar diterapkan.
- Testing relevan dijalankan.
- README tersedia.
- Website dapat dikonfigurasi untuk deployment.

## 18. Instruksi akhir

Mulai dengan memeriksa repository dan menyusun rencana implementasi yang konkret.

Jika repository sudah berisi aplikasi Laravel, pertahankan konfigurasi yang masih relevan dan hindari mengganti file secara sembarangan.

Jika project belum ada, buat fondasi Laravel yang sesuai.

Kerjakan secara bertahap, jelaskan file yang dibuat atau diubah, dan uji setiap fitur penting.

Jangan membuat mockup seolah-olah sudah menjadi fitur nyata. Jangan mengarang data project, identitas, atau pengalaman profesional.

Prioritas utama adalah membangun portfolio yang profesional, memperlihatkan kemampuan Laravel full stack melalui implementasi nyata, dan mendukung tujuan saya mendapatkan pekerjaan maupun project freelance.