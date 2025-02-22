# 🌍 Sistem Informasi Geografis Sekolah di Kota Tangsel

## 📌 Deskripsi
**Sistem Informasi Geografis (SIG) Sekolah di Kota Tangerang Selatan** adalah aplikasi berbasis web yang memungkinkan pengguna untuk mencari data sekolah **SD, SMP, dan SMA** yang tersebar di wilayah Kota Tangsel. Aplikasi ini dikembangkan menggunakan **CodeIgniter 4** dan memanfaatkan **OpenStreetMap** serta **Leaflet JS** untuk menampilkan peta interaktif.

## ✨ Fitur Utama
- 🔍 **Pencarian Sekolah**: Cari sekolah berdasarkan **nama, jenjang (SD, SMP, SMA), dan lokasi**.
- 🗺️ **Tampilan Peta Interaktif**: Menampilkan lokasi sekolah menggunakan **OpenStreetMap** dengan bantuan **Leaflet JS**.
- 🏫 **Detail Sekolah**: Informasi lengkap mengenai sekolah, seperti **alamat, jumlah siswa, dan fasilitas**.
- 🎯 **Filter Berdasarkan Jenjang**: Memfilter sekolah berdasarkan **jenjang pendidikan**.
- 🚗 **Rute ke Sekolah**: Menampilkan **rute dari lokasi pengguna** ke sekolah yang dipilih.
- 🔧 **Pengelolaan Data**: Admin dapat **menambah, mengedit, dan menghapus** data sekolah.

## 🛠 Teknologi yang Digunakan
- **🖥 Framework**: CodeIgniter 4
- **🗄 Database**: MySQL
- **🎨 Frontend**: HTML, CSS, JavaScript (**Leaflet JS, Bootstrap/Tailwind CSS**)
- **🗺️ Peta**: OpenStreetMap dengan Leaflet JS

## 🚀 Instalasi
1. **Clone repository ini:**
   ```bash
   git clone https://github.com/JonathanZefanya/SIG-Sekolah-Tangsel.git
   cd sig-sekolah-tangsel
   ```
2. **Install dependensi menggunakan Composer:**
   ```bash
   composer install
   ```
3. **Konfigurasi `.env` untuk koneksi database:**
   ```env
   database.default.hostname = localhost
   database.default.database = sig_sekolah
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
   ```
4. **Jalankan migrasi dan seeder database:**
   ```bash
   php spark migrate
   ``` 
   ```bash
   php spark db:seed UserSeeder
   ```
5. **Jalankan server lokal:**
   ```bash
   php spark serve
   ```
6. **Akses aplikasi di browser:** `http://localhost:8080`

## 📖 Cara Penggunaan
- 🔍 Gunakan fitur **pencarian** untuk menemukan sekolah berdasarkan **nama atau jenjang**.
- 📌 Klik pada **marker peta** untuk melihat **detail sekolah**.
- 🛣️ Gunakan fitur **rute** untuk menemukan jalur menuju sekolah dari lokasi Anda.

## 🤝 Kontribusi
Jika ingin berkontribusi, silakan **fork** repository ini dan ajukan **pull request** dengan perubahan yang Anda buat.

## 📜 Lisensi
Proyek ini dilisensikan di bawah **[MIT License](LICENSE)**.
