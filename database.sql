CREATE DATABASE IF NOT EXISTS laundry_genz;
USE laundry_genz;

DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(30) DEFAULT NULL,
    address TEXT DEFAULT NULL,
    role ENUM('user','admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    price INT NOT NULL,
    unit VARCHAR(30) NOT NULL DEFAULT 'kg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice VARCHAR(30) NOT NULL UNIQUE,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    weight DECIMAL(10,2) NOT NULL,
    total INT NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    payment_status ENUM('Belum Bayar','Menunggu Verifikasi','Lunas') NOT NULL DEFAULT 'Belum Bayar',
    order_status ENUM('Menunggu','Diproses','Dicuci','Siap Diambil','Selesai','Dibatalkan') NOT NULL DEFAULT 'Menunggu',
    notes TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE RESTRICT
);

INSERT INTO users (name, email, password, phone, address, role) VALUES
('Admin Laundry', 'admin@genzlaundry.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCz3t4m5v6qj9eJmQm', '081234567890', 'Alamat Laundry', 'admin'),
('Aulia User', 'user@genzlaundry.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCz3t4m5v6qj9eJmQm', '081234567891', 'Alamat User', 'user');

INSERT INTO services (name, description, price, unit) VALUES
('Cuci Kering Mermaid', 'Cuci + kering + lipat, wangi laut yang fresh', 7000, 'kg'),
('Cuci Setrika Pearl', 'Cuci + kering + setrika + lipat', 10000, 'kg'),
('Setrika Siren', 'Setrika dan lipat pakaian', 6000, 'kg'),
('Express Ocean 1 Hari', 'Layanan cepat selesai 1 hari', 15000, 'kg');

-- Password demo untuk kedua akun: password
