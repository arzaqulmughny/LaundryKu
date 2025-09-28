# LaundryKu

**LaundryKu** adalah aplikasi ERP sederhana untuk bisnis laundry, dibangun dengan **Laravel**, **TailwindCSS**, dan **MySQL**. Aplikasi ini dirancang untuk membantu pemilik usaha mengelola operasional sehari-hari secara efisien, mulai dari pencatatan pesanan, manajemen stok, pengaturan aplikasi, hingga laporan keuangan. LaundryKu juga mendukung layanan antar jemput pesanan dan mempermudah komunikasi dengan pelanggan.  

---

## Fitur Utama

- **Transaksi Laundry**
  - Input pesanan via WhatsApp atau pelanggan datang langsung.
  - Proses laundry: cuci, setrika, sortir, update status.
  - Layanan antar jemput pesanan.

- **Master Data & Setting**
  - Kelola item/paket laundry, akun pengguna, dan hak akses.
  - Setting aplikasi: nama, deskripsi, dan icon aplikasi.

- **Authorization / Role**
  - **Owner**: akses penuh ke semua fitur (master, transaksi, laporan, setting).  
  - **Admin**: tambah/ubah master data & lihat laporan.  
  - **Staff**: hanya mencatat dan update transaksi.

- **Laporan**
  - Laporan pesanan, pendapatan, dan aktivitas harian.
  - Filter berdasarkan tanggal atau status pesanan.

---

## Flow Aplikasi

1. **Pelanggan**: memesan layanan via WhatsApp atau datang langsung.  
2. **Karyawan**:
   - Menjemput pesanan (jika layanan antar jemput).
   - Memeriksa pesanan (timbang, cek kondisi pakaian, dll).
   - Input pesanan ke aplikasi.
   - Memproses pesanan & update status.
   - Menyelesaikan pesanan & notifikasi ke pelanggan.
   - Mengantar pesanan (jika menggunakan layanan antar jemput).  
3. **Pelanggan**: menerima pesanan dan melakukan pembayaran.  

---

## Tampilan Aplikasi

Berikut beberapa contoh tampilan aplikasi:

### Login
![Login Screenshot](docs/screenshots/Login%20Page.png)

### Dashboard
![Dashboard Screenshot](docs/screenshots/Dashboard%20Page.png)

### Kelola Pesanan
![Kelola Pesanan Screenshot](docs/screenshots/Edit%20Transaction%20Page.png)

### Laporan
![Laporan Screenshot](docs/screenshots/Report%20Page.png)

---

## Tech Stack

- **Backend:** Laravel  
- **Frontend:** Blade + TailwindCSS  
- **Database:** MySQL  
