START TRANSACTION;

CREATE TABLE IF NOT EXISTS `books` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `author` VARCHAR(255) NOT NULL,
  `publisher` VARCHAR(255) NOT NULL,
  `year` INT NOT NULL,
  `isbn` VARCHAR(50),
  `stock` INT NOT NULL,
  `description` TEXT,
  `created_at` DATETIME,
  `updated_at` DATETIME,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `bukus` (
  `judul` VARCHAR(255) NOT NULL,
  `penulis` VARCHAR(255) NOT NULL,
  `penerbit` VARCHAR(255) NOT NULL,
  `tahun` INT NOT NULL,
  `isbn` VARCHAR(50),
  `kategori` VARCHAR(100),
  `stok` INT NOT NULL,
  `deskripsi` TEXT,
  `created_at` DATETIME,
  `updated_at` DATETIME,
  `cover` VARCHAR(255),
  PRIMARY KEY (`isbn`)
);

CREATE TABLE IF NOT EXISTS `cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` TEXT NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`)
);

CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`)
);

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` TEXT NOT NULL,
  `exception` TEXT NOT NULL,
  `failed_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT NOT NULL,
  `pending_jobs` INT NOT NULL,
  `failed_jobs` INT NOT NULL,
  `failed_job_ids` TEXT NOT NULL,
  `options` TEXT,
  `cancelled_at` INT,
  `created_at` INT NOT NULL,
  `finished_at` INT,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `queue` VARCHAR(255) NOT NULL,
  `payload` TEXT NOT NULL,
  `attempts` INT NOT NULL,
  `reserved_at` INT,
  `available_at` INT NOT NULL,
  `created_at` INT NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` DATETIME,
  PRIMARY KEY (`email`)
);

CREATE TABLE IF NOT EXISTS `peminjamen` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME,
  `updated_at` DATETIME,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` INT,
  `ip_address` VARCHAR(50),
  `user_agent` TEXT,
  `payload` TEXT NOT NULL,
  `last_activity` INT NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` DATETIME,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100),
  `created_at` DATETIME,
  `updated_at` DATETIME,
  PRIMARY KEY (`id`)
);

INSERT INTO `bukus` VALUES
('Pengantar Ilmu Ekonomi','Sadono Sukirno','Rajawali Pers',2016,'9789797694667','Ekonomi',8,'Buku dasar ekonomi yang membahas konsep ekonomi mikro dan makro.','2026-03-11 03:07:56','2026-03-11 03:07:56','covers/jsvtTrYQp7cMsg0S9PzHe5dFRNehSAuLG7D0ymXZ.jpg'),
('Algoritma dan Pemrograman','Rinaldi Munir','Informatika',2020,'9786021514524','Informatika',10,'Buku pengantar algoritma dan dasar pemrograman untuk mahasiswa informatika.','2026-03-11 03:12:02','2026-03-11 03:12:02','covers/KnLMuakWbgA3389lTeVTZrN8VqZFC89eyDDLXfsD.jpg'),
('Introduction to Algorithms','Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, Clifford Stein','MIT Press',2009,'9780262033848','Informatika',5,'Buku referensi algoritma yang banyak digunakan di universitas seluruh dunia.','2026-03-11 03:13:10','2026-03-11 03:13:10','covers/8CogrAz4h2taCTlo8XJB37jtZXmHOYfFRmNjYMrV.jpg'),
('Clean Code','Robert C. Martin','Prentice Hall',2008,'9780132350884','Informatika',6,'Buku tentang praktik menulis kode program yang bersih dan mudah dipelihara.','2026-03-11 03:15:14','2026-03-11 03:15:14','covers/g1GpQuYZ0ll2QypDYrZJsQtq0VUIHpwRYmORXBXj.jpg'),
('Principles of Economics','N. Gregory Mankiw','Cengage Learning',2018,'9781305585122','Ekonomi',7,'Buku ekonomi populer yang menjelaskan prinsip dasar ekonomi modern.','2026-03-11 03:17:59','2026-03-11 03:17:59','covers/nxOeSCp3O9wOlj2wC98Ipe04t5mOzomJxbLzEaJm.jpg'),
('Pengantar Ilmu Hukum','Satjipto Rahardjo','Citra Aditya Bakti',2014,'9789794148491','Hukum',6,'Buku pengantar untuk memahami konsep dasar ilmu hukum.','2026-03-11 03:21:35','2026-03-11 03:21:35','covers/LHxHSlUhs9efdMblWGqbZ0LaMoGMEAy46RODnvAH.avif'),
('Hukum Perdata Indonesia','Subekti','Intermasa',2010,'9789798761122','Hukum',5,'Buku yang membahas hukum perdata yang berlaku di Indonesia.','2026-03-11 03:29:51','2026-03-11 03:29:51','covers/509STmUymwwcwYhovLahXIYVKC0BLRnvLHqkwKrZ.jpg'),
('Pengantar Akuntansi','Carl S. Warren, James M. Reeve, Jonathan Duchac','Salemba Empat',2021,'9789790618493','Akuntansi',10,'Buku dasar akuntansi untuk mahasiswa ekonomi dan bisnis.','2026-03-11 03:32:14','2026-03-11 03:32:14','covers/X5q9X8oZNK6bXuUfiALdlXm6UfQ927LPP8lY6qmh.jpg'),
('Akuntansi Keuangan Menengah','Donald E. Kieso, Jerry J. Weygandt','Wiley',2020,'9781119503668','Akuntansi',5,'Buku yang membahas konsep akuntansi keuangan secara mendalam.','2026-03-11 03:35:38','2026-03-11 03:35:38','covers/mwKAccqX6rn3TURzfPChlfCUew3oCkZvXzpeGvSM.jpg'),
('Akuntansi Manajemen','Charles T. Horngren','Pearson',2019,'9780133424300','Akuntansi',6,'Buku yang menjelaskan akuntansi untuk pengambilan keputusan manajemen.','2026-03-11 03:38:07','2026-03-11 03:38:07','covers/CeediFVkGwzGgu4KvFnkZHOJTwoPG0W2oRICYs2h.jpg'),
('Teologi Sistematika','Wayne Grudem','Gandum Mas',2020,'9789796876342','Agama',4,'Buku yang menjelaskan doktrin dasar iman Kristen secara sistematis.','2026-03-11 03:40:55','2026-03-11 03:40:55','covers/ti1y893MPzaxjQCtQb3AfTDa6vUqtNtzZyVEkKA0.jpg'),
('Pengantar Studi Islam','Harun Nasution','UI Press',2019,'9789794565670','Agama',3,'Buku yang membahas dasar-dasar pemahaman ajaran Islam dan sejarahnya.','2026-03-11 03:45:41','2026-03-11 03:45:41','covers/JM9zdNjIMDe8fhsBPA5JzCxJYhUDDLDyk9GRA43F.jpg'),
('Pengantar Sejarah Agama Buddha Mahayana','Bhikkhu Bodhi','Karaniya',2019,'9786028194508','Agama',5,'Buku pengantar untuk memahami ajaran dasar agama Buddha.','2026-03-11 03:48:01','2026-03-11 03:48:01','covers/3vDzW0GpkOmn5vUKMyewYtKzWwIEwtmtBOKUzLay.jpg'),
('Principles of Management','Stephen P. Robbins, Mary Coulter','Pearson',2018,'9780134527604','Manajemen',7,'Buku yang membahas prinsip dasar manajemen organisasi modern.','2026-03-11 03:52:07','2026-03-11 03:52:07','covers/Avs7FoefDNwzNPEVgiOevXf7OZ4UUKe79nEqClL8.webp'),
('Sejarah Kristianitas','Justo L. Gonzalez','BPK Gunung Mulia',2019,'9789794155673','Agama',5,'Buku yang membahas perkembangan gereja dari masa awal hingga modern.','2026-03-11 03:54:55','2026-03-11 03:54:55','covers/nFbJtk3jI6TAcEKUO9gWMftBQPWDNuDnd7TIRGll.jpg');

INSERT INTO `cache` VALUES
('laravel-cache-dosen@lecturer.edu|127.0.0.1:timer','i:1773365559;',1773365559),
('laravel-cache-dosen@lecturer.edu|127.0.0.1','i:1;',1773365559),
('laravel-cache-jdfbs@dknsf|127.0.0.1:timer','i:1773369656;',1773369656),
('laravel-cache-jdfbs@dknsf|127.0.0.1','i:1;',1773369656);


INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_02_13_074709_create_bukus_table',1),
(5,'2026_03_02_044630_create_peminjamen_table',1),
(6,'2026_03_06_013953_create_books_table',1),
(7,'2026_03_11_021745_add_cover_to_bukus_table',2);

INSERT INTO `sessions` VALUES
('UZIHPQnZssmA9oKOu4RSArpljWjO8GfdVTj6Ube2',NULL,'127.0.0.1','Mozilla/5.0 ...','YTozOntzOjY6Il90b2tlbiI7czo0MDoidHZESTlYYk5kdkk5YUx1YlhhNTFUcWRHM2hPQXpRTWloV09VcVRxaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9idWt1LzIxIjtzOjU6InJvdXRlIjtzOjk6ImJ1a3Uuc2hvdyI7fX0=',1773202617),
('y1Ib9vvjbz2m62eC1kvFgEdgeLT4KohFkVte59Yl',NULL,'127.0.0.1','Mozilla/5.0 ...','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkFoZkZUUENwM0xsd292b1FXV2VFcHNOT0JoTWJYcGpONTFLakRnSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9idWt1LzIyIjtzOjU6InJvdXRlIjtzOjk6ImJ1a3Uuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1773298962),
('HOcXEOR4IV0yZo41kQkL4YZjxDIaRUqmiJrUPMyS',NULL,'127.0.0.1','Mozilla/5.0 ...','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTFIYWxiRWg5czZJV0xqYkRpQlRiNXpBdTJDWW52a1cxQ1labU04TCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=',1773369597);

INSERT INTO `users` VALUES
(1,'Test User','test@example.com','2026-03-10 03:10:11','$2y$12$5h5BxFBg3ZqoA62gYqnKrOR2VS7hywP1Xvmkm4altccgcMZhnE64K','S9mODFrrf2','2026-03-10 03:10:11','2026-03-10 03:10:11'),
(2,'Admin Staff','01admin@staff.edu',NULL,'$2y$12$cKP6fNaPx/ImDiDlMug0PudMlV6j.Lke7P6G33VcWspL.ndVfeAS6',NULL,'2026-03-10 03:11:19','2026-03-10 03:11:19'),
(3,'Operator Sistem','02operator@operator.edu',NULL,'$2y$12$iN3p23V7Zm2rGHvx4ECzuewgdVpkGdJDy7/y3qkx0DyX.7Q2b9q2G',NULL,'2026-03-10 03:11:19','2026-03-10 03:11:19'),
(4,'Dosen Pengajar','03dosen@lecture.edu',NULL,'$2y$12$1x7n7cTH2DcGs802Mm2Acuy3qraRn9EaX2HAvazzUtYsOA74J3MBC',NULL,'2026-03-10 03:11:19','2026-03-10 03:11:19'),
(5,'Mahasiswa','04mahasiswa@student.edu',NULL,'$2y$12$8z1Fezv.BrZYPaJWZlhoVuCTEEvlTSkKYqd6bw9ZXFwOn2MePX3c.',NULL,'2026-03-10 03:11:19','2026-03-10 03:11:19'),
(6,'janice nicole','04mahasiswa1@student.edu',NULL,'$2y$12$Nxf9bkziAQR3K25vLIHw/uTz/yhCEkblW9KzcD51eMBgyMbN9VdNG',NULL,'2026-03-10 03:23:48','2026-03-13 01:46:11'),
(7,'aa','03012345@lecture.edu',NULL,'$2y$12$Gm/P/z1/679/uKmntww4POhhHHCDj7N2CZ0nZ6gOiy/YGkIkwVYK.',NULL,'2026-03-13 01:33:17','2026-03-13 01:42:29');

CREATE INDEX IF NOT EXISTS `cache_expiration_index` ON `cache` (`expiration`);
CREATE INDEX IF NOT EXISTS `cache_locks_expiration_index` ON `cache_locks` (`expiration`);
CREATE UNIQUE INDEX IF NOT EXISTS `failed_jobs_uuid_unique` ON `failed_jobs` (`uuid`);
CREATE INDEX IF NOT EXISTS `jobs_queue_index` ON `jobs` (`queue`);
CREATE INDEX IF NOT EXISTS `sessions_last_activity_index` ON `sessions` (`last_activity`);
CREATE INDEX IF NOT EXISTS `sessions_user_id_index` ON `sessions` (`user_id`);
CREATE UNIQUE INDEX IF NOT EXISTS `users_email_unique` ON `users` (`email`);

COMMIT;