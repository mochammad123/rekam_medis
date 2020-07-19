<?php
include "koneksi.php";
if(isset($_POST['edit_pasien'])){
$id = $_POST['id_pasien'];
$nik = $_POST['nik'];
$nama = $_POST['nama_pasien'];
$tempat_lahir = $_POST['tempat_lahir_pasien'];
$tgl_lahir = $_POST['tgl_lahir_pasien'];
$jk = $_POST['jk'];
$pekerjaan = $_POST['pekerjaan'];
$alamat = $_POST['alamat'];
$kontak = $_POST['kontak'];
$alergi_obat = $_POST['alergi_obat'];


  $query = "UPDATE tb_pasien SET NIK='$nik',nama='$nama',tempat_lahir='$tempat_lahir',tgl_lahir='$tgl_lahir',jk='$jk',pekerjaan='$pekerjaan',alamat='$alamat',kontak='$kontak',alergi_obat='$alergi_obat' where id_pasien='$id'";

  $input = mysqli_query($koneksi, $query);
  if($input){
    ?>
    <script type="text/javascript">
      swal({
        title: "Data dirubah!",
        text: "data Pasien <?php echo $nama?> telah dirubah",
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
        title:"Maaf",
        text: "Data gagal dirubah!",
        type: "error",
        confirmWarningText: "Oke",
      },
      function(){
        window.location='./';
      });
    </script>
    <?php
  }
}
?>
