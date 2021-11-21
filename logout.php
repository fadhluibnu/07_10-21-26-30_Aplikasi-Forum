<?php
session_start();
session_unset();
session_destroy();
if (!isset($_SESSION['masuk'])) {
    header('Location: login.php');
    exit;
}
