<?php
session_start();
 
class AmbilData {
    public $nama, $nis, $rayon;

    public function __construct($nama = null, $nis = 0, $rayon = null) {
        $this->nama = $nama;
        $this->nis = $nis;
        $this->rayon = $rayon;
    }

    public function CetakData() {
        echo "<td>$this->nama</td><td>$this->nis</td><td>$this->rayon</td>";
    }
}

if (!isset($_SESSION['data_siswa'])) {
    $_SESSION['data_siswa'] = array(); // Buat array kosong jika belum ada
}

$error_message = '';
$nama = $nis = $rayon = null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['hapus'])) {
        // Tombol "Hapus" diklik, hapus data terakhir dari session
        array_pop($_SESSION['data_siswa']);
    } else {
        // "Tambah" button clicked, add new data to the session
        $nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : null;
        $nis = isset($_POST['nis']) ? htmlspecialchars($_POST['nis']) : null;
        $rayon = isset($_POST['rayon']) ? htmlspecialchars($_POST['rayon']) : null;

        // Validasi NIS harus berupa integer
        if (!filter_var($nis, FILTER_VALIDATE_INT)) {
            $error_message = 'NIS harus berupa angka.';
        } else {
            // Tambahkan data baru ke dalam session
            $_SESSION['data_siswa'][] = new AmbilData($nama, $nis, $rayon);
        }
    }
}

if ($error_message != '') {
  echo "<div style='color: red;'>$error_message</div>";
}

// Tampilkan semua data siswa yang ada di session



?>

  </div>
</center>

</body>