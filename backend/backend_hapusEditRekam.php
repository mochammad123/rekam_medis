<?php
include"koneksi.php";
if (isset($_POST["hapus"])) {
  $no_rm=$_POST['no_rm'];
  $id_pasien=$_POST['id_pasien'];
  $hapus=mysqli_query($koneksi,"SELECT * FROM tb_rekam_medis where no_rm=$no_rm");
  if ($hapus){
?>

  <script type="text/javascript">
    swal({
      title: "Hapus Data!",
      text: "Apakah anda yakin menghapus data ini?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-warning",
      confirmWarningText: "Ya, keluar",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
        console.log("confirm true");
        $.ajax({
          type: "POST",
          url: "../backend/backend_prosesHapusEditRekam.php",
          data: "no_rm=<?php echo $no_rm; ?>",
          success: function(data) {

          }
        });
        swal({
          title: "Terhapus!",
          text: "Data berhasil dihapus",
          type: "success",
          confirmButtonText: "Oke",
          closeOnConfirm: false
        },
        function(){
         window.location="?m=editRekam&id=<?php echo $id_pasien; ?>";
        });
      } else {
        console.log("confirm false");
        swal("Batal", "Data batal dihapus", "error");
      }
    });
  </script>

<?php
  }
}
 ?>
