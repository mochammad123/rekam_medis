<?php
include '../../../backend/koneksi.php';
?>
<?php 
  $query = mysqli_query($koneksi,"SELECT tb_rekam_medis.tgl_rekam,tb_rekam_medis.jenis_kunjungan,tb_rekam_medis.periksa,tb_rekam_medis.diagnosa,tb_rekam_medis.tindakan,tb_pasien.NIK,tb_pasien.nama from tb_rekam_medis inner join tb_pasien on tb_rekam_medis.id_pasien=tb_pasien.id_pasien WHERE diagnosa LIKE '%".$_GET['q']."%' ORDER BY tb_rekam_medis.tgl_rekam ASC");  
  $hitung1=mysqli_num_rows($query); 
?>
<div id="list">
<div class="table-responsive">
  <table class="table table-bordered table-striped">
  <h6 style="text-align: right;">
    <a name="cetak" href="../backend/backend_cetakKunjungan2.php?pencari=<?php echo $_GET['q'] ?>" target="_blank" class="btn btn-primary btn-flat btn-xs" style="size: 5px">
    <i class="glyphicon glyphicon-print"></i>
    cetak
    </a>

    <i class="fa "></i> Jumlah Kunjungan : <?php echo $hitung1 ?>
  </h6>
    <thead>
    <tr style="font-size: 12px">
             <th><span class="fa fa-th-list"></span> No</th>
             <th><span class="fa fa-check-square-o"></span> NIK</th>
             <th><span class="fa fa-user"></span> Nama Pasien</th>
             <th><span class="fa fa-calendar"></span> Tanggal</th>
             <th><span class="fa fa-clock-o"></span> Jenis Kunjungan</th>
             <th><span class="fa fa-stethoscope"></span> Periksa</th>
             <th><span class="fa fa-heartbeat"></span> Penyakit</th>
             <th><span class="fa fa-user-md"></span> Tindakan</th>
    </tr>
  </thead>
  <tbody id="list">
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
   ?>
   <form class="" action="" method="post">
                   <input type="hidden" name="id_pasien" value="<?php echo $data->id_pasien; ?>">
                   <input type="hidden" name="no_rm" value="<?php echo $data->no_rm; ?>">
  <?php
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
</div>
<?php
?>
</div>
