<link rel="stylesheet" href="../css/sweetalert.css" media="screen" title="no title">
<link rel="stylesheet" href="../css/bootstrap.min.css" media="screen" title="no title">
<?php
include"../backend/koneksi.php";
 ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Proses Rekam Medis
      <small>control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="?m=prosesRekam">Data Kunjungan</a></li>
      <li class="active">Proses Rekam Medis</li>
    </ol>
  </section>


<section class="invoice">
<!-- title row -->
<?php
$id_pasien = $_GET['id'];
$id_rawat = $_GET['id_rawat'];
$sql1 = "SELECT no_rm FROM tb_rekam_medis where id_pasien='$id_pasien'";
$cariNo = mysqli_query($koneksi,$sql1);
while ($row=mysqli_fetch_object($cariNo)) {
  $no_rm = $row->no_rm;
}
 ?>
 <?php
 $query="SELECT no_cm from tb_pendaftaran where id_pasien = '$id_pasien'";
 $cek=mysqli_query($koneksi,$query);
 while ($baris=mysqli_fetch_object($cek)) {
   $no_cm = $baris->no_cm;
 }
   ?>
<div class="row">
<div class="col-xs-12">
<h2 class="page-header">
  <i class="fa "></i> Daftar Riwayat Kunjungan dan Pemeriksaan Pasien
</h2>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">
     <button class="btn btn-primary" id="tombol_periksa">
       Input Kunjungan
      </button>
      <button class="btn btn-primary" id="tombol_riwayat">
        Riwayat
      </button>
      <form class="" action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id_pasien ?>">
        <input type="hidden" name="no_rm" value="<?php echo $no_rm ?>">
        <input type="hidden" name="no_cm" value="<?php echo $no_cm?>">
        <button class="btn btn-primary" name="selesai" type="submit">
          Selesai
        </button>
      </form>
    </h3>
  </div>
<div class="box-header with-border">
 <h4 style="margin-top:0px;"><b>Informasi data rawat no. CM <?php echo ": $no_cm"?>  </b><small></small></h4>

<?php
$sql= "SELECT * from tb_pasien where id_pasien = '$id_pasien'";
$hasil = mysqli_query($koneksi,$sql);
while ($row=mysqli_fetch_object($hasil)) {
?>
  <div class="row">
    <div class="col-md-6">
      <table style="font-size:16px">
        <tr>
          <td>
            Nama
          </td>
          <td style="padding:8px">
            <?php echo ": $row->nama"?>
          </td>
        </tr>
        <tr>
          <td>
            Jenis Kelamin
          </td>
          <td style="padding:8px">
            <?php echo ": $row->jk"?>
          </td>
        </tr>
        <tr>
          <td>
            Tanggal Lahir
          </td>
          <td style="padding:8px">
            <?php echo ": $row->tgl_lahir"?>
          </td>
        </tr>
        </table>
    </div>
      <?php
      // cari umur
      $tgl_lahir =date_format(date_create($row->tgl_lahir), 'Y');
      $sekarang = date('Y');
      $usia = $sekarang - $tgl_lahir;
        ?>
    <div class="col-md-6">
      <table style="font-size:16px">
          <tr>
            <td>
              Usia
            </td>
            <td style="padding:8px">
              <?php echo ": $usia"?> Tahun
            </td>
          </tr>
          <tr>
            <td>
              Pekerjaan
            </td>
            <td style="padding:8px">
              <?php echo ": $row->pekerjaan"?>
            </td>
          </tr>
          <tr>
            <td>
              Alamat
            </td>
            <td style="padding:8px">
              <?php echo ": $row->alamat"?>
            </td>
          </tr>
        </table>
    </div>
  </div>
<?php } ?>
</div>

  <!-- /.box-header -->
<!-- Tabel Periksa -->
  <div class="box-body" id="riwayat">
    <table class="table table-bordered table-striped">
      <tr>
        <th><span class="fa fa-calendar"></span> Tanggal Rawat</th>
        <th><span class="fa fa-stethoscope"></span> Periksa</th>
        <th><span class="fa fa-heartbeat"></span> Diagnosa</th>
        <th><span class="fa fa-user-md"></span> Tindakan</th>
        <th><span class="fa fa-user-md"></span> Opsi</th>
      </tr>

<!-- Pages -->
      <?php
      if (isset($_GET['page_no']) && $_GET['page_no']!="") {
  $page_no = $_GET['page_no'];
  } else {
    $page_no = 1;
        }

  $total_records_per_page = 1;
  $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2";

  $result_count = mysqli_query($koneksi,"SELECT COUNT(*) As total_records FROM `tb_rekam_medis`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1;

?>

      <?php
      $id_rawat = $_POST['id_rawat'];
      $query = mysqli_query($koneksi,"SELECT no_rm,tgl_rekam,periksa,diagnosa,tindakan from tb_rekam_medis where id_pasien ='$id_pasien' order by tgl_rekam desc limit $offset, $total_records_per_page");
      while ($data=mysqli_fetch_object($query))
      {
       ?>


       <tr>
         <td><?php echo "$data->tgl_rekam"?></td>
         <td><?php echo "$data->periksa"?></td>
         <td><?php echo "$data->diagnosa"?></td>
         <td><?php echo "$data->tindakan"?></td>
         <td>
                 <form class="" action="" method="post">
                   <input type="hidden" name="id" value="<?php echo $row->id_pasien; ?>">
                   <a name="cetak" href="../backend/backend_cetak.php?id=<?php echo $data->id_pasien; ?>" target="_blank" class="btn btn-default btn-flat btn-xs" style="size: 5px">
                     <i class="glyphicon glyphicon-print"></i>
                   </a>
                   <button type="button" class="btn btn-warning btn-flat btn-xs" onclick="editRekam(<?php echo $data->no_rm; ?>)">
                     <i class="glyphicon glyphicon-edit"></i>
                   </button>

                 </form>
              </td>

       </tr>
      <?php } ?>
    </table>
   </div>


<!-- tabel riwayat -->
    <div class="box-body" id="rm" style="display:none">
      <table class="table table-bordered table-striped">
        <tr>
          <th><span class="fa fa-calendar"></span> Tanggal Rawat</th>
<!--           <th><span class="fa fa-clock-o"></span> Pukul</th> -->
          <th><span class="fa fa-stethoscope"></span> Periksa</th>
          <th><span class="fa fa-heartbeat"></span> Diagnosa</th>
          <th><span class="fa fa-user-md"></span> Tindakan</th>
        </tr>

        <?php
        // $query = mysqli_query($koneksi,"SELECT tgl_rekam,periksa,diagnosa,tindakan from tb_rekam_medis where id_pasien ='$id_pasien' and tgl_rekam = current_date()");
        $query = mysqli_query($koneksi,"SELECT no_rm,tgl_rekam,periksa,diagnosa,tindakan from tb_rekam_medis where id_pasien ='$id_pasien'");
        while ($data=mysqli_fetch_object($query))
        {
         ?>
         <tr>
           <td><?php echo "$data->tgl_rekam"?></td>
<!--            <td><?php echo "$data->jam"?></td> -->
           <td><?php echo "$data->periksa"?></td>
           <td><?php echo "$data->diagnosa"?></td>
           <td><?php echo "$data->tindakan"?></td>
         </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</div>

<!-- form diagnosa -->
<div class="form-group" id="diagnosa" style="display:none">
<form class="" action="" method="post">
  <table>
    <tr>
      <td>
        <h5><b>Uraian Diagnosa &emsp;&emsp;:</b></h5>
      </td>
      <td>
        <textarea name="diagnosa" rows="6" cols="30" class="form-control"  autofocus="autofocus"></textarea>
      </td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td>
        <h5><b>Tambahan Biaya &emsp;&emsp;:</b></h5>
      </td>
      <td>
        <div class="input-group">
        <span class="input-group-addon">Rp</span>
        <input type="text" name="biaya_diagnosa" value="" class="form-control" onkeyup="formatangka(this);">
      </div>
      </td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="hidden" name="id_pasien" value="<?php echo $id_pasien ?>">
        <button type="submit" class="btn btn-success" name="submit_diagnosa">Submit</button>
        <button type="reset" class="btn btn-warning">Hapus</button>
      </td>
      <td></td>
    </tr>
  </table>
</form>
</div>
<!-- akhir form diagnosa -->



</div>
</section>

    <div class="modal fade" id="editKaryawan" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Form Input Kunjungan</h4>
          </div>
          <div class="modal-body">
            <form class="" action="" method="post">
<!--               <input type="hidden" name="no" id="id_karyawan" value=""> -->
              <div class="modal-body">
                <div class="form-group">
<!--                   <label for="">No. RM</label> -->
                  <input type="hidden" class="form-control" name="no_rm" required="required" id="no_rm">
                </div>
                  <div class="form-group">
<!--                     <label for="">Tanggal Kunjungan</label> -->
                    <input type="hidden" class="form-control" name="tgl_rekam" required="required" id="tgl_rekam">
                  </div>
                <div class="form-group">
                  <label for="">Periksa</label>
                  <textarea name="periksa" required="required" rows="3" cols="40" class="form-control" id="periksa"></textarea>
                </div>
                <div class="form-group">
                  <label for="">Diagnosa</label>
                  <textarea name="diagnosa" required="required" rows="3" cols="40" class="form-control" id="diagnosa"></textarea>
                </div>
                <div class="form-group">
                  <label for="">Tindakan</label>
                  <textarea name="tindakan" required="required" rows="3" cols="40" class="form-control" id="tindakan"></textarea>
                </div>  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" name="edit_rekam">Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<script src="../js/sweetalert.min.js"></script>
<script src="../js/jquery-2.1.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script type="text/javascript">
function editRekam(id){
  $.ajax({
    type: "GET",
    url : "../backend/backend_editRekam.php",
    data: "id="+id,
    success: function (data){
     var $response = $(data);
       $('#no_rm').val($response.filter('#no_rm').text());
       $('#tgl_rekam').val($response.filter('#tgl_rekam').text());
       $('#periksa').val($response.filter('#periksa').text());
       $('#diagnosa').val($response.filter('#diagnosa').text());
       $('#tindakan').val($response.filter('#tindakan').text());
       $('#editKaryawan').modal('show');
    }
  });
}


  $('button').tooltip();
</script>
<script type="text/javascript">
$(document).ready(function(){
    $("#tombol_periksa").click(function(){
      $("#periksa").show();
      $("#diagnosa").hide();
      $("#tindakan").hide();
      $("#riwayat").show();
      $("#rm").hide();

  });
  // $("#tombol_periksa").click(function(){
  //     $("#periksa").show();
  //     $("#diagnosa").hide();
  //     $("#tindakan").hide();
  //     $("#riwayat").show();
  //     $("#rm").hide();

  // });
  $("#tombol_diagnosa").click(function(){
      $("#diagnosa").show();
      $("#periksa").hide();
      $("#tindakan").hide();
      $("#riwayat").show();
      $("#rm").hide();
  });
  // $("#tombol_tindakan").click(function(){
  //     $("#tindakan").show();
  //     $("#periksa").hide();
  //     $("#diagnosa").hide();
  //     $("#riwayat").show();
  //     $("#rm").hide();
  // });
  // $("#tombol_resep").click(function(){
  //     $("#resep_obat").show();
  //     $("#periksa").hide();
  //     $("#diagnosa").hide();
  //     $("#tindakan").hide();
  //     $("#riwayat").hide();
  //     $("#rm").hide();
  // });
  $("#tombol_riwayat").click(function(){
      $("#resep_obat").hide();
      $("#periksa").hide();
      $("#diagnosa").hide();
      $("#tindakan").hide();
      $("#riwayat").hide();
      $("#rm").show();
});
});
</script>
<script type="text/javascript">
function formatangka(objek) {
   a = objek.value;
   b = a.replace(/[^\d]/g,"");
   c = "";
   panjang = b.length;
   j = 0;
   for (i = panjang; i > 0; i--) {
     j = j + 1;
     if (((j % 3) == 1) && (j != 1)) {
       c = b.substr(i-1,1) + "." + c;
     } else {
       c = b.substr(i-1,1) + c;
     }
   }
   objek.value = c;
}
</script>
<?php
include "../backend/backend_prosesEditRekam.php";
include "../backend/backend_selesaiRm.php";
?>
