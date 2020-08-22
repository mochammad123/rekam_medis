<?php
include "koneksi.php";
include "backend_autentifikasi.php";
// $id = $_GET['id_login'];
$_SESSION['username'] = $username;
$id = $_GET['id'];
function rupiahkan($value)
{
  $nilai = "Rp ".number_format($value,2,',','.');
  return $nilai;
}

?>
<html>
  <head>
    <title>Data Pasien</title>
</head>
<body>
<?php
header('Content-Type: application/xls');

header('Content-Disposition: attachment; filename=Data Per-Pasien.xls');
?>
<table border="0" align="center">
    <tr>
      <td style="line-height : 0px; border: 0px solid #3c3c3c;" colspan="6">
        <h3 align="center">DATA REKAM MEDIS</h3>
        <h4 align="center">Spesialis THT</h4>
        <h4 align="center">Dr. Endang Suherlan, Sp.T.H.T.K.L., M.Kes</h4>
      </td>
    </tr>
  </table>
  <table border="0" align="center">
    <tr>
      <td style="line-height : 0px; border: 0px solid #3c3c3c;" colspan="6">
        <h3 align="center">Data Rekam Medis</h3>
      </td>
    </tr>
  </table>

  <?php
$sql = "SELECT * FROM tb_pasien where id_pasien = $id";
$run=mysqli_query($koneksi,$sql);
$hasil = mysqli_fetch_assoc($run);
?>
  <?php
  $tgl_lahir =date_format(date_create($hasil['tgl_lahir']), 'Y');
  $sekarang = date('Y');
  $usia = $sekarang - $tgl_lahir;
  ?>
<table style="font-size: 12px">
  <tr>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left;">NIK</td>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left;">: <?php echo $hasil['NIK']; ?></td>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left; padding-left: 20px">Umur</td>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left;">: <?php echo $usia;?> Tahun</td>
  </tr>
  <tr>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left;">Nama</td>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left;">: <?php echo $hasil['nama']; ?></td>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left; padding-left: 20px">Alamat</td>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left;">: <?php echo $hasil['alamat']; ?></td>
  </tr>
  <tr>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left;">Tempat, Tanggal Lahir</td>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left;">: <?php echo $hasil['tempat_lahir'];?>, <?php echo $hasil['tgl_lahir']; ?></td>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left; padding-left: 20px">Kontak</td>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left;">: <?php echo $hasil['kontak']; ?></td>
  </tr>
  <tr>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left;">Jenis Kelamin</td>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left;">: <?php echo $hasil['jk'];?></td>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left; padding-left: 20px">Alergi Obat</td>
    <td style="border: 0px solid #3c3c3c; line-height : 20px; align: left;">: <?php echo $hasil['alergi_obat']; ?></td>
  </tr>
</table>  
 <style type="text/css">
 body{
  font-family: sans-serif;
 }
 table{
  margin: 20px auto;
  border-collapse: collapse;
 }
 table th,
 table td{
  border: 1px solid #b8b8b8;
  padding: 3px 8px;

 }
 a{
  background: blue;
  color: #fff;
  padding: 8px 10px;
  text-decoration: none;
  border-radius: 2px;
 }

    .tengah{
        text-align: center;
    }
 </style>
 <table style="font-size: 12px">
  <tr>
  <th><span class="fa fa-th-list"></span> No</th>
      <th><span class="fa fa-bars"></span> Tanggal Rekam</th>
      <th><span class="fa fa-bars"></span> Jenis Kunjungan</th>
      <th><span class="fa fa-bars"></span> Periksa</th>
      <th><span class="fa fa-bars"></span> Penyakit</th>
      <th><span class="fa fa-bars"></span> Obat</th>
  </tr>
  <?php 
  // koneksi database
  $n=1;
  $query = mysqli_query($koneksi,"SELECT no_rm,id_pasien,tgl_rekam,jenis_kunjungan,periksa,diagnosa,tindakan from tb_rekam_medis where id_pasien ='$id' order by tgl_rekam asc");
//   $query = mysqli_query($koneksi,"select * from tb_pasien");
  while ($row=mysqli_fetch_object($query))
  {
    ?>
      <tr>
        <td> <?php echo $n ?> </td>
        <td><?php echo "$row->tgl_rekam"?></td>
        <td><?php echo "$row->jenis_kunjungan"?></td>
        <td><?php echo "$row->periksa"?></td>
        <td><?php echo "$row->diagnosa"?></td>
        <td><?php echo "$row->tindakan"?></td>
  </tr>
  <?php 
    $n= $n+1;
  }
  ?>
    <script>
  window.print();
 </script>
</body>
</html>