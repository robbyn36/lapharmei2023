


<?php
// Connect to MySQL server
include "koneksi.php";
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the uploaded file details
    $file_name = $_FILES["picture"]["name"];
    $file_tmp = $_FILES["picture"]["tmp_name"];
    $file_type = $_FILES["picture"]["type"];
    $file_size = $_FILES["picture"]["size"];

    // Rename the file
    $new_file_name = time() . '_' . $file_name;

    // Upload the file to the "images" folder
    $upload_directory = "images/";
    $target_file = $upload_directory . $new_file_name;

    if (move_uploaded_file($file_tmp, $target_file)) {
        // File uploaded successfully

        // Get the form data
        $text = $_POST["text"];
        $option_id = $_POST["option"];
        $id_laphar = $_POST["id_laphar"];

        // Insert data into the database
        $query = "INSERT INTO data_gambar (nama_file, narasi, id_subbid,id_laphar ) VALUES ('$new_file_name', '$text', '$option_id', '$id_laphar')";

        if (mysqli_query($conn, $query)) {
            // Data inserted successfully
            header("Location: input_gambar.php?id=" . $id_laphar . "&success=true");
            exit();
        } else {
            // Error inserting data
            header("Location: input_gambar.php?id=" . $id_laphar . "&success=false&error=" . urlencode(mysqli_error($conn)));
            exit();
        }
    } else {
        // Error uploading file
        header("Location: input_gambar.php?success=false&error=Error%20uploading%20file.");
        exit();
    }
}

// Close the MySQL connection
mysqli_close($conn);
?>
