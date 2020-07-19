<?php
include "koneksi.php";
if(isset($_POST['edit_rekam'])){

$id = $_POST['no_rm'];
$id_pasien = $_POST['id_pasien'];
$periksa = $_POST['periksa'];
$diagnosa = $_POST['diagnosa'];
$tindakan = $_POST['tindakan'];
$tgl_rekam = $_POST['tgl_rekam'];
// $harga = $_POST['harga_obat'];
// $stok = $_POST['stok_obat'];


  $query = "UPDATE tb_rekam_medis SET periksa='$periksa',diagnosa='$diagnosa',tindakan='$tindakan' where no_rm = '$id'";
  
  $input = mysqli_query($koneksi, $query);

  if($input){
    ?>
    <script type="text/javascript">
      swal({
        title: "Data dirubah!",
        text: "Input Rekam Medis Berhasil",
        type: "success",
        confirmButtonText: "Oke",
        closeOnConfirm: false
      },
      function(){
        window.location="?m=inputRekam&id=<?php echo $id_pasien ?>";
      });
    </script>
    <?php
  }else {
    ?>
    <script type="text/javascript">
      swal({
        title: "Maaf",
        text: "Data gagal dirubah!",
        type: "error",
        confirmWarningText: "Oke",
      },
      function (){
        window.location='?m=inputRekam&id=<?php echo $id_pasien ?>';
      });
    </script>
    <?php
  }
}
?>
