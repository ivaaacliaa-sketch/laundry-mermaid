<?php
require_once "config/database.php";
require_once "config/auth.php";

if (is_login()) {
    header("Location: " . (is_admin() ? "admin/dashboard.php" : "user/dashboard.php"));
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        user_login($user);
        header("Location: " . ($user['role'] === 'admin' ? "admin/dashboard.php" : "user/dashboard.php"));
        exit;
    } else {
        $error = "Email atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Laundry Gen Z</title><link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-body">
<div class="auth-box">
    <div class="logo-big">🧜‍♀️</div>
    <h1>Welcome back, mermaid! 🧜‍♀️</h1>
    <p class="muted">Login ke Laundry Gen Z 💗</p>
    <?php if ($error): ?><div class="alert danger"><?= e($error) ?></div><?php endif; ?>
    <form method="post">
        <label>Email</label>
        <input type="email" name="email" required placeholder="contoh@email.com">
        <label>Password</label>
        <input type="password" name="password" required placeholder="••••••••">
        <button class="btn full" type="submit">Login ✨</button>
    </form>
    <div class="demo-box">
        <b>Akun demo</b><br>
        Admin: admin@genzlaundry.test / password<br>
        User: user@genzlaundry.test / password
    </div>
    <p class="center">Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
    <p class="center"><a href="index.php">← Kembali ke Home</a></p>
</div>
</body>
</html>
