<?php

include '../koneksi.php';

function tambah($dt)
{
    global $conn;
    $id_user = $dt['id_user'];
    $post = htmlspecialchars($dt['post']);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = null;
    } else {
        $gambar = upload();
    }

    $query = "INSERT INTO postingan VALUES ('', '$id_user', '$post', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function ubah($dt)
{
    global $conn;

    $id_post = $dt['id_post'];
    $post = htmlspecialchars($dt['post']);
    $gambarLama = $dt['gambarLama'];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE postingan SET 
                        post = '$post',
                        gambar = '$gambar'
                    WHERE id_post=$id_post";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $size = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp_name = $_FILES['gambar']['tmp_name'];

    // if($error ===4){
    //     echo "
    //     <script>
    //         alert('Username telah digunakan')
    //     </script>";
    // }

    $eks_gb_valid = ['jpg', 'jpeg', 'png'];
    $eks_gb = explode('.', $namaFile);
    $eks_gb = strtolower(end($eks_gb));

    if (!in_array($eks_gb, $eks_gb_valid)) {
        echo "
            <script>
                alert('Gambar tidak valid [jpg, jpeg, png]')
            </script>";
        return false;
    }

    if ($size > 2300000) {
        echo "
            <script>
                alert('Gagal!! Ukuran gambar Melebihi 2MB')
            </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $eks_gb;

    move_uploaded_file($tmp_name, '../image/' . $namaFileBaru);
    return $namaFileBaru;
}
