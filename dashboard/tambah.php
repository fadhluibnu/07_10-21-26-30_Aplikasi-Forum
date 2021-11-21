<?php
include '../koneksi.php';
include 'function.php';
session_start();
if (!isset($_SESSION['masuk'])) {
    header('Location: ../login/php');
    exit;
}
$id_user = $_SESSION['masuk'];

if (isset($_POST['submit'])) {
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('Upload Berhasil');
                document.location.href='../dashboard/';
            </script>";
    } else {
        echo "
            <script>
                alert('Upload Gagal');
                document.location.href='../dashboard/';
            </script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">

    <title>Tambah - Forum</title>
</head>

<body>
    <a href="../dashboard/">Kembali</a>
    <form action="" method="post" class="d-flex flex-column ms-3 mt-3" style="width: 50%;" enctype="multipart/form-data">
        <input name="id_user" type="text" value="<?php echo $id_user ?>">
        <label for="gambar">Gambar (optional)</label>
        <input type="file" name="gambar" id="gambar">
        <label for="post">Pesan</label>
        <textarea name="post" id="post" rows="10" placeholder="Masukkan pesan"></textarea>
        <button type="submit" name="submit" class="mt-2">Submit</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>