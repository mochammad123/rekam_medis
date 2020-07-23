<?php

include "koneksi.php";

if (isset($_POST["rekam"])) {

$id_pasien = $_POST['id_pasien'];

// $jam = date("H:i:s");
// $biaya = 10000;
// $periksa = $_POST['periksa'];
// $biaya1 = $_POST['biaya_periksa'];
// $biaya_periksa = ($biaya + $biaya1);


$username = $_SESSION['username'];

$sql= "SELECT * FROM tb_dokter where username = '$username'";
$hasil =mysqli_query($koneksi,$sql);
while ($row=mysqli_fetch_object($hasil)) {
  $NIP = $row->NIP; 
}

$id_rawat = $_POST['id_rawat'];
$query = mysqli_query($koneksi,"select * from tb_pendaftaran where id_rawat = '$id_rawat'");
      while ($row=mysqli_fetch_object($query))
      { $tanggal = $row->tanggal;
        $jenis_kunjungan = $row->jenis_kunjungan;
      }

$sql1 = "INSERT INTO tb_rekam_medis (no_rm,id_pasien,tgl_rekam,jenis_kunjungan,NIP) VALUES ('','$id_pasien','$tanggal','$jenis_kunjungan','$NIP')";
$input = mysqli_query($koneksi,$sql1);

if ($input) {
 ?>
<script type="text/javascript">
    window.location="?m=inputRekam&id=<?php echo $id_pasien ?>";
</script>
<?php
}
}
?>
