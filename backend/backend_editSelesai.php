<?php
include "koneksi.php";
$id = $_GET['id'];
$query = "SELECT * FROM tb_pendaftaran where no_cm='$id'";
$edit = mysqli_query($koneksi,$query);
$row=mysqli_fetch_object($edit);
 ?>
<div id="id_rawat"><?php echo $row->id_rawat ?></div>
<div id="nama"><?php echo $row->id_pasien ?></div>
<div id="tanggal"><?php echo $row->tangga; ?></div>
<div id="jenis_kunjungan"><?php echo $row->jenis_kunjungan ?></div>
<div id="proses"><?php echo $row->proses ?></div>
<div id="status"><?php echo $row->status ?></div>
<div id="keterangan"><?php echo $row->keterangan ?></div>
<div id="id_pasien"><?php echo $row->id_pasien ?></div>
<div id="id_karyawan"><?php echo $row->id_karyawan ?></div>
<div id="no_cm"><?php echo $id ?></div>