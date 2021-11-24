<?php
include '../koneksi.php';
session_start();
if (!isset($_SESSION['masuk'])) {
    header('Location: ../login.php');
    exit;
}
if (isset($_POST['kirim'])) {
    $id_post = $_POST['id_post'];
    $id_user = $_POST['id_user'];
    $komentar = $_POST['komentar'];

    $query = mysqli_query($conn, "INSERT INTO comments VALUE ('', '$id_post', '$id_user', '$komentar')");
    header('Location: ./#' . $id_post);
}
$id_user = $_SESSION['masuk'];
$query = mysqli_query($conn, "SELECT * FROM postingan WHERE id_user='$id_user' ORDER BY id_post DESC");
if (isset($_POST['cari'])) {
    $key = $_POST['key'];
    $query = mysqli_query($conn, "SELECT * FROM postingan WHERE post LIKE '%$key%' AND id_user='$id_user' ORDER BY id_post DESC");
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

    <title>Dashboard - Forum</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Forum App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard/">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambah.php">Tambah</a>
                    </li>
                </ul>
                <form action="" method="post" class="d-flex">
                    <input class="form-control me-2" type="search" name="key" id="cari" placeholder="Search..." autocomplete="off" aria-label="Search">
                    <button class="btn btn-outline-light bg-dark" type="submit" name="cari" >Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container m-auto">
        <div class="row justify-content-center">
            <div class="col-10 col-md-6">
                <?php
                while ($data = mysqli_fetch_assoc($query)) : ?>
                    <div id="<?php echo $data['id_post'] ?>" class="mt-3 ms-3 bg-primary border p-3 text-white rounded" style="width: 130%;">
                        <?php
                        $getUser = $data['id_user'];
                        ?>
                        <a href="ubah.php?id_post=<?php echo $data['id_post'] ?>" class="text-white">Ubah</a>
                        <a href="hapus.php?id_post=<?php echo $data['id_post'] ?>" class="text-white">Hapus</a>
                        <?php
                        $query_user = mysqli_query($conn, "SELECT username FROM user WHERE id_user='$getUser'");
                        $user_result = mysqli_fetch_assoc($query_user);
                        ?>
                        <h4><?php echo $user_result['username'] ?></h4>
                        <hr size="4px" style="background-color: #ffffff">
                        <p><?php echo $data['post'] ?></p>
                        <br>
                        <img src="../image/<?php echo $data['gambar'] ?>" alt="" width="50%">
                        <h5>Komentar :</h5>
                        <?php
                        $id_post = $data['id_post'];
                        $query_com = mysqli_query($conn, "SELECT * FROM comments WHERE id_post=$id_post");
                        while ($comm = mysqli_fetch_assoc($query_com)) : ?>
                            <div class="bg-light mb-2 text-dark p-2 rounded">
                                <?php
                                $getUserCom = $comm['id_user'];
                                $query_user_com = mysqli_query($conn, "SELECT username FROM user WHERE id_user='$getUserCom'");
                                $user_result = mysqli_fetch_assoc($query_user_com);
                                ?>
                                <h6><?php echo $user_result['username'] ?> :</h6>
                                <div class="ms-2">
                                    <p><?php echo $comm['comments'] ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <form action="" method="POST" class="d-flex flex-column">
                            <label for="komentar<?php echo $data['id_post'] ?>">Berikan Komentar :</label>
                            <input class="mt-2" type="text" name="id_user" value="<?php echo $_SESSION['masuk'] ?>">
                            <input type="hidden" class="mt-2" name="id_post" value="<?php echo $data['id_post'] ?>">
                            <textarea class="mt-2 me-2" name="komentar" id="komentar<?php echo $data['id_post'] ?>" placeholder="Berikan komentar..." autocomplete="off" style="width: 100%;" required></textarea>
                            <button type="submit" name="kirim" class="btn btn-light col-md-2 mt-2" style="background-color: #ffffff">Kirim</button>

                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>


    <form action="" method="post" class="ms-3 mt-3" style="width: 50%;">
        <input type="search" name="key" id="cari" placeholder="Telusuri..." autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>