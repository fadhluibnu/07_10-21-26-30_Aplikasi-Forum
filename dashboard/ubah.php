<?php
include '../koneksi.php';
include 'function.php';
session_start();
if (!isset($_SESSION['masuk'])) {
    header('Location: ../login/php');
    exit;
}
$id_user = $_SESSION['masuk'];
$id_post = $_GET['id_post'];
$query = mysqli_query($conn, "SELECT * FROM postingan WHERE id_post=$id_post");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    if (ubah($_POST) > 0) {
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

    <title>Ubah - Forum</title>
</head>

<body class="bg-light">
    <div class="container m-auto mt-3">
        <div class="row justify-content-center">
            <div class="col-10 col-md-8">
                <div class="bg-white p-3 rounded">
                    <a href="../dashboard/" class="nav-link">Kembali</a>
                    <form action="" method="post" class="d-flex flex-column ms-3 mt-3"  enctype="multipart/form-data">
                        <input type="hidden" name="id_post" id="id_post" value="<?php echo $id_post ?>">
                        <input name="id_user" type="hidden" value="<?php echo $data['id_user'] ?>">
                        <input type="hidden" name="gambarLama" value="<?php echo $data['gambar'] ?>">
                        <label for="gambar" class="form-label">Gambar (optional)</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="gambar" name="gambar" >
                        </div>
                        <img src="../image/<?php echo $data['gambar'] ?>" alt="">
                        <label for="post" class="form-label mt-2">Pesan</label>
                        <textarea name="post" id="post" rows="10" placeholder="Masukkan pesan" class="form-control"></textarea>
                        <button type="submit" name="submit" class="mt-2 btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>