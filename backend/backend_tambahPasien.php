<?php
include"koneksi.php";
if(isset($_POST['tambah_pasien'])){

  $nik = $_POST['nik'];
  $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tb_pasien WHERE NIK='$nik'"));
    if ($cek > 0){
      echo "<script>alert('NIK sudah terdaftar');</script>";
    }else {
  $input = mysqli_query($koneksi,"INSERT INTO tb_pasien VALUES ('','".$_POST[nik]."','".$_POST[nama_pasien]."','".$_POST[tempat_lahir_pasien]."','".$_POST[tgl_lahir_pasien]."','".$_POST[jk]."','".$_POST[pekerjaan]."','".$_POST[alamat]."','".$_POST[kontak]."','".$_POST[alergi_obat]."')");
}
// var_dump("INSERT INTO tb_pasien VALUES ('','".$_POST[nama_pasien]."','".$_POST[tgl_lahir_pasien]."','".$_POST[jk]."','".$_POST[agama]."','".$_POST[pekerjaan]."','".$_POST[pendidikan]."','".$_POST[alamat]."')");
  
if($input){
    ?>
    <script type="text/javascript">
swal({
  title: "Data tersimpan!",
  text: "Pendaftaran pasien baru berhasil",
  type: "success",
  confirmButtonText: "Oke",
  closeOnConfirm: false
},
function(){
  window.location="?m=dataPasien";
});
</script>
    <?php
  }else {
    ?>
    <script type="text/javascript">
    swal({
                    title: "",
                    text: "Data gagal disimpan!",
                    type: "failed",
                    confirmWarningText: "Oke"
                },
                function () {
                    window.location='./';
                });
    </script>
    <?php
  }
}
?>