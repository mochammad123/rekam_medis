<?php
include "koneksi.php";

if (isset($_POST['submit_tindakan'])) {

$id_pasien = $_POST['id_pasien'];
$tindakan = $_POST['tindakan'];
$biaya = str_replace(".","",$_POST['biaya_tindakan']);
$jam = date("H");

// $sql = "UPDATE tb_rekam_medis SET periksa='$periksa', biaya=(select biaya+$biaya from tb_rekam_medis where id_pasien='$id_periksa') WHERE ";

// update tb_rekam_medis set periksa='tulisan gitu', biaya=biaya+10000 where jam like '16%' and tgl_rekam=current_date();

$sql = "UPDATE tb_rekam_medis SET tindakan='$tindakan', biaya=biaya+$biaya WHERE jam like '$jam%' and tgl_rekam=current_date()";

$input = mysqli_query($koneksi,$sql);

if ($input) {
 ?>
<script type="text/javascript">
    window.location="?m=inputRekam&id=<?php echo $id_pasien ?>";
</script>
<?php
}
}

 ?>
