<h1 align="center">Local Eats</h1>
<br>
<h3 align="center">Jelajahi Kuliner Terbaik di Kota Anda</h3>
<p align="center">
  <img src="https://github.com/user-attachments/assets/c2b72210-97e3-4d73-9758-4f6ec1c52b6f" alt="Logo Local Eats" width="200"/>
</p>

<p align="center">
  <strong>LIVIA ADI</strong><br/><br/>
  <strong>D0223018</strong><br/><br/>
  <strong>Framework Web Based</strong><br/><br/>
</p>

<h3>Role dan Fitur</h3>

## 👤 Pelanggan (User)
| Fitur                         | Deskripsi                                                 |
|-------------------------------|-----------------------------------------------------------|
| Registrasi dan login          | Mendaftar dan masuk ke aplikasi                           |
| Eksplorasi tempat makan       | Menelusuri restoran berdasarkan lokasi, rating, kategori  |
| Memberi ulasan dan rating     | Menulis review dan memberi nilai untuk restoran           |

## 🧑‍🍳 Pemilik Restoran (Owner)
| Fitur                          | Deskripsi                                                       |
|--------------------------------|-----------------------------------------------------------------|
| Tambah profil restoran         | Menambahkan data restoran seperti alamat, menu, foto, dsb.      |
| Edit informasi restoran        | Mengubah data restoran yang sudah ada                           |
| Balas ulasan pelanggan         | Memberikan respon pada ulasan dari user                         |
| Lihat statistik restoran       | Melihat jumlah kunjungan, rating rata-rata, dan performa lainnya|

## 🛠️ Admin
| Fitur                     | Deskripsi                                                      |
|---------------------------|----------------------------------------------------------------|
| Kelola data pengguna      | Tambah, ubah, atau hapus akun user dan owner                   |
| Verifikasi restoran       | Menyetujui atau menolak restoran yang diajukan owner           |
| Moderasi ulasan           | Menghapus ulasan yang tidak pantas atau dilaporkan             |
| Pantau statistik sistem   | Melihat aktivitas sistem dan laporan                           |

<h3>Tabel-tabel database beserta field dan tipe datanya</h3>

<h3>Tabel Users</h3>

| Kolom        | Tipe         | Keterangan                          |
|--------------|--------------|-------------------------------------|
| `id`         | bigint       | Primary key                         |
| `username`   | string       | Nama pengguna                       |
| `email`      | string       | Email pengguna                      |
| `password`   | string       | Password terenkripsi                |
| `role`       | enum         | `user`, `owner`, `admin`            |
| `created_at` | timestamp    | Waktu registrasi                    |
| `updated_at` | timestamp    | Waktu terakhir diubah               |

<h3>Tabel Restaurants</h3>

| Kolom         | Tipe      | Keterangan                                  |
|---------------|-----------|---------------------------------------------|
| `id`          | bigint    | Primary key                                 |
| `owner_id`    | foreign   | ID user yang merupakan pemilik restoran     |
| `name`        | string    | Nama restoran                               |
| `address`     | text      | Alamat lengkap restoran                     |
| `category`    | string    | Kategori makanan (misal: Jepang, Kopi)      |
| `description` | text      | Deskripsi restoran                          |
| `status`      | enum      | `pending`, `aktif`, `ditolak`               |
| `created_at`  | timestamp |                                             |
| `updated_at`  | timestamp |                                             |

<h3>Tabel Menus</h3>

| Kolom         | Tipe      | Keterangan                              |
|---------------|-----------|-----------------------------------------|
| `id`          | bigint    | Primary key                             |
| `restaurant_id`| foreign  | ID restoran                             |
| `menu_name`   | string    | Nama menu                               |
| `price`       | decimal   | Harga menu                              |
| `description` | text      | Deskripsi menu                          |

<h3>Tabel Reviews</h3>

| Kolom         | Tipe      | Keterangan                                    |
|---------------|-----------|-----------------------------------------------|
| `id`          | bigint    | Primary key                                   |
| `user_id`     | foreign   | ID user yang menulis ulasan                   |
| `restaurant_id`| foreign  | ID restoran yang diulas                       |
| `rating`      | int       | Nilai 1–5                                     |
| `comment`     | text      | Isi ulasan                                    |
| `date_posted` | timestamp | Tanggal ulasan dibuat                         |

<h3>Tabel Favorites (opsional)</h3>

| Kolom         | Tipe      | Keterangan                                |
|---------------|-----------|-------------------------------------------|
| `id`          | bigint    | Primary key                               |
| `user_id`     | foreign   | ID user                                   |
| `restaurant_id`| foreign  | ID restoran                               |

<h3>Tabel Reports (opsional)</h3>

| Kolom         | Tipe      | Keterangan                                        |
|---------------|-----------|---------------------------------------------------|
| `id`          | bigint    | Primary key                                       |
| `reporter_id` | foreign   | ID user yang melaporkan                           |
| `target_type` | string    | `restaurant` atau `review`                        |
| `target_id`   | bigint    | ID dari objek yang dilaporkan                     |
| `reason`      | text      | Alasan laporan                                    |
| `created_at`  | timestamp |                                                   |

<h3>Relasi Antar Tabel</h3>

| Tabel Asal      | Tabel Tujuan     | Jenis Relasi   | Keterangan                                                                 |
|------------------|------------------|----------------|----------------------------------------------------------------------------|
| users            | restaurants       | One to Many    | Satu user dengan role `owner` dapat memiliki banyak restoran               |
| users            | reviews           | One to Many    | Satu user dapat menulis banyak ulasan                                      |
| users            | favorites         | One to Many    | Satu user dapat menyimpan banyak restoran ke favorit                       |
| restaurants      | menus             | One to Many    | Satu restoran memiliki banyak menu                                         |
| restaurants      | reviews           | One to Many    | Satu restoran menerima banyak ulasan                                       |
| restaurants      | favorites         | One to Many    | Satu restoran bisa difavoritkan oleh banyak user                           |
| users            | reports           | One to Many    | Satu user dapat membuat banyak laporan                                     |
| reports          | reviews/restaurants | Polymorphic  | Laporan bisa ditujukan ke `review` atau `restaurant` berdasarkan `target_type` |
