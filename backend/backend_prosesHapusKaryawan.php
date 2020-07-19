<?php
include "koneksi.php";

$id = $_POST['id'];
// $hapus = $koneksi->query('DELETE FROM tb_obat where id_obat = "'.$id.'"');
$hapus=mysqli_query($koneksi,"SELECT * FROM tb_karyawan where id_karyawan=$id");

if($hapus){
    echo "success deleted";
    $koneksi->query('DELETE FROM tb_karyawan where id_karyawan = "'.$id.'"');
}else{
    echo "something wrong while deleting";
}

?>