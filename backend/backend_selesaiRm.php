<?php
include "koneksi.php";

if (isset($_POST['selesai'])) {
$id_pasien = $_POST['id'];
$no_rm = $_POST['no_rm'];
$no_cm = $_POST['no_cm'];
$tgl_transaksi = date('Y-m-d');

$sql3="UPDATE tb_pendaftaran set keterangan = 'Selesai' where no_cm= '$no_cm'";
$selesai = mysqli_query($koneksi,$sql3) or die(mysqli_error());

if ($selesai) {
  ?>
  <script type="text/javascript">
  swal({
    title: "No.CM : <?php echo $no_cm?>",
    text: "Apakah pasien ini sudah selesai?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-warning",
    confirmWarningText: "Ya, belum",
    closeOnConfirm: false
  },
  function() {
    swal({
      title: "Pemeriksaan selesai!",
      text: "Data berhasil disimpan",
      type: "success",
      confirmButtonText: "Oke",
      closeOnConfirm: false
    },
    function(){
      window.location="?m=prosesRekam";
    });
  });
  </script>
  <?php
}
}
 ?>

