<?php
include "koneksi.php";

$id = $_POST['no_rm'];
// $hapus = $koneksi->query('DELETE FROM tb_obat where id_obat = "'.$id.'"');
$hapus=mysqli_query($koneksi,"SELECT * FROM tb_rekam_medis where no_rm=$id");

if($hapus){
    echo "success deleted";
    $koneksi->query('DELETE FROM tb_rekam_medis where no_rm = "'.$id.'"');
}else{
    echo "something wrong while deleting";
}

?>