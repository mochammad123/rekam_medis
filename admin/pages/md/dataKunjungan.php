<link rel="stylesheet" href="../css/sweetalert.css" media="screen" title="no title">
<link rel="stylesheet" href="../css/bootstrap.min.css" media="screen" title="no title">
<?php
include"../backend/koneksi.php";
$cekpoli=mysqli_query($koneksi,"SELECT jenis_poli from tb_dokter where username='".$_SESSION['username']."'");
while ($row=mysqli_fetch_object($cekpoli)) {
  $Poli=$row->jenis_poli;
}
$query = mysqli_query($koneksi,"SELECT tb_rekam_medis.tgl_rekam,tb_rekam_medis.jenis_kunjungan,tb_rekam_medis.periksa,tb_rekam_medis.diagnosa,tb_rekam_medis.tindakan,tb_pasien.NIK,tb_pasien.nama from tb_rekam_medis inner join tb_pasien on tb_rekam_medis.id_pasien=tb_pasien.id_pasien ORDER BY tb_rekam_medis.tgl_rekam ASC");
$hitung1=mysqli_num_rows($query); 
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
        <i class="fa "></i> Informasi Data Kunjungan
      </h2>
      <div class="box">
        <div class="box-header with-border">
        <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 180px;">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" id="carii" name="carii" placeholder="Pencarian..." class="form-control pull-right" onkeyup="carii()">
              </div>
            </div>
          <h3 class="box-title">
          <form class="" action="" method="post">
            <div class="input-group input-group-sm" style="width: 180px;">
            <h6>Tanggal Awal</h6> <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control">
            </div>
            <div class="input-group input-group-sm" style="width: 180px;">
            <h6>Tanggal Akhir</h6> <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
            </div>
            <div class="input-group input-group-sm" style="width: 180px;">
            <h6>Pencarian Penyakit</h6> <input type="text" name="pencarian" id="pencarian" class="form-control" placeholder="Cariii...">
            </div>
            <br>
            <button class="btn btn-primary" name="cari" id="cari" type="button" value="cari">
          Cari
            </button>
          </form>
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" id="list">
        <div class="table-responsive">
        <h6 style="text-align: right;">
          <i class="fa "></i> Jumlah Kunjungan : <?php echo $hitung1 ?>
         </h6>
          <table class="table table-bordered table-striped">
          <tr style="font-size: 12px">
              <th><span class="fa fa-th-list"></span> No</th>
              <th><span class="fa fa-check-square-o"></span> NIK</th>
              <th><span class="fa fa-user"></span> Nama Pasien</th>
              <th><span class="fa fa-calendar"></span> Tanggal</th>
              <th><span class="fa fa-clock-o"></span> Jenis Kunjungan</th>
              <th><span class="fa fa-stethoscope"></span> Periksa</th>
              <th><span class="fa fa-heartbeat"></span> Penyakit</th>
              <th><span class="fa fa-user-md"></span> Obat</th>
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
            
              $result_count = mysqli_query($koneksi,"SELECT COUNT(*) As total_records FROM tb_rekam_medis inner join tb_pasien on tb_rekam_medis.id_pasien=tb_pasien.id_pasien");
              $total_records = mysqli_fetch_array($result_count);
              $total_records = $total_records['total_records'];
                $total_no_of_pages = ceil($total_records / $total_records_per_page);
              $second_last = $total_no_of_pages - 1; // total page minus 1

      $n=1;
      // $sql1= mysqli_query($koneksi,"SELECT tb_rekam_medis.tgl_rekam,tb_rekam_medis.jenis_kunjungan,tb_rekam_medis.periksa,tb_rekam_medis.diagnosa,tb_rekam_medis.tindakan,tb_dokter.nama from tb_rekam_medis inner join tb_dokter on tb_rekam_medis.NIP=tb_dokter.NIP where id_pasien='".$_GET['id_pasien']."' and jenis_kunjungan='baru'");
      // $query = mysqli_query($koneksi,"select * from tb_pendaftaran where proses = '".$_SESSION['poli']."' and keterangan = 'selesai'");
      // $query = mysqli_query($koneksi,"SELECT tb_pendaftaran.nama,tb_pendaftaran.tanggal,tb_pendaftaran.jenis_kunjungan,tb_pendaftaran.proses,tb_pendaftaran.no_cm,tb_pasien.NIK from tb_pendaftaran inner join tb_pasien on tb_pendaftaran.id_pasien=tb_pasien.id_pasien where keterangan = 'selesai'");
      $query = mysqli_query($koneksi,"SELECT tb_rekam_medis.tgl_rekam,tb_rekam_medis.jenis_kunjungan,tb_rekam_medis.periksa,tb_rekam_medis.diagnosa,tb_rekam_medis.tindakan,tb_pasien.NIK,tb_pasien.nama from tb_rekam_medis inner join tb_pasien on tb_rekam_medis.id_pasien=tb_pasien.id_pasien ORDER BY tb_rekam_medis.tgl_rekam ASC limit $offset, $total_records_per_page");
      while ($row=mysqli_fetch_object($query))
      {
       ?>
      <tr style="font-size: 12px">
   <td><?php echo $n ?></td>
   <td><?php echo "$row->NIK"?></td>
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
  ?>
  </table>
  </div>
  <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<ul class="pagination">
  <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
  <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no > 1){ echo "href='?m=dataKunjungan&page_no=$previous_page'"; } ?>>Previous</a>
  </li>

  <?php 
  if ($total_no_of_pages <= 10){     
    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
      if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?m=dataKunjungan&page_no=$counter'>$counter</a></li>";
        }
        }
  }
  elseif($total_no_of_pages > 10){
    
  if($page_no <= 4) {     
   for ($counter = 1; $counter < 8; $counter++){     
      if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?m=dataKunjungan&page_no=$counter'>$counter</a></li>";
        }
        }
    echo "<li><a>...</a></li>";
    echo "<li><a href='?m=dataKunjungan&page_no=$second_last'>$second_last</a></li>";
    echo "<li><a href='?m=dataKunjungan&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    }

   elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {     
    echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {     
           if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?m=dataKunjungan&page_no=$counterpage_no=$counter'>$counter</a></li>";
        }                  
       }
       echo "<li><a>...</a></li>";
     echo "<li><a href='?m=dataKunjungan&page_no=$second_last'>$second_last</a></li>";
     echo "<li><a href='?m=dataKunjungan&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
    
    else {
        echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?m=dataKunjungan&page_no=$counter'>$counter</a></li>";
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
  <script type="text/javascript">
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
</script>
<script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#tanggal_awal").datepicker();  
                $("#tanggal_akhir").datepicker();  
           });  
           $('#cari').click(function(){  
                var tanggal_awal = $('#tanggal_awal').val();  
                var tanggal_akhir = $('#tanggal_akhir').val();
                var pencarian = $('#pencarian').val();  
                if(tanggal_awal != '' && tanggal_akhir != '')  
                {  
                     $.ajax({  
                          url:"pages/md/pencarianKunjungan.php",  
                          method:"POST",  
                          data:{tanggal_awal:tanggal_awal, tanggal_akhir:tanggal_akhir, pencarian:pencarian},  
                          success:function(data)  
                          {  
                               $('#list').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });

  
 </script>
<script type="text/javascript">
 function carii() {
  var q = $('#carii').val();
  $.ajax({
  type: "GET",
  url: "pages/md/pencarianDataKunjungan.php?q="+q,
  success: function(data){
      var $response = $(data);
      $('#list').html($response.filter('#list').html());
    }
  });
}
 </script>
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
