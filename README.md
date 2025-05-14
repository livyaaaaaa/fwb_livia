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

---

### 👤 Pelanggan (User)

| Fitur                     | Deskripsi                                                |
| ------------------------- | -------------------------------------------------------- |
| Registrasi dan login      | Mendaftar dan masuk ke aplikasi                          |
| Eksplorasi tempat makan   | Menelusuri restoran berdasarkan lokasi, rating, kategori |
| Memberi ulasan dan rating | Menulis review dan memberi nilai untuk restoran          |

### 🧑‍🍳 Explorer (Penjelajah)

| Fitur                 | Deskripsi                                                          |
| --------------------- | ------------------------------------------------------------------ |
| Jelajahi restoran     | Menelusuri restoran berdasarkan lokasi, kategori, atau popularitas |
| Lihat review & rating | Membaca ulasan dari pengguna lain                                  |
| Simpan favorit        | Menyimpan daftar restoran favorit untuk kunjungan berikutnya       |
| Bagikan rekomendasi   | Membagikan tautan restoran ke media sosial atau ke teman           |

### 🛠️ Admin

| Fitur                   | Deskripsi                                                      |
| ----------------------- | -------------------------------------------------------------- |
| Kelola data pengguna    | Tambah, ubah, atau hapus akun user dan owner                   |
| Verifikasi restoran     | Menyetujui atau menolak restoran yang diajukan owner           |
| Moderasi ulasan         | Menghapus ulasan yang tidak pantas atau dilaporkan             |
| Pantau statistik sistem | Melihat aktivitas sistem dan laporan                           |

---

## 📂 Struktur Tabel Database

### `users`

| Kolom      | Tipe     | Keterangan                                  |
| ---------- | -------- | ------------------------------------------- |
| `id`       | bigint   | Primary key                                 |
| `username` | varchar  | Nama pengguna                               |
| `email`    | varchar  | Email pengguna                              |
| `password` | varchar  | Password (hashed)                           |
| `role`     | varchar  | Role (`user`, `admin`, `explorer`)          |

### `user_profiles`

| Kolom        | Tipe     | Keterangan                           |
| ------------ | -------- | ------------------------------------ |
| `id`         | bigint   | Primary key                          |
| `user_id`    | bigint   | Foreign key ke `users`               |
| `bio`        | text     | Deskripsi singkat                    |
| `avatar_url` | varchar  | URL foto profil                      |
| `birthdate`  | date     | Tanggal lahir                        |

### `restaurants`

| Kolom         | Tipe      | Keterangan                                                           |
| ------------- | --------- | -------------------------------------------------------------------- |
| `id`          | bigint    | Primary key                                                          |
| `owner_id`    | bigint    | Foreign key ke `users`                                               |
| `name`        | varchar   | Nama restoran                                                        |
| `address`     | text      | Alamat restoran                                                      |
| `category`    | varchar   | Kategori restoran (misalnya: Jepang, Kopi)                           |
| `description` | text      | Deskripsi restoran                                                   |
| `status`      | enum      | Status restoran (`pending`, `aktif`, `ditolak`)                      |
| `created_at`  | timestamp | Tanggal dibuat                                                       |
| `updated_at`  | timestamp | Terakhir diubah                                                      |

### `menus`

| Kolom           | Tipe     | Keterangan                                 |
| --------------- | -------- | ------------------------------------------ |
| `id`            | bigint   | Primary key                                |
| `restaurant_id` | bigint   | Foreign key ke `restaurants`               |
| `menu_name`     | varchar  | Nama menu                                  |
| `price`         | decimal  | Harga menu                                 |
| `description`   | text     | Deskripsi menu                             |

### `reviews`

| Kolom           | Tipe      | Keterangan                                               |
| --------------- | --------- | -------------------------------------------------------- |
| `id`            | bigint    | Primary key                                              |
| `user_id`       | bigint    | Foreign key ke `users`                                   |
| `restaurant_id` | bigint    | Foreign key ke `restaurants`                             |
| `rating`        | int       | Nilai rating (1–5)                                       |
| `comment`       | text      | Isi ulasan                                               |
| `date_posted`   | timestamp | Tanggal ulasan dibuat                                    |

### `favorites` (opsional)

| Kolom           | Tipe   | Keterangan                                 |
| --------------- | ------ | ------------------------------------------ |
| `id`            | bigint | Primary key                                |
| `user_id`       | bigint | Foreign key ke `users`                     |
| `restaurant_id` | bigint | Foreign key ke `restaurants`               |

### `reports` (opsional)

| Kolom         | Tipe      | Keterangan                                                |
| ------------- | --------- | --------------------------------------------------------- |
| `id`          | bigint    | Primary key                                               |
| `reporter_id` | bigint    | Foreign key ke `users`                                    |
| `target_type` | varchar   | Jenis target (`restaurant`, `review`)                     |
| `target_id`   | bigint    | ID dari objek yang dilaporkan                             |
| `reason`      | text      | Alasan laporan                                            |
| `created_at`  | timestamp | Tanggal laporan dibuat                                    |

---

## 🔗 Relasi Antar Tabel

| Tabel Asal              | Tabel Tujuan    | Jenis Relasi                   | Keterangan                                               |
| ----------------------- | --------------- | ------------------------------ | -------------------------------------------------------  |
| `users`                 | `user_profiles` | One to One                     | Setiap user memiliki satu profil                         |
| `users`                 | `restaurants`   | One to Many                    | Owner bisa memiliki banyak restoran                      |
| `restaurants`           | `menus`         | One to Many                    | Restoran memiliki banyak menu                            |
| `users`                 | `reviews`       | One to Many                    | User bisa memberi banyak ulasan                          |
| `restaurants`           | `reviews`       | One to Many                    | Restoran memiliki banyak ulasan                          |
| `users`                 | `favorites`     | One to Many                    | User bisa menyimpan banyak entri favorit                 |
| `restaurants`           | `favorites`     | One to Many                    | Restoran bisa muncul di banyak entri favorit             |
| `users` & `restaurants` | `favorites`     | Many to Many (via `favorites`) | Satu user bisa menyukai banyak restoran, dan sebaliknya  |
| `users`                 | `reports`       | One to Many                    | Satu user bisa membuat banyak laporan                    |

