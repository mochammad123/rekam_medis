<?php
include "koneksi.php";

$id = $_POST['id'];
// $hapus = $koneksi->query('DELETE FROM tb_obat where id_obat = "'.$id.'"');
$hapus=mysqli_query($koneksi,"SELECT * FROM tb_pendaftaran where id_rawat=$id");

if($hapus){
    echo "success deleted";
    $koneksi->query('DELETE FROM tb_pendaftaran where id_rawat = "'.$id.'"');
}else{
    echo "something wrong while deleting";
}

?>