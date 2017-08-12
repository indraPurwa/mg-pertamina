<?php
//koneksi ke database
$servername = "localhost";
$dbusername	= "root";
$dbpassword	= "";
$db_name	= "logbook";
$conn       = new mysqli($servername, $dbusername, $dbpassword, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
