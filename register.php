<?php
require_once "config/database.php";
require_once "config/auth.php";

if (is_login()) {
    header("Location: user/dashboard.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || $email === '' || $password === '') {
        $error = "Nama, email, dan password wajib diisi.";
    } elseif (strlen($password) < 6) {
        $error = "Password minimal 6 karakter.";
    } else {
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();

        if ($check->get_result()->num_rows > 0) {
            $error = "Email sudah terdaftar.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name,email,password,phone,address,role) VALUES (?,?,?,?,?,'user')");
            $stmt->bind_param("sssss", $name, $email, $hash, $phone, $address);

            if ($stmt->execute()) {
                header("Location: login.php?success=registered");
                exit;
            } else {
                $error = "Pendaftaran gagal.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar - Laundry Gen Z</title><link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-body">
<div class="auth-box">
    <div class="logo-big">🧜‍♀️</div>
    <h1>Join the Lagoon 🧜‍♀️</h1>
    <p class="muted">Daftar dan mulai laundry dengan mudah.</p>
    <?php if ($error): ?><div class="alert danger"><?= e($error) ?></div><?php endif; ?>
    <form method="post">
        <label>Nama Lengkap</label><input type="text" name="name" required>
        <label>Email</label><input type="email" name="email" required>
        <label>No. HP</label><input type="text" name="phone">
        <label>Alamat</label><textarea name="address" rows="3"></textarea>
        <label>Password</label><input type="password" name="password" required minlength="6">
        <button class="btn full" type="submit">Daftar 💕</button>
    </form>
    <p class="center">Sudah punya akun? <a href="login.php">Login</a></p>
</div>
</body>
</html>
