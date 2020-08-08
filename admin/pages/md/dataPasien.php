<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/dataTables.bootstrap4.min.css">
<script src="js/jquery-3.5.1.js"></script>
<script src="js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="../css/sweetalert.css" media="screen" title="no title">
<link rel="stylesheet" href="../css/scroll.css" media="screen" title="no title">
<link rel="stylesheet" href="css/bootstrap.min.css">
<?php
include"../backend/koneksi.php";
 ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pasien
      <small>control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Pasien</li>
    </ol>
  </section>


<section class="box-body scroll">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header box-header with-border">
          <i class="fa fa-user"></i> <b>Data Pasien</b>
        </h2>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <button class="btn btn-primary" data-toggle="modal" data-target="#piu">
                Pasien Baru
              </button>
              <a name="cetak" href="../backend/backend_exportPasien.php" target="_blank" class="btn btn-primary">
                <i class="fa fa-download"></i>
                Download
              </a>

              <a name="cetak" href="../backend/backend_cetakPasien.php" target="_blank" class="btn btn-default">
                <i class="fa fa-print"></i>
                Cetak
              </a>
            </h3>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 180px;">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" id="cari" placeholder="Pencarian..." class="form-control pull-right" onkeyup="cari()">
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body" id="isi_tabel">
            <div class="inner">
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
            <tbody>
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

            
            // $query = mysqli_query($koneksi,"select * from tb_pasien order by nama asc ");
            $result = mysqli_query($koneksi,"select * from tb_pasien ORDER BY nama ASC limit $offset, $total_records_per_page");
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
             <!-- <tr style="font-size: 12px"> -->
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
                   <a name="cetak" href="../backend/backend_cetak.php?id=<?php echo $row->id_pasien; ?>" target="_blank" class="btn btn-default btn-flat btn-xs" style="size: 5px">
                     <i class="glyphicon glyphicon-print"></i>
                   </a>
                   <button type="button" class="btn btn-warning btn-flat btn-xs" onclick="editPasien(<?php echo $row->id_pasien; ?>)">
                     <i class="glyphicon glyphicon-edit"></i>
                   </button>
                   <button type="submit" class="btn btn-danger btn-flat btn-xs" name="hapus">
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
</div>
    <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<ul class="pagination">
  <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
  <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no > 1){ echo "href='?m=dataPasien&page_no=$previous_page'"; } ?>>Previous</a>
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
           echo "<li><a href='?m=dataPasien&page_no=$counter'>$counter</a></li>";
        }
        }
    echo "<li><a>...</a></li>";
    echo "<li><a href='?m=dataPasien&page_no=$second_last'>$second_last</a></li>";
    echo "<li><a href='?m=dataPasien&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
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
     echo "<li><a href='?m=dataPasien&page_no=$second_last'>$second_last</a></li>";
     echo "<li><a href='?m=dataPasien&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
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
  <a <?php if($page_no < $total_no_of_pages) { echo "href='?m=dataPasien&page_no=$next_page'"; } ?>>Next</a>
  </li>
    <?php if($page_no < $total_no_of_pages){
    echo "<li><a href='?m=dataPasien&page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
    } ?>
</ul>




  </div>
</div>
  <!-- /.box-body -->
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</div>
</div>
<!-- /.col -->
    </div>
    </section>
    <!-- modal tambah pasien -->
    <div class="modal fade" id="piu" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Form Data Pasien</h4>
          </div>
          <form class="" action="" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label for="">NIK</label>
                <input type="text" class="form-control" name="nik" required="required">
              </div>
              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama_pasien" required="required">
                <p class="help-block">Nama lengkap pasien</p>
              </div>
                <div class="form-group">
                <label for="">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir_pasien" required="required">
                <p class="help-block">Nama lengkap pasien</p>
              </div>
              <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir_pasien" required="required">
              </div>
              <div class="form-group">
                <label for="">Jenis Kelamin</label> <br>
                <label class="checkbox-inline">
                  <input type="radio" name="jk" value="Laki-laki">Laki-laki
                </label>
                <label class="checkbox-inline">
                  <input type="radio" name="jk" value="Perempuan">Perempuan
                </label>
              </div>
              <div class="form-group">
                <label for="">Pekerjaan</label>
                <input type="text" class="form-control" name="pekerjaan" required="required">
              </div>
              <div class="form-group">
                <label for="">Alamat</label>
                <input type="text" class="form-control" name="alamat" required="required">
              </div>
              <div class="form-group">
                <label for="">Kontak</label>
                <input type="text" class="form-control" name="kontak" required="required">
              </div>
              <div class="form-group">
                <label for="">Alergi Obat</label>
                <input type="text" class="form-control" name="alergi_obat">
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" name="tambah_pasien">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    
  <div class="modal fade" id="editPasien" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Form Edit Pasien</h4>
          </div>
          <form class="" action="" method="post">
            <input type="hidden" name="id_pasien" id="id_pasien" value="">
            <div class="modal-body">
              <div class="form-group">
                <label for="">NIK</label>
                <input type="text" class="form-control" name="nik" required="required" id="nik">
              </div>
              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama_pasien" required="required" id="nama_pasien">
                <p class="help-block">Nama lengkap pasien</p>
              </div>
              <div class="form-group">
                <label for="">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir_pasien" required="required" id="tempat_lahir_pasien">
              </div>
              <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir_pasien" required="required" id="tgl_lahir_pasien">
              </div>
              <div class="form-group">
                <label for="">Jenis Kelamin</label> <br>
                <label class="checkbox-inline">
                  <input type="radio" name="jk" value="Laki-laki" id="jk1">Laki-laki
                </label>
                <label class="checkbox-inline">
                  <input type="radio" name="jk" value="Perempuan" id="jk2">Perempuan
                </label>
              </div>
              <div class="form-group">
                <label for="">Pekerjaan</label>
                <input type="text" class="form-control" name="pekerjaan" required="required" id="pekerjaan">
              </div>
              <div class="form-group">
                <label for="">Alamat</label>
                <input type="text" class="form-control" name="alamat" required="required" id="alamat">
              </div>
              <div class="form-group">
                <label for="">Kontak</label>
                <input type="text" class="form-control" name="kontak" required="required" id="kontak">
              </div>
              <div class="form-group">
                <label for="">Alergi Obat</label>
                <input type="text" class="form-control" name="alergi_obat" required="required" id="alergi_obat">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" name="edit_pasien">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- akhir modal -->
</div>
<script src="../js/sweetalert.min.js"></script>
<script src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
function editPasien(id){
  $.ajax({
    type: "GET",
    url : "../backend/backend_editPasien.php",
    data: "id="+id,
    success: function (data){
     var $response = $(data);
       $('#id_pasien').val($response.filter('#id_pasien').text());
       $('#nik').val($response.filter('#nik').text());
       $('#nama_pasien').val($response.filter('#nama_pasien').text());
       $('#tempat_lahir_pasien').val($response.filter('#tempat_lahir_pasien').text());
       $('#tgl_lahir_pasien').val($response.filter('#tgl_lahir_pasien').text());
       if (($response.filter('#jk').text().trim())=="Laki-laki"){
           document.getElementById('jk1').checked=true;
       }else {
         document.getElementById('jk2').checked=true;
       }
       $('#pekerjaan').val($response.filter('#pekerjaan').text());
       $('#alamat').val($response.filter('#alamat').text());
       $('#kontak').val($response.filter('#kontak').text());
       $('#alergi_obat').val($response.filter('#alergi_obat').text());
       $('#editPasien').modal('show');
    }
  });
}
function cari() {
  var q = $('#cari').val();
  $.ajax({
  type: "GET",
  url: "pages/md/pencarianPasien.php?q="+q,
  success: function(data){
      var $response = $(data);
      $('#isi_tabel').html($response.filter('#isi_tabel').html());
    }
  });
}
</script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

    $('button').tooltip();
    function tampilRekam(id) {
      $.ajax({
        url : "pages/md/isiRekamMedis.php?id_pasien="+id,
        success: function (data) {
          var $respon = $(data);
          $('#isi').html($respon.html());
          $('#rekam').modal('show');
        }
      });
    }  
</script>
<?php
include "../backend/backend_tambahPasien.php";
include "../backend/backend_hapusPasien.php";
include "../backend/backend_prosesEditPasien.php";
 ?>
