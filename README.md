# SIGAT - Sistem Input Kegiatan

SIGAT adalah sistem informasi berbasis web yang dikembangkan menggunakan **Laravel 12** dan **Filament PHP v3**. Aplikasi ini dirancang untuk mengelola laporan kegiatan bulanan secara efisien, terstruktur, dan profesional.

## Fitur Utama

### 1. Fitur Umum
- **Dasbor Statistik**: Visualisasi data kegiatan dan alokasi anggaran secara real-time untuk gambaran menyeluruh.
- **Integrasi Peta Interaktif**: Penentuan lokasi kegiatan menggunakan Leaflet.js dengan fitur pencarian lokasi otomatis.
- **Manajemen Profil**: Pembaruan informasi akun dan unggah foto profil dengan sistem pengolahan citra.
- **Ekspor Dokumen**: Penghasilan laporan digital dalam format **Excel** dan **PDF**.

### 2. Fitur Administrator
- **Manajemen Pengguna**: Pengaturan akun pengguna dan pembagian peran (Role).
- **Validasi Laporan**: Melakukan verifikasi, persetujuan, atau pengembalian laporan untuk revisi.
- **Pemantauan Anggaran**: Monitoring total anggaran kegiatan di seluruh unit atau anggota.

### 3. Fitur Anggota (User)
- **Pelaporan Kegiatan**: Input data kegiatan bulanan lengkap dengan koordinat lokasi dan dokumentasi.
- **Manajemen Revisi**: Melakukan perbaikan laporan berdasarkan catatan verifikasi dari Admin.
- **Riwayat Pelaporan**: Akses terhadap seluruh data kegiatan yang telah dilaporkan sebelumnya.

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
