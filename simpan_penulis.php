<?php
header('Content-Type: application/json');
require 'koneksi.php';

$nama_depan   = trim($_POST['nama_depan']   ?? '');
$nama_belakang = trim($_POST['nama_belakang'] ?? '');
$user_name    = trim($_POST['user_name']    ?? '');
$password     = $_POST['password']          ?? '';

if (!$nama_depan || !$nama_belakang || !$user_name || !$password) {
    echo json_encode(['status' => 'error', 'message' => 'Semua field wajib diisi']);
    exit;
}

$foto = 'default.png';
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $file     = $_FILES['foto'];
    $maxSize  = 2 * 1024 * 1024;

    if ($file['size'] > $maxSize) {
        echo json_encode(['status' => 'error', 'message' => 'Ukuran file maksimal 2 MB']);
        exit;
    }

    $finfo    = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);
    $allowed  = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    if (!in_array($mimeType, $allowed)) {
        echo json_encode(['status' => 'error', 'message' => 'Tipe file tidak diizinkan. Gunakan JPG, PNG, GIF, atau WEBP']);
        exit;
    }

    $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
    $namaFile = uniqid('penulis_', true) . '.' . strtolower($ext);
    $tujuan   = __DIR__ . '/uploads_penulis/' . $namaFile;

    if (!move_uploaded_file($file['tmp_name'], $tujuan)) {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengupload foto']);
        exit;
    }
    $foto = $namaFile;
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$stmt = $koneksi->prepare("INSERT INTO penulis (nama_depan, nama_belakang, user_name, password, foto) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param('sssss', $nama_depan, $nama_belakang, $user_name, $hashedPassword, $foto);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Penulis berhasil ditambahkan']);
} else {
    if ($koneksi->errno == 1062) {
        echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data: ' . $koneksi->error]);
    }
}

$stmt->close();
$koneksi->close();
