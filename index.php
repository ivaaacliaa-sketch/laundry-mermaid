<?php
require_once "config/database.php";
require_once "config/auth.php";
require_once "config/helpers.php";
$services = $conn->query("SELECT * FROM services ORDER BY id ASC");
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Laundry Gen Z 🧜‍♀️</title><link rel="stylesheet" href="assets/css/style.css"></head><body>
<header class="navbar"><div class="brand">🧜‍♀️ Laundry Gen Z</div><nav><a href="index.php">Home</a><a href="#layanan">Layanan</a>
<?php if(is_login()): ?><a class="btn btn-small" href="<?= is_admin()?'admin/dashboard.php':'user/dashboard.php' ?>">Dashboard</a><a href="logout.php">Logout</a>
<?php else: ?><a href="login.php">Login</a><a class="btn btn-small" href="register.php">Daftar</a><?php endif; ?></nav></header>
<section class="hero"><div class="hero-text"><span class="eyebrow">🌊 Fresh • Clean • Gen Z 🌊</span>
<h1>Clean clothes, <span>mermaid vibes</span> 🧜‍♀️✨</h1><p>Laundry Gen Z hadir dengan layanan laundry yang praktis, aesthetic, dan penuh vibes bawah laut. Tinggal pesan, bayar, lalu santai.</p>
<div class="hero-buttons"><a href="register.php" class="btn">Mulai Laundry 🫧</a><a href="#layanan" class="btn btn-outline">Lihat Layanan</a></div></div>
<div class="mermaid-stage"><div class="mermaid">🧜‍♀️</div><div class="mermaid-bubble b1"></div><div class="mermaid-bubble b2"></div><div class="mermaid-bubble b3"></div><div class="shell">🐚</div><div class="fish one">🐠</div><div class="fish two">🐟</div><div class="seaweed one">🌿</div><div class="seaweed two">🌿</div></div></section>
<section id="layanan" class="section"><div class="section-title"><span class="eyebrow">Our Mermaid Services</span><h2>Pilih layanan favoritmu 🫧</h2><p>Harga jelas, proses gampang, vibes-nya tetap cantik.</p></div>
<div class="cards"><?php while($service=$services->fetch_assoc()): ?><div class="card service-card"><div class="service-icon">🧺</div><h3><?= e($service['name']) ?></h3><p><?= e($service['description']) ?></p><strong><?= rupiah($service['price']) ?> / <?= e($service['unit']) ?></strong></div><?php endwhile; ?></div></section>
<section class="section soft"><div class="steps"><div><b>01</b><h3>Daftar/Login</h3><p>Buat akun untuk masuk ke dunia Laundry Gen Z.</p></div><div><b>02</b><h3>Pesan</h3><p>Pilih layanan dan masukkan berat laundry.</p></div><div><b>03</b><h3>Bayar 💸</h3><p>Pilih QRIS, e-wallet, atau transfer bank.</p></div><div><b>04</b><h3>Ambil</h3><p>Pantau status sampai laundry siap diambil.</p></div></div></section>
<footer>🌊 Made with 🩷 and mermaid energy by Laundry Gen Z 🧜‍♀️</footer></body></html>