# SIGAT - Sistem Informasi Pelaporan Kegiatan

SIGAT adalah sistem informasi berbasis web yang dikembangkan menggunakan **Laravel 12** dan **Filament PHP v3**. Aplikasi ini dirancang untuk mengelola laporan kegiatan bulanan secara efisien, terstruktur, dan profesional.

## Fitur Utama

- **Dasbor Statistik**: Visualisasi data kegiatan dan alokasi anggaran secara real-time.
- **Manajemen Laporan**: Pengelolaan data kegiatan yang komprehensif (input, pembaruan, dan penghapusan).
- **Integrasi Peta Interaktif (Leaflet)**: 
    - Penentuan lokasi geometris kegiatan melalui antarmuka peta.
    - Fitur pencarian lokasi otomatis untuk presisi koordinat.
- **Sistem Verifikasi Berjenjang**: Alur kerja persetujuan laporan antara administrator dan staf untuk menjamin akurasi data.
- **Ekspor Dokumen**: Penghasilan laporan dalam format **Excel** dan **PDF**.
- **Manajemen Profil**:
    - Pembaruan identitas pengguna (Nama, Email, Keamanan Akun).
    - Fitur unggah foto profil dengan pengolahan citra profesional.
- **Manajemen Hak Akses**: Pembagian peran dan otorisasi yang jelas bagi Admin dan Anggota.

## Teknologi Utama

- **Framework Utama**: [Laravel 12](https://laravel.com)
- **Panel Administrasi**: [Filament PHP v3](https://filamentphp.com)
- **Pemetaan**: [Leaflet.js](https://leafletjs.com) & [Dotswan Map Picker](https://github.com/dotswan/filament-map-picker)
- **Layanan Geocoding**: Nominatim (OpenStreetMap)
- **Antarmuka Pengguna**: Tailwind CSS & Alpine.js

## Panduan Instalasi

Silakan ikuti prosedur berikut untuk melakukan deployment lokal:

1. **Kloning Repositori**
   ```bash
   git clone https://github.com/Taufiqur-Ramadhan/laporan_bulanan.git
   cd laporan_bulanan
   ```

2. **Instalasi Dependensi PHP**
   ```bash
   composer install
   ```

3. **Instalasi Dependensi Aset**
   ```bash
   npm install && npm run build
   ```

4. **Konfigurasi Lingkungan**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Konfigurasi Basis Data**
   Konfigurasikan koneksi database pada berkas `.env`, kemudian jalankan migrasi:
   ```bash
   php artisan migrate --seed
   ```

6. **Tautan Penyimpanan (Storage Link)**
   ```bash
   php artisan storage:link
   ```

7. **Menjalankan Server Pengembangan**
   ```bash
   php artisan serve
   ```

## Kontribusi

Kami menerima kontribusi untuk pengembangan sistem ini. Silakan ajukan Pull Request atau laporkan kendala melalui fitur Issue pada repositori ini.

---
Dikembangkan oleh [Taufiqur-Ramadhan](https://github.com/Taufiqur-Ramadhan)
