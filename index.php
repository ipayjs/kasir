<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn-print-all"])) {
  header("Location: print.php");
  exit;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="style.css?version=<?php echo filemtime('style.css'); ?>" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <style>
    <style>
    /* Gaya untuk tabel */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #ddd;
    }

    /* Gaya untuk tombol aksi */
    .btn-action {
      padding: 6px 12px;
      margin: 2px;
    }

    .btn-action i {
      vertical-align: middle;
    }

    .btn-delete {
      background-color: #dc3545;
      color: white;
      border: none;
    }

    .btn-delete:hover {
      background-color: #c82333;
    }
  </style>
  </style>
</head>
<body>
  <div class="container">
    <center><h1>Data Siswa</h1></center>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="container-1">
      <div class="content-1">
        <input type="text" name="nama" placeholder="Nama">    
        <input type="text" name="nis" placeholder="NIS">
        <input type="text" name="rayon" placeholder="Rayon">
      </div>
      <div class="enter-1">
        <button type="submit" style="background-color: #16FF00;" name = "btn-print-all"><i class="bi bi-person-plus"></i> print</button>
        <button type="submit" style="background-color: #16FF00;"><i class="bi bi-person-plus"></i> Tambah</button>
        <button type="submit" style="background-color: #E72929;" name = "hapus"><i class="bi bi-person-dash"></i> Hapus</button>
      </div>
    </form>
  </div>
</div>
<center><div class="pemisah" style = "margin-bottom :40px;"></div></center>
<Center>
 <?php
include("logic.php");

 echo "<center><table style='width: 70%; border: 1px solid black; text-align: center; border-collapse: collapse;'>
 <tr>
     <th>No</th>
     <th>Nama</th>
     <th>NIS</th>
     <th>Rayon</th>
     <th>Action</th>
 </tr> </center>";

if (isset($_SESSION['data_siswa']) && is_array($_SESSION['data_siswa'])) {
foreach ($_SESSION['data_siswa'] as $key => $siswa) {
 echo "<tr><td>".($key+1)."</td>";
 if (is_object($siswa) && method_exists($siswa, 'CetakData')) {
     $siswa->CetakData();
 } else {
     echo "<td>Invalid data</td>";
 }
 echo "<td>
         <form method='post' class='d-inline-block'>
           <input type='hidden' name='delete-index' value='$key'>
           <button type='submit' class='btn btn-danger btn-sm' name='btn-delete'><i class='bi bi-trash'></i></button>
         </form>
       </td>";
 echo "</tr>";
}
} else {
echo "<tr><td colspan='5'>No data found.</td></tr>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn-delete"])) {
$index = $_POST["delete-index"];
unset($_SESSION['data_siswa'][$index]);
$_SESSION['data_siswa'] = array_values($_SESSION['data_siswa']);
header("Location: " . $_SERVER['PHP_SELF']);
exit;
}

echo "</table>";
 
 ?>
 </center>
</body>
</html>
