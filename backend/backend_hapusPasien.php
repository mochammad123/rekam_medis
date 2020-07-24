<?php
include"koneksi.php";
if (isset($_POST["hapus"])) {
  $id=$_POST['id'];
  $hapus=mysqli_query($koneksi,"SELECT * FROM tb_pasien where id_pasien=$id");
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
          url: "../backend/backend_prosesHapusPasien.php",
          data: "id=<?php echo $id; ?>",
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
         window.location="?m=dataPasien";
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
