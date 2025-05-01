# 🏥 E-Clinic – Sistem Informasi Klinik

E-Clinic adalah sistem informasi klinik berbasis web yang dibangun menggunakan Laravel, Laravel Breeze untuk autentikasi, Tailwind CSS untuk styling, dan Chart.js untuk visualisasi data. Selain itu, proyek ini juga menggunakan Laravel Spatie untuk manajemen roles dan permissions.

## ⚙️ Tech Stack

- **Backend**: Laravel
- **Frontend**: Tailwind CSS, Laravel Breeze, Chart.js
- **Role & Permission**: Laravel Spatie
- **Module Bundler**: Vite
- **Database**: MySQL

## 📦 Fitur Utama

- Autentikasi pengguna (Login, Register, Logout)
- Manajemen role dan permission
- Pengelolaan data klinik (pasien, kunjungan, dll.)
- Statistik data dengan Chart.js
- Responsive UI dengan Tailwind CSS

---

## 🚀 Langkah Instalasi

Ikuti langkah-langkah berikut untuk menjalankan E-Clinic secara lokal:

### 1. Clone Repository

```bash
git clone https://github.com/username/e-clinic.git
cd e-clinic
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Install Dependency JavaScript

```bash
npm install
```

### 4. Salin File Environment

```bash
cp .env.example .env
```

### 5. Konfigurasi Database

Buka file `.env` lalu sesuaikan konfigurasi berikut:

```env
DB_DATABASE=eclinic
DB_USERNAME=root
DB_PASSWORD=
```

> Pastikan database `eclinic` sudah dibuat di MySQL kamu.

### 6. Generate Application Key

```bash
php artisan key:generate
```

### 7. Import Struktur & Data Awal

Import file SQL ke database. Bisa menggunakan phpMyAdmin atau terminal:

```bash
mysql -u root -p eclinic < path/ke/file.sql
```

> Jika membutuhkan database-nya, bisa menghubungi saya melalui email.

### 8. Jalankan Server Laravel

```bash
php artisan serve
```

### 9. Jalankan Dev Server Vite (Tailwind)

```bash
npm run dev
```

---

## ✅ Akses Aplikasi

Setelah langkah-langkah di atas selesai, buka browser dan akses:

```
http://localhost:8000
```

---

## 📊 Preview Dashboard (dengan Chart.js)

Dashboard aplikasi menampilkan visualisasi data klinik secara real-time menggunakan Chart.js, termasuk grafik kunjungan pasien, data pemeriksaan, dan statistik lainnya.

---

## 📄 Lisensi

Proyek ini menggunakan lisensi open-source. Silakan disesuaikan sesuai kebutuhan proyek kamu.

---

> Dibuat dengan ❤️ oleh Pepet Goodboy
