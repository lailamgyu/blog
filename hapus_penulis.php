<?php
header('Content-Type: application/json');
require 'koneksi.php';

$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
    exit;
}

// Cek apakah penulis masih punya artikel
$stmtCek = $koneksi->prepare("SELECT COUNT(*) AS jml FROM artikel WHERE id_penulis = ?");
$stmtCek->bind_param('i', $id);
$stmtCek->execute();
$cek = $stmtCek->get_result()->fetch_assoc();
$stmtCek->close();

if ($cek['jml'] > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Penulis tidak dapat dihapus karena masih memiliki artikel']);
    exit;
}

$stmtFoto = $koneksi->prepare("SELECT foto FROM penulis WHERE id = ?");
$stmtFoto->bind_param('i', $id);
$stmtFoto->execute();
$row = $stmtFoto->get_result()->fetch_assoc();
$stmtFoto->close();

$stmt = $koneksi->prepare("DELETE FROM penulis WHERE id = ?");
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    if ($row && $row['foto'] !== 'default.png') {
        $fotoPath = __DIR__ . '/uploads_penulis/' . $row['foto'];
        if (file_exists($fotoPath)) unlink($fotoPath);
    }
    echo json_encode(['status' => 'success', 'message' => 'Penulis berhasil dihapus']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
}

$stmt->close();
$koneksi->close();
