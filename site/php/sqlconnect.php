<?php
$conn = null;

// Create connection

function csatlakozas() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    global $conn;

    if($conn == null) {
        $conn = new mysqli($servername, $username, $password, "jupiter");
        if (!$conn) {
            die("Connection failed: ".mysqli_connect_error());
        }
        mysqli_set_charset($conn, "utf8");
    }

    return $conn;
}

$conn = csatlakozas();
?>