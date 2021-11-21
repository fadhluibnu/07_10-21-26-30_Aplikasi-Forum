<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['masuk'])) {
    header('Location: login.php');
    exit;
}
if (isset($_POST['kirim'])) {
    $id_post = $_POST['id_post'];
    $id_user = $_POST['id_user'];
    $komentar = $_POST['komentar'];

    $query = mysqli_query($conn, "INSERT INTO comments VALUE ('', '$id_post', '$id_user', '$komentar')");
    header('Location: ./#' . $id_post);
}
$query = mysqli_query($conn, 'SELECT * FROM postingan');
if (isset($_POST['cari'])) {
    $key = $_POST['key'];
    $query = mysqli_query($conn, "SELECT * FROM postingan WHERE post LIKE '%$key%'");
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
    <link rel="stylesheet" href="style.css">

    <title>Beranda - Forum</title>
</head>

<body>

    <form action="" method="post" class="ms-3 mt-3" style="width: 50%;">
        <input type="search" name="key" id="cari" placeholder="Telusuri..." autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>
    <a href="logout.php">Logout</a>
    <a href="dashboard/">Dashboard</a>
    <?php
    while ($data = mysqli_fetch_array($query)) : ?>
        <div id="<?php echo $data['id_post'] ?>" class="mt-3 ms-3 bg-primary border p-3 text-white rounded" style="width: 50%;">
            <?php
            $getUser = $data['id_user'];
            $query_user = mysqli_query($conn, "SELECT username FROM user WHERE id_user='$getUser'");
            $user_result = mysqli_fetch_assoc($query_user);
            ?>
            <h4><?php echo $user_result['username'] ?></h4>
            <p><?php echo $data['post'] ?></p>
            <img src="image/<?php $data['gambar'] ?>" alt="">
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
                <textarea class="mt-2" name="komentar" id="komentar<?php echo $data['id_post'] ?>" required></textarea>
                <button type="submit" name="kirim" class="btn btn-light mt-2"> Kirim</button>
            </form>
        </div>
    <?php endwhile; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>