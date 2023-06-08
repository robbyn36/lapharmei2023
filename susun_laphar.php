<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Data Display Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    th, td {
      border: 1px solid #dee2e6;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f8f9fa;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <h2>SUSUN LAPORAN HARIAN</h2>
  <hr>
  <div >
  <?php $id_laphar = $_GET["id"]?>
	<a type="button" href="tambah_gambar.php?id=<?php echo $id_laphar; ?>" class="btn btn-info">Tambah Data</a>
  </div>
  <br>
  <form action="p.susun_laphar.php" method="POST">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th width="500">Narasi</th>
            <th>Urutan</th>
            <th>Select</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Connect to your database
          include 'koneksi.php';

          // Retrieve the data from the database
          $id_laphar = $_GET["id"];
          $query = "SELECT * FROM data_gambar WHERE id_laphar ='$id_laphar' ";
          $result = $conn->query($query);

          // Display the data in the table
          if ($result) {
            $susun = 1; //artinya masuk ke dalam sususan
            $counter = 1;
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>".$counter."</td>";
              echo "<td style='display:none'><input type='text' name='id_laphar[]' value='".$id_laphar."'></input></td>";
              echo "<td style='display:none'><input type='text' name='id_gambar[]' value='".$row['nama_file']."'></input></td>";
              echo "<td class='col-ms-3'><img src='images/".$row['nama_file']."' alt='Image' width='100'></td>";
              echo "<td class='col-ms-6'>".$row['narasi']."</td>";
              echo "<td class='col-ms-1'>
                      <select name='urutan[]' class='form-control'>
                        <option value='1'>1</option>";
              for ($i = 2; $i <= $result->num_rows; $i++) {
                echo "<option value='".$i."'>".$i."</option>";
              }
              echo "</select>
                    </td>";
              echo "<td class='col-ms-2'>
                      <select name='susun[]' class='form-control'>
                      <option value='1'>Y</option>
                      <option value='0'>T</option>
                    </select>
                </td>";
              echo "</tr>";
              $counter++;
            }
            $result->free();
          } else {
            echo "Query failed: " . $conn->error;
          }

          // Close the database connection
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
    <br>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <input type="submit" value="Submit" class="btn btn-primary btn-block">
      </div>
    </div>
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
