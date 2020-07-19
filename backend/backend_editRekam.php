<?php
include "koneksi.php";
$id = $_GET['id'];
$query = "SELECT * FROM tb_rekam_medis where no_rm='$id'";
$edit = mysqli_query($koneksi,$query);
$row=mysqli_fetch_object($edit);
 ?>
<div id="no_rm"><?php echo $id ?></div>
<div id="id_pasien"><?php echo $row->id_pasien ?></div>
<div id="tgl_rekam"><?php echo $row->tgl_rekam ?></div>
<div id="NIP"><?php echo $row->NIP ?></div>
<div id="periksa"><?php echo $row->periksa ?></div>
<div id="diagnosa"><?php echo $row->diagnosa ?></div>
<div id="tindakan"><?php echo $row->tindakan ?></div>
