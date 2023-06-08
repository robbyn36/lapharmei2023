<?php
if ($_GET) {
    $action = $_GET["do"];
    if ($action == "edit") {
        // Step 1: Search for data based on the given ID
        include "koneksi.php";
        $nama_file = $_GET['nama_file']; // Assuming the ID is passed as a parameter

        $query = "SELECT * FROM data_gambar WHERE nama_file = '$nama_file'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            
            // Check if the same data is already inserted
            $id_laphar = $_GET['id_laphar_baru'];
            $checkQuery = "SELECT * FROM data_gambar WHERE nama_file = '$nama_file' AND id_laphar = '$id_laphar'";
            $checkResult = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                echo "The same data is already inserted.";
            } else {
                // Step 2: Insert data with different values but the same ID
                $newData = "new data"; // Modify this value with your desired new data
                $nama_file = $row["nama_file"];
                $narasi = $row["narasi"];
                $id_subbid = $row["id_subbid"];

                $insertQuery = "INSERT INTO data_gambar (nama_file, narasi, id_subbid, id_laphar) 
                                VALUES ('$nama_file', '$narasi', '$id_subbid', '$id_laphar')";
                $insertResult = mysqli_query($conn, $insertQuery);

                if ($insertResult) {
                    echo "Data inserted successfully!";
                } else {
                    echo "Error inserting data: " . mysqli_error($conn);
                }
            }
        } else {
            echo "No data found for the given ID.";
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>
