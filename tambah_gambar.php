<!DOCTYPE html>
<html>
<head>
    <title>DATA GAMBAR LAPORAN HARIAN</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
<body>



    <div class="container">
        <h3>DATA GAMBAR LAPORAN HARIAN</h3>
		<!-- Menampilkan data -->
		<ul>
			<li>Silahkan Tambahkan Data Gambar yang akan di susun</li>
		</ul>
		<hr>
        <div class="table-responsive">
            <table id="data-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Gambar</th>
                        <th>Narasi</th>
                        <th>Subbid</th>
                        <th>Tanggal</th>
                        <th>Edit</th>
                        <!-- Add more table headers for additional columns -->
                    </tr>
                </thead>
                <tbody>
				
				<!-- Proses Penambahan Gambar Laphar-->
		
			<?php
				// Connect to MySQL server
                    include "koneksi.php";
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
                    // Retrieve data from MySQL table
					$id_laphar_baru = $_GET['id'];
                    $query = "SELECT * FROM data_gambar WHERE id_laphar != '$id_laphar_baru'";
                    $result = mysqli_query($conn, $query);

                    // Display data in the table rows
                    
                    $nomor = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $nomor++ . '</td>';
                        echo '<td><img height="10" width="10" src="images/' . $row['nama_file'] . '"></td>';
                        echo '<td width ="550">' . $row['narasi'] . '</td>';
                        echo '<td>' . $row['id_subbid'] . '</td>';
                        echo '<td>' . date('d-m-Y', strtotime($row['tanggal_input'])) . '</td>';
                        echo '<td>
									<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal2" id="data-kemodal" 
									data-kemodal12="' . $row['nama_file'] . '" 
									data-kemodal13="' . $row['narasi'] . '" 
									data-kemodal14="' . $row['id_subbid'] . '" 
									data-kemodal15="' . $id_laphar_baru . '" 
									value="' . $row['id'] . '">Edit Data</button>
								</td>';
                        // Add more table cells for additional columns
                        echo '</tr>';
						// Check jika user ingin menambahakn Gambar Baru
						if(isset($_POST["id_laphar_baru"])){
							// Insert the new record into the table
							$insert_query2 = "INSERT INTO data_gambar (nama_file, narasi, id_subbid, id_laphar)
														VALUES ('" . $row['nama_file'] . "', '" . $row['narasi'] . "', '" . $row['id_subbid'] . "', '" . $id_laphar_baru . "')";
							mysqli_query($conn, $insert_query2);
							// Close the MySQL connection
							mysqli_close($conn);

							// Redirect back to the form page with success message
								// Set a session variable to indicate success
							$_SESSION['success'] = true;
							//header("Location: data_laphar.php?success=true");
							exit();
						}
					}
				
                    // Close the MySQL connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
		<form action="" method="POST">
	<div class="modal fade" tabindex="-1" role="dialog" id="myModal2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin ingin menambahkan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<div>
					<input type="hidden" id="nama_file" value="" readonly=""></input>
					<input type="hidden" id="narasi" value="" readonly=""></input>
					<input type="hidden" id="id_lapharbaru" value="" readonly=""></input>
					<input type="hidden" id="id_subbid" value="" readonly=""></input>
					<input type="hidden" id="id_laphar" value="" readonly=""></input>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="simpan_gambar_baru">YA</button>
			  </div>
			</div>
		  </div>
	</div><!-- /.modal -->
</form>
    </div>
    
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#data-table').DataTable();
        });
		// Mngirimkan Data ke Modal untuk tambah gambar baru
		$(document).on("click","#data-kemodal",function(){
			var sn = $(this).data("kemodal12"),
				narasi = $(this).data("kemodal13"),
				id_subbid = $(this).data("kemodal14"),
				id_laphar_baru = $(this).data("kemodal15")
				;
			$(".modal-body #nama_file").val(sn);
			$(".modal-body #id_lapharbaru").val(id_laphar_baru);

		});
		
		//Form Submit Untuk jadi gambar baru
		$(document).on("click","#simpan_gambar_baru",function(){
			var gambar_lama = $("#nama_file").val(),
				id_laphar_baru = $("#id_lapharbaru").val();
				// linknya = window.location.href;
			$.ajax({
				type : "get",
				url : "proses_tambah_gambar.php?&do=edit&nama_file="+gambar_lama+"&id_laphar_baru="+id_laphar_baru,
				success : function(hasilnya){
					console.log(hasilnya);
					// $(".sn_lama").val("HARUSNYA INI DIA SEKARANG");
					$(".edit_class").val();
					$('#myModal').modal('hide')
				}
			});	
		});//

    </script>
</body>
</html>
