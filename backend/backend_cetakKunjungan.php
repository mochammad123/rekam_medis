<?php
include "koneksi.php";
include "backend_autentifikasi.php";
// $id = $_GET['id_login'];
$_SESSION['username'] = $username; 
$tanggal_awal = $_GET['tgl_awal'];
$tanggal_akhir = $_GET['tgl_akhir'];
$pencarian = $_GET['pencarian'];
?>
<html>
  <head>
    <title>Data Pasien</title>
</head>
<body>
<table border="0" align="center">
    <tr>
      <td style="line-height : 0px; border: 0px solid #3c3c3c;">
        <h3 align="center">DATA REKAM MEDIS</h3>
        <h4 align="center">Spesialis THT</h4>
        <h4 align="center">Dr. Endang Suherlan, Sp.T.H.T.K.L., M.Kes</h4>
      </td>
    </tr>
    <tr>
      <td style="line-height : 0px; border: 1px solid #b8b8b8;">
      </td>
    </tr>
  </table>
  <table border="0" align="center">
    <tr>
      <td style="line-height : 0px; border: 0px solid #3c3c3c;">
        <h3 align="center">Data Rekam Medis</h3>
      </td>
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
      <th><span class="fa fa-check-square-o"></span> NIK</th>
      <th><span class="fa fa-user"></span> Nama Pasien</th>
      <th><span class="fa fa-calendar"></span> Tanggal</th>
      <th><span class="fa fa-clock-o"></span> Jenis Kunjungan</th>
      <th><span class="fa fa-stethoscope"></span> Periksa</th>
      <th><span class="fa fa-heartbeat"></span> Penyakit</th>
      <th><span class="fa fa-user-md"></span> Tindakan</th>
  </tr>
  <?php 
  // koneksi database
  $n=1;
  $query = mysqli_query($koneksi,"SELECT tb_rekam_medis.tgl_rekam,tb_rekam_medis.jenis_kunjungan,tb_rekam_medis.periksa,tb_rekam_medis.diagnosa,tb_rekam_medis.tindakan,tb_pasien.NIK,tb_pasien.nama from tb_rekam_medis inner join tb_pasien on tb_rekam_medis.id_pasien=tb_pasien.id_pasien WHERE diagnosa LIKE '%$pencarian%' AND tgl_rekam BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY tb_rekam_medis.tgl_rekam ASC");
//   $query = mysqli_query($koneksi,"select * from tb_pasien");
  while ($row=mysqli_fetch_object($query))
  {
    ?>
      <tr>
    <td> <?php echo $n ?> </td>
    <td> <?php echo "$row->NIK" ?> </td>
    <td><?php echo "$row->nama"?></td>
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