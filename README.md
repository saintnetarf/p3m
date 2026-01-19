# 🎓 Sistem Informasi Penelitian & Pengabdian Masyarakat (SIPP3M)

Website Lembaga Penelitian dan Pengabdian kepada Masyarakat yang dibangun dengan Laravel 12, MySQL, dan Bootstrap 5.

## 📋 Fitur Utama

### 🌐 Frontend (Publik)
- **Beranda** - Tampilan landing page dengan highlight terbaru
- **Berita** - Sistem berita dengan kategori dan pencarian
- **Produk Penelitian** - Katalog hasil penelitian dan pengabdian
- **Pengumuman** - Pengumuman penting dengan sistem aktif/nonaktif otomatis
- **Download** - Repository file dan dokumen dengan kategori
- **Grafik Statistik** - Visualisasi data dengan Chart.js (Bar & Pie Chart)

### 🔐 Backend (Admin)
- **Dashboard** - Statistik dan overview sistem
- **Manajemen Header** - Pengaturan logo, nama institusi, dan menu
- **Manajemen Berita** - CRUD berita dengan upload gambar dan status publish
- **Manajemen Kategori** - Kategori untuk berita dan download
- **Manajemen Produk Penelitian** - CRUD produk penelitian dengan file upload
- **Manajemen Pengumuman** - CRUD pengumuman dengan tanggal aktif
- **Manajemen Download** - Upload file dengan kategori dan tracking download
- **Manajemen Statistik** - Input data untuk grafik penelitian & pengabdian
- **Manajemen User** - CRUD user dengan role-based access (Admin only)

## 🛠️ Tech Stack

- **Framework**: Laravel 12
- **Database**: MySQL
- **Frontend**: Blade + Bootstrap 5 (Responsive)
- **Authentication**: Laravel Breeze
- **Chart**: Chart.js
- **Storage**: Laravel Storage (Public)
- **Icons**: Bootstrap Icons
- **Architecture**: MVC + Service Layer

## 📦 Instalasi

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone <repository-url>
cd sipp3m
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Environment Configuration**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Setup**
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sipp3m
DB_USERNAME=root
DB_PASSWORD=
```

5. **Migrate & Seed Database**
```bash
php artisan migrate:fresh --seed
```

6. **Create Storage Link**
```bash
php artisan storage:link
```

7. **Build Assets**
```bash
npm run build
```

8. **Run Development Server**
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 👥 Default Users

Setelah menjalankan seeder, Anda dapat login dengan:

**Admin Account:**
- Email: `admin@ppm.ac.id`
- Password: `password`
- Role: Administrator (Full Access)

**Operator Account:**
- Email: `operator@ppm.ac.id`
- Password: `password`
- Role: Operator (Limited Access)

## 📁 Struktur Database

### Tabel Utama
- `users` - User management dengan role
- `headers` - Konfigurasi header website
- `news_categories` - Kategori berita
- `news` - Berita dan artikel
- `research_products` - Produk penelitian dan pengabdian
- `announcements` - Pengumuman
- `download_categories` - Kategori file download
- `downloads` - File download
- `research_statistics` - Data statistik penelitian
- `service_statistics` - Data statistik pengabdian

### Relasi Database
- One-to-Many: NewsCategory → News
- One-to-Many: DownloadCategory → Downloads
- One-to-Many: User → News

## 🔒 Role & Permissions

### Admin
- Full access ke semua fitur
- Dapat mengelola users
- Dapat mengelola semua konten

### Operator
- Dapat mengelola konten (berita, penelitian, dll)
- Tidak dapat mengelola users
- Tidak dapat mengubah pengaturan sistem

## 🎨 Frontend Routes

```
/                          - Homepage
/berita                    - Daftar berita
/berita/{slug}             - Detail berita
/produk-penelitian         - Daftar produk penelitian
/produk-penelitian/{slug}  - Detail produk
/pengumuman                - Daftar pengumuman
/download                  - Daftar file download
/grafik                    - Halaman grafik statistik
```

## 🔧 Admin Routes

```
/admin/dashboard                    - Dashboard admin
/admin/news                         - Manajemen berita
/admin/news-categories              - Manajemen kategori berita
/admin/research-products            - Manajemen produk penelitian
/admin/announcements                - Manajemen pengumuman
/admin/downloads                    - Manajemen file download
/admin/download-categories          - Manajemen kategori download
/admin/research-statistics          - Manajemen data penelitian
/admin/service-statistics           - Manajemen data pengabdian
/admin/users                        - Manajemen user (Admin only)
```

## 🚀 Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
./vendor/bin/pint
```

### Clear Cache
```bash
php artisan optimize:clear
```

## 📝 API Endpoints

Chart.js mendapatkan data dari API endpoints:
- `GET /api/chart/research` - Data statistik penelitian
- `GET /api/chart/service` - Data statistik pengabdian

## 🔐 Security Features

- CSRF Protection
- XSS Protection
- SQL Injection Prevention
- Authentication & Authorization
- Role-based Access Control
- Secure File Upload
- Input Validation

## 📸 Screenshots

(Tambahkan screenshot aplikasi di sini)

## 🤝 Contributing

Aplikasi ini siap untuk dikembangkan lebih lanjut. Struktur kode mengikuti best practices Laravel dengan:
- Clean Code
- DRY Principle
- Naming Convention yang jelas
- Komentar pada fungsi penting
- Modular Architecture

## 📄 License

This project is open-sourced software.

## 👨‍💻 Developer

Developed with ❤️ using Laravel 12

## 📞 Support

Untuk pertanyaan dan dukungan, silakan hubungi:
- Email: ppm@institusi.ac.id
- Website: [URL Website]

---

**Note**: Pastikan untuk mengganti password default setelah instalasi pertama untuk keamanan aplikasi.

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
