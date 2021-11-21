<?php
include '../koneksi.php';
session_start();
if (!isset($_SESSION['masuk'])) {
    header('Location: ../login.php');
    exit;
}
if (!isset($_GET['id_post'])) {
    header('Location: ../dashboard/');
    exit;
}

$id_post = $_GET['id_post'];
$del_com = mysqli_query($conn, "DELETE FROM comments WHERE id_post=$id_post");
$del_post = mysqli_query($conn, "DELETE FROM postingan WHERE id_post = $id_post");

if ($del_post) {
    echo "
        <script>
            alert('Hapus Berhasil');
            document.location.href='../dashboard/';
        </script>";
} else {
    echo "
        <script>
            alert('Hapus Gagal');
            document.location.href='../dashboard/';
        </script>";
}
