<?php
include "koneksi.php";

if (isset($_POST['submit_periksa'])) {

$id_periksa = $_POST['id_pasien'];
$periksa = $_POST['periksa'];
$biaya = str_replace(".","",$_POST['biaya_periksa']);
$jam = date("H");
$tgl_rekam = $_POST]['tgl_rekam'];

// $sql = "UPDATE tb_rekam_medis SET periksa='$periksa', biaya=(select biaya+$biaya from tb_rekam_medis where id_pasien='$id_periksa') WHERE ";

// update tb_rekam_medis set periksa='tulisan gitu', biaya=biaya+10000 where jam like '16%' and tgl_rekam=current_date();

// $sql = "UPDATE tb_rekam_medis SET periksa='$periksa', biaya=biaya+$biaya WHERE jam like '$jam%' and tgl_rekam=current_date()";

$sql = "UPDATE tb_rekam_medis SET periksa='$periksa' WHERE id = '$id_periksa'";

$input = mysqli_query($koneksi,$sql);

if ($input) {
 ?>
<script type="text/javascript">
    window.location="?m=inputRekam&id=<?php echo $id_periksa ?>";
</script>
<?php
}
}

 ?>
