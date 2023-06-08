<?php
// fetch_data.php

// Connect to the MySQL database
$conn = mysqli_connect('localhost', 'root', '', 'bbt_apps');
if (!$conn) {
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Get the ID from the AJAX request
$id = $_POST['id'];

// Fetch data from the database based on the ID
$query = "SELECT * FROM fixed_assets WHERE no = '$id'";
$result = mysqli_query($conn, $query);

if (!$result) {
  die('Query Error: ' . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

// Convert associative array to an object
$data = (object) $row;

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
