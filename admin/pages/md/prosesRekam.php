<link rel="stylesheet" href="../css/sweetalert.css" media="screen" title="no title">
<link rel="stylesheet" href="../css/bootstrap.min.css" media="screen" title="no title">
<?php
include"../backend/koneksi.php";
$cekpoli=mysqli_query($koneksi,"SELECT jenis_poli from tb_dokter where username='".$_SESSION['username']."'");
while ($row=mysqli_fetch_object($cekpoli)) {
  $Poli=$row->jenis_poli;
}
 ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Daftar Kunjungan
      <small>control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Daftar Kunjungan</li>
    </ol>
  </section>


<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa "></i> Informasi Data Kunjungan (<?php echo $Poli; ?>)
      </h2>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">
            <button class="btn btn-primary" id="tombolList">
              List Rawat
            </button>
            <button class="btn btn-primary" id="tombolSelesai">
              List Selesai
            </button>
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" id="list">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <tr>
              <th><span class="fa fa-th-list"></span> No</th>
              <th><span class="fa fa-th-list"></span> No. CM</th>
              <th><span class="fa fa-user"></span> Nama Pasien</th>
              <th><span class="fa fa-calendar"></span> Tanggal</th>
              <th><span class="fa fa-clock-o"></span> Jenis Kunjungan</th>
              <th><span class="fa fa-refresh"></span> Proses</th>
              <th><span class="fa fa-check-square-o"></span> Status</th>
              <th><span class="fa fa-hourglass-half"></span> Keterangan</th>
              <th><span class="fa fa-cogs"></span> Opsi</th>
            </tr>

      <?php
      $n=1;
      $query = mysqli_query($koneksi,"select * from tb_pendaftaran where proses = '".$_SESSION['poli']."' and keterangan = 'Menunggu...'");
      while ($row=mysqli_fetch_object($query))
      {
       ?>
       <tr>
         <td><?php echo $n ?></td>
         <td><?php echo "$row->no_cm"?></td>
         <td><?php echo "$row->nama"?></td>
         <td><?php echo "$row->tanggal"?></td>
         <td><?php echo "$row->jenis_kunjungan"?></td>
         <td><?php echo "$row->proses"?></td>

         <td><span class="label label-success"><?php echo "$row->status"?></span></td>
         <td><span class="label label-warning"><?php echo "$row->keterangan"?></span></td>
         <td>
           <form class="" action="" method="post">
             <input type="hidden" name="id_rawat" value="<?php echo $row->id_rawat; ?>">
             <input type="hidden" name="id_pasien" value="<?php echo $row->id_pasien; ?>">

             <button name="rekam" class="btn btn-default btn-flat btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Proses">
               <i class="glyphicon glyphicon-eye-open"></i>
             </button>

             <input type="hidden" name="id" value="<?php echo $row->id_rawat; ?>">


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
  </table>
  </div>
  </div>

    <div class="modal fade" id="editLayanan" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="">Ubah Layanan</h4>
        </div>
        <form class="" action="" method="post">
          <input type="hidden" name="id_rawat" id="id_rawat" value="">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Layanan</label>
            <select class="form-control" name="jenis_poli" id="layanan">
              <?php
              $tampil=mysqli_query($koneksi,"select * from tb_jenis_poli");
              while($row=mysqli_fetch_array($tampil)){
                echo "<option value=$row[nama_jenis] >$row[nama_jenis]</option>";
              }
              echo "<option value='belum dipilih' selected>- pilih spesialis -</option>";
               ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" name="ubahLayanan">Simpan</button>
        </div>
      </form>
      </div>
    </div>
  </div>


  <!-- /.box-header -->
  <div class="box-body" id="selesai" style="display:none">
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <tr>
        <th><span class="fa fa-th-list"></span> No</th>
        <th><span class="fa fa-th-list"></span> No. CM</th>
        <th><span class="fa fa-user"></span> Nama Pasien</th>
        <th><span class="fa fa-calendar"></span> Tanggal</th>
        <th><span class="fa fa-clock-o"></span> Jenis Kunjungan</th>
        <th><span class="fa fa-refresh"></span> Proses</th>
        <th><span class="fa fa-check-square-o"></span> Status</th>
        <th><span class="fa fa-hourglass-half"></span> Keterangan</th>
        <th><span class="fa fa-cogs"></span> Opsi</th>
      </tr>

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
      
        $result_count = mysqli_query($koneksi,"SELECT COUNT(*) As total_records FROM `tb_pendaftaran`");
        $total_records = mysqli_fetch_array($result_count);
        $total_records = $total_records['total_records'];
          $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total page minus 1
      
                  
                  // $query = mysqli_query($koneksi,"select * from tb_pasien order by nama asc ");
                  $result = mysqli_query($koneksi,"select * from tb_pendaftaran where proses = '".$_SESSION['poli']."' and keterangan = 'selesai' limit $offset, $total_records_per_page");
                  $n=1;
                  while ($row=mysqli_fetch_object($result))
                  {
                   ?>
            <?php
            // cari umur
            $tgl_lahir =date_format(date_create($row->tgl_lahir), 'Y');
            $sekarang = date('Y');
            $usia = $sekarang - $tgl_lahir;

?>
 <tr>
   <td><?php echo $n ?></td>
   <td><?php echo "$row->no_cm"?></td>
   <td><?php echo "$row->nama"?></td>
   <td><?php echo "$row->tanggal"?></td>
   <td><?php echo "$row->jenis_kunjungan"?></td>
   <td><?php echo "$row->proses"?></td>

   <td><span class="label label-success"><?php echo "$row->status"?></span></td>
   <td><span class="label label-success"><?php echo "$row->keterangan"?></span></td>
   <td>
     <form class="" action="" method="post">
       <input type="hidden" name="id_rawat" value="<?php echo $row->id_rawat; ?>">
       <input type="hidden" name="id_pasien" value="<?php echo $row->id_pasien; ?>">

       <button type="submit" class="btn btn-danger btn-flat btn-sm" name="hapus" data-toggle="tooltip" data-placement="bottom" title="Hapus">
         <i class="glyphicon glyphicon-remove"></i>
       </button>
     </form>
  </td>
 </tr>
 <?php
 $n= $n+1;
}
?>
</table>
<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<ul class="pagination">
  <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
  <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no > 1){ echo "href='?m=prosesRekam&page_no=$previous_page'"; } ?>>Previous</a>
  </li>

  <?php 
  if ($total_no_of_pages <= 10){     
    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
      if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?m=prosesRekam&page_no=$counter'>$counter</a></li>";
        }
        }
  }
  elseif($total_no_of_pages > 10){
    
  if($page_no <= 4) {     
   for ($counter = 1; $counter < 8; $counter++){     
      if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?m=prosesRekam&page_no=$counter'>$counter</a></li>";
        }
        }
    echo "<li><a>...</a></li>";
    echo "<li><a href='?m=prosesRekam&page_no=$second_last'>$second_last</a></li>";
    echo "<li><a href='?m=prosesRekam&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    }

   elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {     
    echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {     
           if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?m=prosesRekam&page_no=$counterpage_no=$counter'>$counter</a></li>";
        }                  
       }
       echo "<li><a>...</a></li>";
     echo "<li><a href='?m=prosesRekam&page_no=$second_last'>$second_last</a></li>";
     echo "<li><a href='?m=prosesRekam&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
    
    else {
        echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?m=prosesRekam&page_no=$counter'>$counter</a></li>";
        }                   
                }
            }
  }
?>
    
  <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no < $total_no_of_pages) { echo "href='?m=prosesRekam&page_no=$next_page'"; } ?>>Next</a>
  </li>
    <?php if($page_no < $total_no_of_pages){
    echo "<li><a href='?m=prosesRekam&page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
    } ?>
</ul>

</div>
</div>
  </div>
  </div>
  </div>
  </section>
  </div>
  <script src="../js/sweetalert.min.js"></script>
  <script src="../js/jquery-2.1.3.min.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script type="text/javascript">
    $('button').tooltip();
  </script>
  <!-- <script type="text/javascript">
function editLayanan(id){
  $.ajax({
    type: "GET",
    url : "../backend/backend_editLayanan.php",
    data: "id="+id,
    success: function (data){
     var $response = $(data);
       $('#id_rawat').val($response.filter('#id_rawat').text());
       $('#layanan').val($response.filter('#layanan').text());
       $('#editLayanan').modal('show');
    }
  });
}
</script> -->
  <script type="text/javascript">

  $(document).ready(function(){
    $("#tombolList").click(function(){
      $("#list").show();
      $("#selesai").hide();
    });
    $("#tombolSelesai").click(function(){
      $("#selesai").show();
      $("#list").hide();
    });
  });
  </script>
  <?php include_once '../backend/backend_inputRm.php';
   ?>
