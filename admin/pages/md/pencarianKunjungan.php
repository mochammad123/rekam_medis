<?php
include '../../../backend/koneksi.php';
?>
<?php 
if(isset($_POST["tanggal_awal"], $_POST["tanggal_akhir"]))  
{ 
  $query = mysqli_query($koneksi,"SELECT tb_rekam_medis.tgl_rekam,tb_rekam_medis.jenis_kunjungan,tb_rekam_medis.periksa,tb_rekam_medis.diagnosa,tb_rekam_medis.tindakan,tb_pasien.NIK,tb_pasien.nama from tb_rekam_medis inner join tb_pasien on tb_rekam_medis.id_pasien=tb_pasien.id_pasien WHERE tgl_rekam BETWEEN '".$_POST["tanggal_awal"]."' AND '".$_POST["tanggal_akhir"]."'");  
  $hitung1=mysqli_num_rows($query); 
?>
<h6>
<i class="fa "></i> Jumlah Kunjungan : <?php echo $hitung1 ?>
</h6>
<div id="isi_tabel">
  <table class="table table-bordered table-striped">
    <thead>
    <tr style="font-size: 12px">
             <th><span class="fa fa-th-list"></span> No</th>
             <th><span class="fa fa-check-square-o"></span> NIK</th>
             <th><span class="fa fa-user"></span> Nama Pasien</th>
             <th><span class="fa fa-calendar"></span> Tanggal</th>
             <th><span class="fa fa-clock-o"></span> Jenis Kunjungan</th>
             <th><span class="fa fa-stethoscope"></span> Periksa</th>
             <th><span class="fa fa-heartbeat"></span> Diagnosa</th>
             <th><span class="fa fa-user-md"></span> Tindakan</th>
    </tr>
  </thead>
  <tbody id="isi_tabel">
<?php
  $n=1;
if(mysqli_num_rows($query) > 0)  
 { 
  while ($row=mysqli_fetch_object($query))
  {
   ?>
   <tr style="font-size: 12px">
    <td> <?php echo $n ?> </td>
    <td> <?php echo "$row->NIK" ?> </td>
    <td><?php echo "$row->nama"?></td>
    <td><?php echo "$row->tgl_rekam"?></td>
    <td><?php echo "$row->jenis_kunjungan"?></td>
    <td><?php echo "$row->periksa"?></td>
    <td><?php echo "$row->diagnosa"?></td>
    <td><?php echo "$row->tindakan"?></td>
   </tr>
   <?php
   $n= $n+1;
  }
 }
 else {
   ?>
   <tr style="text-align: center;">
   <td colspan="8">Data tidak ditemukan!</td>
   </tr>
   <?php
 }
?>
</tbody>
</table>
<?php
}
?>
</div>
