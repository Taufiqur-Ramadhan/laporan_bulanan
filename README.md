# SIGAT - Sistem Informasi Input Kegiatan

SIGAT adalah aplikasi berbasis web yang dibangun menggunakan **Laravel 12** dan **Filament PHP v3** untuk manajemen laporan kegiatan bulanan secara efisien dan terstruktur.

## ✨ Fitur Utama

- **Dashboard Statistik**: Visualisasi data kegiatan dan anggaran secara real-time.
- **Manajemen Kegiatan**: Input, edit, dan hapus data kegiatan dengan mudah.
- **Peta Interaktif (Leaflet)**: 
    - Penentuan lokasi kegiatan menggunakan map.
    - Fitur **Pencarian Lokasi** di seluruh Indonesia yang otomatis memindahkan marker.
- **Sistem Revisi & Verifikasi**: Alur kerja profesional antara Admin dan Anggota untuk persetujuan laporan.
- **Ekspor Data**: Mendukung ekspor laporan ke format **Excel** dan **PDF**.
- **Profil Pengguna**:
    - Edit profil (Nama, Email, Password).
    - Unggah foto profil (Avatar) dengan fitur pemotong gambar melingkar.
- **Hak Akses (Role)**: Pembagian peran antara Admin dan Anggota.

## 🚀 Teknologi yang Digunakan

- **Framework**: [Laravel 12](https://laravel.com)
- **Admin Panel**: [Filament PHP v3](https://filamentphp.com)
- **Maps**: [Leaflet.js](https://leafletjs.com) & [Dotswan Map Picker](https://github.com/dotswan/filament-map-picker)
- **Geocoding**: Nominatim (OpenStreetMap)
- **UI Components**: Tailwind CSS & Alpine.js

## 🛠️ Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lokal:

1. **Clone repository**
   ```bash
   git clone https://github.com/Taufiqur-Ramadhan/laporan_bulanan.git
   cd laporan_bulanan
   ```

2. **Instal dependensi PHP**
   ```bash
   composer install
   ```

3. **Instal dependensi JavaScript**
   ```bash
   npm install && npm run build
   ```

4. **Konfigurasi Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Setup Database**
   Atur koneksi DB di file `.env`, lalu jalankan migrasi:
   ```bash
   php artisan migrate --seed
   ```

6. **Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```

## 🤝 Kontribusi

Jika Anda ingin berkontribusi dalam pengembangan aplikasi ini, silakan lakukan Pull Request atau buka Issue.

---
Dikembangkan oleh [Taufiqur-Ramadhan](https://github.com/Taufiqur-Ramadhan)
