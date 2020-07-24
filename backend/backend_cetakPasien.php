<?php
include "koneksi.php";
include "backend_autentifikasi.php";
// $id = $_GET['id_login'];
$_SESSION['username'] = $username;
function rupiahkan($value)
{
  $nilai = "Rp ".number_format($value,2,',','.');
  return $nilai;
}

?>
<html>
  <head>
    <title>Data Pasien THT</title>
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
 <table>
  <tr style="font-size: 12px">
  <th><span class="fa fa-th-list"></span> No</th>
      <th><span class="fa fa-bars"></span> NIK</th>
      <th><span class="fa fa-bars"></span> Nama</th>
      <th><span class="fa fa-bars"></span> Tempat Tanggal Lahir</th>
      <th><span class="fa fa-bars"></span> Umur</th>
      <th><span class="fa fa-bars"></span> Jenis Kelamin</th>
      <th><span class="fa fa-bars"></span> Pekerjaan</th>
      <th><span class="fa fa-bars"></span> Alamat</th>
      <th><span class="fa fa-bars"></span> Kontak</th> 
  </tr>
  <?php 
  // koneksi database
  $n=1;
  $query = mysqli_query($koneksi,"select * from tb_pasien");
  while ($row=mysqli_fetch_object($query))
  {
    ?>
    <?php
      // cari umur
      $tgl_lahir =date_format(date_create($row->tgl_lahir), 'Y');
      $sekarang = date('Y');
      $usia = $sekarang - $tgl_lahir;
        ?>  
      <tr style="font-size: 12px">
        <td> <?php echo $n ?> </td>
        <td><?php echo "$row->NIK"?></td>
        <td><?php echo "$row->nama"?></td>
        <td><?php echo "$row->tempat_lahir, $row->tgl_lahir"?></td>
        <td><?php echo $usia?> Tahun</td>
        <td><?php echo "$row->jk"?></td>
        <td><?php echo "$row->pekerjaan"?></td>
        <td><?php echo "$row->alamat"?></td>
        <td><?php echo "$row->kontak"?></td>
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
