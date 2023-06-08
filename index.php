<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Data Table</h2>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>ID LAPHAR</th>
          <th>Tanggal</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Connect to your database
          include 'koneksi.php';          
          // Retrieve the data from the database
          $query = "SELECT * FROM data_laphar GROUP BY id_laphar";
          $result = $conn->query($query);
          $no = 0;
          // Display the data in the table
          if ($result) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>".$no++."</td>";
              echo "<td>".$row['id_laphar']."</td>";
              echo "<td>".$row['tanggal']."</td>";
              echo "<td><a href='./susun_laphar.php?id=".$row['id_laphar']."' type='button' class='btn btn-info'>Susun</a></td>";
              echo "</tr>";
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
</div>

</body>
</html>
