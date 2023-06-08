<!DOCTYPE html>
<html>
<head>
    <title>PHP HTML Form with Image Upload and Database Select</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
			<?php if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Form submitted successfully!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
				</div>
			<?php elseif (isset($_GET['success']) && $_GET['success'] === 'false'): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Something error!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
				</div>
			<?php endif; ?>
        <h1><i>UPLOAD DATA LAPHAR</i></h1>
		<ul>
		  <li>Pastikan Gambar Sudah tersusun Rapi</li>
		  <li>Pastikan Narasi Sudah Benar</li>
		  <hr>
		<ul>
        <form method="POST" action="simpan_gambar.php" enctype="multipart/form-data" class="alert alert-info">
			<?php $id_laphar = $_GET["id"] ?>
			<input type="hidden" name="id_laphar" value="<?php echo $id_laphar; ?>">
            <div class="form-group col-md-6">
                <label for="picture"><b>Gambar Laphar:</b></label>
                <input type="file" class="form-control-file" id="picture" name="picture" accept="image/*" required>
            </div>
            <div class="form-group col-md-6">
                <label for="text"><b>Narasi:</b></label>
				<textarea class="form-control" id="text" name="text" placeholder="GIAT SUBBID TEKKOM" required></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="option"><b>Subbid:</b></label>
                <select class="form-control" id="option" name="option" required>
                    <?php
                    // Connect to MySQL server
                    include "koneksi.php";

                    // Retrieve data from MySQL table
                    $query = "SELECT id, nama_subbid FROM subbid";
                    $result = mysqli_query($conn, $query);

                    // Display data in select options
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id'] . '">' . $row['nama_subbid'] . '</option>';
                    }

                    // Close the MySQL connection
                    mysqli_close($conn);
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
