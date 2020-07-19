<?php
include '../../../backend/koneksi.php';
?>
<div id="isi_tabel">
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
      if (isset($_GET['page_no']) && $_GET['page_no']!="") {
  $page_no = $_GET['page_no'];
  } else {
    $page_no = 1;
        }

        $total_records_per_page = 10;
  $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2";

  $result_count = mysqli_query($koneksi,"SELECT COUNT(*) As total_records FROM `tb_pasien`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1
  ?>  

<?php
  $n=1;
  $query = mysqli_query($koneksi,"select * from tb_pasien where nama like '%".$_GET['q']."%' order by nama asc limit $offset, $total_records_per_page");
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
         <input type="hidden" name="id" value="<?php echo $row->id_pasien; ?>">
         <a name="cetak" href="../backend/backend_cetak.php?id=<?php echo $row->id_pasien; ?>" target="_blank" class="btn btn-default btn-flat btn-sm">
           <i class="glyphicon glyphicon-print"></i>
         </a>
         <button type="button" class="btn btn-warning btn-flat btn-sm" onclick="editPasien(<?php echo $row->id_pasien; ?>)">
           <i class="glyphicon glyphicon-edit"></i>
         </button>
         <button type="submit" class="btn btn-danger btn-flat btn-sm" name="hapus">
           <i class="glyphicon glyphicon-remove"></i>
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
<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>

<ul class="pagination">
  <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
  <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
  </li>

  <?php 
  if ($total_no_of_pages <= 10){     
    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
      if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?m=dataPasien&page_no=$counter'>$counter</a></li>";
        }
        }
  }
  elseif($total_no_of_pages > 10){

      if($page_no <= 4) {     
   for ($counter = 1; $counter < 8; $counter++){     
      if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?mdataPasie&npage_no=$counter'>$counter</a></li>";
        }
        }
    echo "<li><a>...</a></li>";
    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    }

       elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {     
    echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {     
           if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?m=dataPasien&page_no=$counterpage_no=$counter'>$counter</a></li>";
        }                  
       }
       echo "<li><a>...</a></li>";
     echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
     echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }

                else {
        echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?m=dataPasien&page_no=$counter'>$counter</a></li>";
        }                   
                }
            }
  }
?>

<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
  </li>
    <?php if($page_no < $total_no_of_pages){
    echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
    } ?>
</ul>




  </div>
</div>
</div>
