<?php 
require("logic.php");

if (!isset($_SESSION['data_siswa']) || empty($_SESSION['data_siswa'])) {
    $_SESSION['error_print_message'] = 'Tidak ada data yang dapat dicetak.';
    header('Location: index.php');
    exit;
}

$data_siswa = $_SESSION['data_siswa'];
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
</head>
<body>
    <div class="container">
        <h3 class="text-center mt-4">Data Siswa</h3>
        <table class="table table-bordered mt-4">
            <thead>
                <tr class="table-container table-primary" style="text-align: center;">
                    <th scope="col">No</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Rayon</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                $print = new AmbilData($nama,$nis,$rayon);
                foreach ($data_siswa as $key => $siswa) {
                    echo "<tr>";
                    echo "<td>" . ($key + 1) . "</td>";
                    echo "<td>" . htmlspecialchars($siswa->nama) . "</td>";
                    echo "<td>" . htmlspecialchars($siswa->nis) . "</td>";
                    echo "<td>" . htmlspecialchars($siswa->rayon) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href='index.php' class='btn btn-primary'>Kembali</a>
    </div>
</body>
</html>