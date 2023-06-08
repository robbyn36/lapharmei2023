<?php 
// Connect to your database
include "koneksi.php";

// Sample data
$data = $_POST;

// Prepare and execute the SQL statement
$stmt = $conn->prepare("INSERT INTO susun_laphar (id_laphar, id_gambar, urutan, susun) VALUES (?, ?, ?, ?)");

$stmt->bind_param("ssss", $id_laphar, $id_gambar, $urutan, $susun);

foreach ($data["id_laphar"] as $key => $value) {
    $id_laphar = $value;
    $id_gambar = $data["id_gambar"][$key];
    $urutan = $data["urutan"][$key];
    $susun = $data["susun"][$key];

    $stmt->execute();
}

// Close the statement and database connection
$stmt->close();
$conn->close();

 ?>