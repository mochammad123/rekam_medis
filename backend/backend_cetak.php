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
        <h3 align="center">Data Pasien</h3>
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
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left;">NIK</td>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left;">: <?php echo $hasil['NIK']; ?></td>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left; padding-left: 20px">Umur</td>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left;">: <?php echo $usia;?> Tahun</td>
  </tr>
  <tr>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left;">Nama</td>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left;">: <?php echo $hasil['nama']; ?></td>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left; padding-left: 20px">Alamat</td>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left;">: <?php echo $hasil['alamat']; ?></td>
  </tr>
  <tr>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left;">Tempat, Tanggal Lahir</td>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left;">: <?php echo $hasil['tempat_lahir'];?>, <?php echo $hasil['tgl_lahir']; ?></td>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left; padding-left: 20px">Kontak</td>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left;">: <?php echo $hasil['kontak']; ?></td>
  </tr>
  <tr>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left;">Jenis Kelamin</td>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left;">: <?php echo $hasil['jk'];?></td>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left; padding-left: 20px">Alergi Obat</td>
    <td style="border: 0px solid #3c3c3c; line-height : 40px; align: left;">: <?php echo $hasil['alergi_obat']; ?></td>
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
 <!-- <table>
  <tr>
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
      <tr>
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



<?php
include "koneksi.php";
$id = $_GET['id'];
?>
<html>
  <head>
  <style type="text/css">
</style>
</head>
  <body>
    <div class="head">
  <table border="0" align="center">
    <tr>
      <td>
        <img style='padding-right:2em'src='../images/logo-puskesmas.png'width='60'height='60'/>
      </td>
      <td style="line-height : 0px">
        <h3 align="center">PEMERINTAH KOTA PALEMBANG</h4>
        <h4 align="center">DINAS KESEHATAN</h5>
        <h4 align="center"> <small>PUKESMAS MAKRAYU</small> </h5>
      </td>
    </tr>
  </table>
</div>
<div id="body">
<?php
$sql = "SELECT * FROM tb_pasien where id_pasien = $id";
$run=mysqli_query($koneksi,$sql);
$hasil = mysqli_fetch_assoc($run);
?>
<div class="">
<table border="0" padding-left="65px" style="line-height : 35px" width="370px">
  <tr>
    <td>Nama</td>
    <td>: <?php echo $hasil['nama']; ?></td>
  </tr>
  <tr>
    <td>Tanggal Lahir</td>
    <td>: <?php echo $hasil['tgl_lahir']; ?></td>
  </tr>
  <?php
  $tgl_lahir =date_format(date_create($hasil['tgl_lahir']), 'Y');
  $sekarang = date('Y');
  $usia = $sekarang - $tgl_lahir;
  ?>
    <tr>
    <td>Umur</td>
    <td>: <?php echo $usia;?> Tahun</td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td>: <?php echo $hasil['jk']; ?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>: <?php echo $hasil['alamat']; ?></td>
  </tr>
  </table> -->
  <h4 align="center"><b>--Kartu harus dibawa ketika berobat--</b></h4>
  </div>
</body>
<script type="text/javascript">
window.print();
</script>
</div>
</html>
