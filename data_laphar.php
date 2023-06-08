<!DOCTYPE html>
<html>
<head>
    <title>Data View with DataTables</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>



    <div class="container">
        <h1>Data LAPORAN HARIAN</h1>
		<!-- Proses Penambahan ID_Laphar-->
		<form method="POST">
			<button type="submit" name="id_laphar_baru" class="btn btn-info" onclick="return confirm('Are you sure you want to proceed?')">+ Data Laporan</button>
		</form>
		
		<?php
			// Check if the form is submitted
			if(isset($_POST["id_laphar_baru"])){
				// Connect to MySQL server
				include "koneksi.php";
				// Get the latest ID from the table
				$query = "SELECT MAX(id) AS max_id FROM id_laphar";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				$latest_id = $row['max_id']+1;

				// Increment the latest ID
				$new_id = "LHK0".$latest_id;

				// Insert the new record into the table
				$insert_query = "INSERT INTO id_laphar (id_laphar, tanggal) VALUES ('$new_id', NOW())";
				mysqli_query($conn, $insert_query);

				// Close the MySQL connection
				mysqli_close($conn);

				// Redirect back to the form page with success message
				    // Set a session variable to indicate success
				session_start();
				$_SESSION['success'] = true;
				header("Location: data_laphar.php?success=true");
				exit();
			}
		?>
		
		<?php
			// Check if the success session variable is set
			session_start();
			if (isset($_SESSION['success'])) {
				// Display the success alert
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
				echo 'Data submitted successfully!';
				echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
				echo '<span aria-hidden="true">&times;</span>';
				echo '</button>';
				echo '</div>';

				// Unset the success session variable
				unset($_SESSION['success']);
			}
			?>
		
		<!-- Menampilkan data -->
		<hr>
        <div class="table-responsive">
            <table id="data-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Edit</th>
                        <!-- Add more table headers for additional columns -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Connect to MySQL server
                    include "koneksi.php";

                    // Retrieve data from MySQL table
                    $query = "SELECT id_laphar, tanggal FROM id_laphar";
                    $result = mysqli_query($conn, $query);

                    // Display data in the table rows
                    $nomor = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $nomor++ . '</td>';
                        echo '<td>' . $row['id_laphar'] . '</td>';
                        echo '<td>' . $row['tanggal'] . '</td>';
                        echo '<td>6</td>';
                        echo '<td><a href="input_gambar.php?id=' . $row['id_laphar'] . '">Tambah</a> || <a href="susun_laphar.php?id=' . $row['id_laphar'] . '">Susun</a></td>';
                        // Add more table cells for additional columns
                        echo '</tr>';
                    }

                    // Close the MySQL connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#data-table').DataTable();
        });
    </script>
</body>
</html>
