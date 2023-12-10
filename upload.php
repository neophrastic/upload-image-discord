<?php
require 'koneksi.php';

if (isset($_POST['title'])) {
    echo "awdawd";
    $title = $_POST['title'];
    $url = $_POST['url'];

    $result = mysqli_query($conn, "INSERT INTO data (text,image) VALUES ('$title','$url')");

    header('Location: index.php');
}