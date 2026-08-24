# Laundry Gen Z 🧜‍♀️🌊

Website laundry PHP + MySQL sederhana dengan 2 POV:
- **User:** register, login, pesan laundry, pilih pembayaran, konfirmasi pembayaran, lihat status, edit profil.
- **Admin:** dashboard, kelola pesanan, verifikasi pembayaran, kelola layanan, lihat data user.
- Tema: **mermaid / underwater / Gen Z**.
- Ada animasi mermaid, gelembung, ikan, kerang, dan rumput laut.
- Ada **bunyi uang masuk** saat user menekan tombol "Saya Sudah Bayar". Bunyi dibuat dengan JavaScript Web Audio sehingga tidak membutuhkan file MP3 tambahan.

## Akun demo
Admin:
- Email: admin@genzlaundry.test
- Password: password

User:
- Email: user@genzlaundry.test
- Password: password

## Cara menjalankan di XAMPP + port 8080
1. Install dan buka XAMPP.
2. Nyalakan **Apache** dan **MySQL**.
3. Pastikan Apache berjalan di port **8080**.
4. Extract folder `laundry_gen_z_mermaid` ke `C:/xampp/htdocs/`.
5. Buka `http://localhost:8080/phpmyadmin`
6. Pilih menu **Import**, lalu pilih `database.sql`.
7. Jalankan import sampai selesai.
8. Buka website: `http://localhost:8080/laundry_gen_z_mermaid/`
9. Login menggunakan akun demo di atas.

## Jika folder XAMPP kamu berbeda
Yang penting folder project berada di dalam:
`C:/xampp/htdocs/`

## Catatan pembayaran
- QRIS pada project adalah QR demo untuk tugas, bukan QRIS merchant asli.
- Nomor rekening adalah nomor demo.
- Jangan gunakan data pembayaran demo untuk transaksi nyata.
- Bunyi pembayaran adalah bunyi sintetis dari browser. Beberapa browser mungkin meminta interaksi pengguna terlebih dahulu, dan tombol pembayaran sudah merupakan interaksi pengguna sehingga normalnya bunyi dapat dimainkan.

## Database
Nama database: `laundry_genz`

Query memakai prepared statement dan password memakai `password_hash()`.
