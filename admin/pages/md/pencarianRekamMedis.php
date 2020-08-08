<?php
include '../../../backend/koneksi.php';
?>
<div id="isi_tabel">
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
    <tr style="font-size: 12px">
        <th><span class="fa fa-th-list"></span> No</th>
        <th><span class="fa fa-th-list"></span> NIK</th>
        <th><span class="fa fa-user"></span> Nama</th>
        <th><span class="fa fa-location-arrow"></span> Tempat Lahir</th>
        <th><span class="fa fa-calendar"></span> Tanggal lahir</th>
        <th><span class="fa fa-child"></span> Umur</th>
        <th><span class="fa fa-venus-mars"></span> Jenis Kelamin</th>
        <th><span class="fa fa-briefcase"></span> Pekerjaan</th>
        <th><span class="fa fa-map-marker"></span> Alamat</th>
        <th><span class="fa fa-address-book"></span> Kontak</th>
        <th><span class="fa fa-cogs"></span> Opsi</th>
              </tr>
  </thead>
  <tbody id="isi_tabel">
<?php
  $n=1;
  $query = mysqli_query($koneksi,"select * from tb_pasien where nama like '%".$_GET['q']."%' order by nama asc ");
  while ($row=mysqli_fetch_object($query))
  {
   ?>
<?php
// cari umur
$tgl_lahir =date_format(date_create($row->tgl_lahir), 'Y');
$sekarang = date('Y');
$usia = $sekarang - $tgl_lahir;
?>
<tr style="font-size: 12px">
    <td> <?php echo $n ?> </td>
    <td> <?php echo "$row->NIK" ?> </td>
    <td><?php echo "$row->nama"?></td>
    <td><?php echo "$row->tempat_lahir"?></td>
    <td><?php echo "$row->tgl_lahir"?></td>
    <td><?php echo  $usia?> Tahun</td>
    <td><?php echo "$row->jk"?></td>
    <td><?php echo "$row->pekerjaan"?></td>
    <td><?php echo "$row->alamat"?></td>
    <td><?php echo "$row->kontak"?></td>
    <td>
        <form class="" action="" method="post">
        <button type="button" class="btn btn-default btn-flat btn-sm" onclick="tampilRekam('<?php echo $row->id_pasien; ?>')" title="Detail" data-toggle="tooltip">
        <i class="fa fa-info-circle"></i>
        </button>
        <input type="hidden" name="id_pasien" value="<?php echo $row->id_pasien; ?>">
        <button name="lihat" class="btn btn-warning btn-flat btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Proses">
        <i class="fa fa-info-circle"></i>
        </button>
        </form>
        </td>
        </tr>
   <?php
   $n= $n+1;
}
?>
</tbody>
</table>
</div>
</div>