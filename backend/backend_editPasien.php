<?php
include "koneksi.php";
$id=$_GET['id'];
$query = "SELECT NIK,nama,tempat_lahir,tgl_lahir,jk,pekerjaan,alamat,kontak,alergi_obat FROM tb_pasien where id_pasien ='$id'";
$edit = mysqli_query($koneksi,$query);
$row=mysqli_fetch_object($edit);
 ?>
<div id="id_pasien"><?php echo $id ?></div>
<div id="nik"><?php echo $row->NIK ?></div>
<div id="nama_pasien"><?php echo $row->nama ?></div>
<div id="tempat_lahir_pasien"><?php echo $row->tempat_lahir ?></div>
<div id="tgl_lahir_pasien"><?php echo $row->tgl_lahir ?></div>
<div id="jk"><?php echo $row->jk ?></div>
<div id="pekerjaan"><?php echo $row->pekerjaan ?></div>
<div id="alamat"><?php echo $row->alamat ?></div>
<div id="kontak"><?php echo $row->kontak ?></div>
<div id="alergi_obat"><?php echo $row->alergi_obat ?></div>