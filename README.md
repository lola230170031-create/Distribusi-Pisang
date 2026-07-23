# 🍌 Sistem Informasi Gudang Jual Beli Pisang

## Deskripsi Aplikasi

Sistem Informasi Gudang Jual Beli Pisang merupakan aplikasi berbasis web yang dibuat untuk membantu proses pengelolaan data gudang pada perusahaan PT Pisang Nusantara.

Aplikasi ini digunakan untuk mengelola data jenis pisang, kategori, supplier, transaksi pisang masuk, distribusi pisang keluar, serta menyediakan laporan PDF.

Dibuat menggunakan framework Laravel untuk memenuhi tugas Ujian Akhir Semester (UAS) Pemrograman Web Lanjut.

---

# Identitas Pengembang

Nama : Lola Acsyakie

Program Studi : Teknik Informatika

Universitas : Universitas Malikussaleh

---

# Teknologi yang Digunakan

Aplikasi ini dibuat menggunakan teknologi:

- Laravel 13
- PHP 8.4
- MySQL
- Bootstrap 5
- Bootstrap Icons
- Laravel Fortify Authentication
- Laravel DomPDF
- Chart.js


---

# Fitur Aplikasi

## 1. Autentikasi Pengguna

Sistem menggunakan Laravel Fortify untuk proses autentikasi pengguna.

Fitur autentikasi:

- Login pengguna
- Registrasi pengguna
- Password terenkripsi
- Session pengguna


Terdapat dua jenis pengguna:

### Admin

Admin dapat:

- Mengelola kategori pisang
- Mengelola data pisang
- Mengelola supplier
- Mengelola pisang masuk
- Mengelola distribusi pisang keluar
- Export laporan PDF


### User

User dapat:

- Login ke sistem
- Melihat dashboard
- Melihat data pisang


---

# 2. CRUD (Create, Read, Update, Delete)

Fitur CRUD yang tersedia:

## Kategori Pisang

Admin dapat:

- Menambah kategori
- Melihat kategori
- Mengubah kategori
- Menghapus kategori


## Data Pisang

Admin dapat:

- Menambah data pisang
- Melihat data pisang
- Mengedit data pisang
- Menghapus data pisang


## Supplier

Admin dapat:

- Menambah supplier
- Mengedit supplier
- Menghapus supplier


## Pisang Masuk

Digunakan untuk mencatat pemasukan pisang dari supplier.


## Distribusi Pisang

Digunakan untuk mencatat proses pengeluaran atau distribusi pisang.


---

# 3. Dashboard

Dashboard menyediakan informasi:

- Jumlah jenis pisang
- Jumlah supplier
- Total stok pisang
- Stok habis
- Total pisang masuk
- Total distribusi keluar
- Grafik aktivitas gudang
- Data transaksi terbaru
- Informasi stok kritis


---

# 4. Export Laporan PDF

Sistem menyediakan fitur export laporan data pisang dalam format PDF.

Isi laporan:

- Kode pisang
- Nama pisang
- Kategori
- Stok
- Harga
- Keterangan


---

# 5. Responsive Design

Tampilan menggunakan Bootstrap 5 sehingga dapat digunakan pada:

- Desktop
- Laptop
- Tablet
- Smartphone

---

# Cara Instalasi

## 1. Persiapan

Pastikan sudah terinstall:

- PHP >= 8.2
- Composer
- MySQL
- XAMPP/Laragon
- Node.js


## 2. Clone Repository

Setelah project sudah diupload ke GitHub, jalankan:

```bash
git clone link_repository_github

## 3. Masuk Folder Project

```bash
cd Distribusi-Pisang