<?php
include"../../../backend/koneksi.php";
$nama= mysqli_query($koneksi,"SELECT nama,id_pasien from tb_pasien where id_pasien='".$_GET['id_pasien']."'");
while ($baris=mysqli_fetch_object($nama)) {
  $nama_pasien=$baris->nama;
  $id=$baris->id_pasien;
}
$sql1= mysqli_query($koneksi,"SELECT tb_rekam_medis.tgl_rekam,tb_rekam_medis.jenis_kunjungan,tb_rekam_medis.periksa,tb_rekam_medis.diagnosa,tb_rekam_medis.tindakan,tb_dokter.nama from tb_rekam_medis inner join tb_dokter on tb_rekam_medis.NIP=tb_dokter.NIP where id_pasien='".$_GET['id_pasien']."' and jenis_kunjungan='baru'");
$hitung1=mysqli_num_rows($sql1);
$sql2= mysqli_query($koneksi,"SELECT tb_rekam_medis.tgl_rekam,tb_rekam_medis.jenis_kunjungan,tb_rekam_medis.periksa,tb_rekam_medis.diagnosa,tb_rekam_medis.tindakan,tb_dokter.nama from tb_rekam_medis inner join tb_dokter on tb_rekam_medis.NIP=tb_dokter.NIP where id_pasien='".$_GET['id_pasien']."' and jenis_kunjungan='lama'");
$hitung2=mysqli_num_rows($sql2);
$sql= mysqli_query($koneksi,"SELECT tb_rekam_medis.tgl_rekam,tb_rekam_medis.jenis_kunjungan,tb_rekam_medis.periksa,tb_rekam_medis.diagnosa,tb_rekam_medis.tindakan,tb_dokter.nama from tb_rekam_medis inner join tb_dokter on tb_rekam_medis.NIP=tb_dokter.NIP where id_pasien='".$_GET['id_pasien']."'");
$hitung=mysqli_num_rows($sql);
 ?>
 <div id="isi">
   <div id="nama_pasien">
     <h2><small><?php echo $nama_pasien ?></small></h2>
   </div>
   <div id="jml_kunjungan">
     <h3><small>Jumlah Kunjungan     : <?php echo $hitung ?></small></h3>
   </div>
   <div id="jml_kunjungan_baru">
     <h4><small>Jumlah Kunjungan Baru : <?php echo $hitung1 ?></small></h4>
   </div>
   <div id="jml_kunjungan_baru">
     <h4><small>Jumlah Kunjungan Lama : <?php echo $hitung2 ?></small></h4>
   </div>
   <div>
     <br>
   </div>
   <table class="table table-bordered">
     <tr>
       <th>No</th>
       <th>Tanggal Periksa</th>
       <th>Dokter</th>
       <th>Jenis Kunjungan</th>
       <th>Periksa</th>
       <th>Diagnosa</th>
       <th>Tindakan</th>
     </tr>
     <?php
     $n=1;
     while ($row=mysqli_fetch_object($sql)) {
       ?>
       <tr>
         <td><?php echo $n ?></td>
         <td><?php echo "$row->tgl_rekam"?></td>
         <td><?php echo "$row->nama"?></td>
         <td><?php echo "$row->jenis_kunjungan"?></td>
         <td><?php echo "$row->periksa"?></td>
         <td><?php echo "$row->diagnosa"?></td>
         <td><?php echo "$row->tindakan"?></td>
       </tr>
       <?php
       $n= $n+1;
     }
     ?>
   </table>
 </div>
