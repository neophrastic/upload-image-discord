<?php
$host = $_ENV['DB_HOST']; 
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD']; 
$database = $_ENV['DB_DATABASE']; 

$conn = mysqli_connect($host,$username,$password,$database);