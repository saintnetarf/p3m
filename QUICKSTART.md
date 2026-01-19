# 🎯 Quick Start Guide - SIPP3M

## ⚡ Instalasi Cepat (5 Menit)

### 1. Clone & Install
```bash
git clone <repository-url>
cd sipp3m
composer install
npm install
```

### 2. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Konfigurasi Database
Edit `.env`:
```env
DB_DATABASE=sipp3m
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrate & Seed
```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

### 5. Build & Run
```bash
npm run build
php artisan serve
```

🎉 **Selesai!** Buka http://localhost:8000

---

## 👥 Default Login

**Admin:**
- Email: `admin@ppm.ac.id`
- Password: `password`

**Operator:**
- Email: `operator@ppm.ac.id`
- Password: `password`

---

## 🗺️ Navigasi Cepat

### Frontend (Public)
- **Beranda**: http://localhost:8000/
- **Berita**: http://localhost:8000/berita
- **Penelitian**: http://localhost:8000/produk-penelitian
- **Pengumuman**: http://localhost:8000/pengumuman
- **Download**: http://localhost:8000/download
- **Grafik**: http://localhost:8000/grafik

### Backend (Admin)
- **Login**: http://localhost:8000/login
- **Dashboard**: http://localhost:8000/admin/dashboard
- **Kelola Berita**: http://localhost:8000/admin/news
- **Kelola Penelitian**: http://localhost:8000/admin/research-products
- **Kelola User**: http://localhost:8000/admin/users

---

## 📝 Tugas Umum

### Menambah Berita
1. Login sebagai admin/operator
2. Dashboard → Berita → Tambah Berita
3. Isi form, upload gambar (optional)
4. Pilih status: Draft atau Published
5. Klik Simpan

### Mengelola User (Admin Only)
1. Login sebagai admin
2. Dashboard → Manajemen User
3. Klik Tambah User
4. Pilih role: Admin atau Operator
5. Klik Simpan

### Upload File Download
1. Login sebagai admin/operator
2. Dashboard → File Download → Tambah File
3. Upload file (max 10MB)
4. Pilih kategori
5. Klik Simpan

### Input Data Statistik
1. Login sebagai admin/operator
2. Dashboard → Data Penelitian / Data Pengabdian
3. Tambah data baru dengan tahun dan jumlah
4. Data akan otomatis tampil di grafik

---

## 🔧 Troubleshooting Cepat

### Error: "No application encryption key"
```bash
php artisan key:generate
```

### Error: Storage link not found
```bash
php artisan storage:link
```

### Error: 500 Internal Server Error
```bash
php artisan optimize:clear
chmod -R 775 storage bootstrap/cache
```

### Database connection error
- Check `.env` file
- Pastikan MySQL running
- Create database `sipp3m`

### Assets tidak muncul
```bash
npm run build
```

---

## 📚 Dokumentasi Lengkap

- [README.md](README.md) - Panduan lengkap
- [DEPLOYMENT.md](DEPLOYMENT.md) - Panduan deployment production
- [DOCUMENTATION.md](DOCUMENTATION.md) - Dokumentasi teknis
- [CHANGELOG.md](CHANGELOG.md) - Riwayat perubahan

---

## 💡 Tips

1. **Ganti Password Default**: Segera ganti password admin setelah instalasi
2. **Backup Rutin**: Setup backup otomatis untuk database
3. **Monitor Storage**: Pantau ukuran folder `storage/app/public`
4. **Update Regular**: Update Laravel dan dependencies secara berkala
5. **Check Logs**: Pantau `storage/logs/laravel.log` untuk error

---

## 🆘 Butuh Bantuan?

- **Email**: dev@ppm.ac.id
- **Documentation**: Baca file DOCUMENTATION.md
- **Issues**: Report di GitHub Issues

---

**Selamat menggunakan SIPP3M! 🚀**
