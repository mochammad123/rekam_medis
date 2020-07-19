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
    <div class="">
  <table border="0" align="center">
    <tr>
<!--       <td>
        <img style="padding-right:2em; margin-top:-20px;"src='../images/logo-puskesmas.png'width='60'height='60'/>
      </td> -->
      <td style="line-height : 0px">
        <h3 align="center">DATA PASIEN</h3>
        <h4 align="center">Spesialis THT</h4>
        <h4 align="center">Dr. Endang Suherlan, Sp.T.H.T.K.L., M.Kes</h4>
<!--         <h5 align="center">Jl. AKBP AGUSTJIK No. 960 Kecamatan Ilir Barat II (Telp: 021567834)</h5> -->
      </td>
    </tr>
  </table>
</div>
<hr style="width:80%;">
<hr style="width:80%;">
<h4 align="center"><b>Data Pasien</b></h4>
<div>
<table border="1" align="center" style="width:80%;">
  <thead>
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

<!--       <th><span class="fa fa-usd"></span> Harga</th>
      <th><span class="fa fa-cubes"></span> Stok</th> -->
    </tr>
  </thead>
  <tbody>
    <?php
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
<!--         <td id="harga_obat_tampil"><?php echo rupiahkan($row->harga_obat)?></td>
        <td><?php echo "$row->stok_obat"?></td> -->
      </tr>
      <?php
      $n= $n+1;
    }
    ?>
  </tbody>
</table>
<hr style="width:80%;">
<table border="0" style="width:80%;" align="center" >
  <tr>
    <td align="right">
      <?php $bulan= array("","Januari","Febuari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
      ?>
      Makrayu, <?php echo date("j")." ".$bulan[date("n")]." ".date("Y"); ?>
    </td>
  </tr>
  <tr>
    <td style="padding-top:45px; padding-right:55px;" align="right">
      <u><?php echo $username ?></u>
    </td>
  </tr>
</table>
  </div>
</body>
</html>
<script type="text/javascript">
window.print();
</script>
