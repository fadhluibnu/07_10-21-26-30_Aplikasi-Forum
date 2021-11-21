<?php
include 'koneksi.php';
session_start();

if (isset($_SESSION['masuk'])) {
    header('Location: ./');
    exit;
}

if (isset($_POST['masuk'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $login = mysqli_fetch_array($query);

    if ($login['username'] == $username) {
        if ($login['password'] == $password) {
            echo "
            <script>
                alert('Login Berhasil')
            </script>";
            $_SESSION['masuk'] = $login['id_user'];
            header('Location: ./');
            exit;
        } else {
            echo "
            <script>
                alert('Password salah')
            </script>";
        }
    } else {
        echo "
        <script>
            alert('Username tidak ditemukan')
        </script>";
    }
}

if (isset($_POST['daftar'])) {
    $username_daftar = $_POST['user_daftar'];
    $password_daftar = $_POST['pass_daftar'];

    $generate = mysqli_query($conn, "SELECT MAX(id) AS maxId FROM user");
    $fect_gen = mysqli_fetch_assoc($generate);
    $id = $fect_gen['maxId'];
    $huruf = 'ID';
    $id_user = $huruf . sprintf('%04s', $id);

    $queryUser = mysqli_query($conn, "SELECT * FROM user");
    $getUser = mysqli_fetch_array($queryUser);

    if ($getUser['username'] == $username_daftar) {
        echo "
        <script>
            alert('Username telah digunakan')
        </script>";
    } else {

        $insertUser = mysqli_query($conn, "INSERT INTO user VALUES ('', '$id_user', '$username_daftar', '$password_daftar')");

        if (!$insertUser) {
            echo "
            <script>
                alert('Terjadi Kesalahan Sistem')
            </script>";
        } else {
            $_SESSION['masuk'] = $id_user;
            header('Location: ./');
            exit;
        }
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
    <link rel="stylesheet" href="style.css">

    <title>Login - Forum</title>
</head>

<body>
    <form action="" method="POST">
        <input type="text" placeholder="Username" name="user">
        <input type="password" placeholder="Password" name="pass">
        <button type="submit" name="masuk">Masuk</button>
    </form>
    <hr>
    <form action="" method="post">
        <input type="text" placeholder="Usernmae" name="user_daftar">
        <input type="password" placeholder="Password" name="pass_daftar">
        <button type="submit" name="daftar">Daftar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>