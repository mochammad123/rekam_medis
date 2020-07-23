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
          <h3 class="box-title">
          <form class="" action="" method="post">
            <div class="input-group input-group-sm" style="width: 180px;">
            <h6>Tanggal Awal</h6> <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control">
            </div>
            <div class="input-group input-group-sm" style="width: 180px;">
            <h6>Tanggal Akhir</h6> <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
            </div>
            <br>
            <button class="btn btn-primary" name="cari" id="cari" type="button" value="cari">
          Cari
            </button>
          </form>
          </h3>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" id="list">
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
              <th><span class="fa fa-heartbeat"></span> Diagnosa</th>
              <th><span class="fa fa-user-md"></span> Tindakan</th>
            </tr>

      <?php
      $n=1;
      // $sql1= mysqli_query($koneksi,"SELECT tb_rekam_medis.tgl_rekam,tb_rekam_medis.jenis_kunjungan,tb_rekam_medis.periksa,tb_rekam_medis.diagnosa,tb_rekam_medis.tindakan,tb_dokter.nama from tb_rekam_medis inner join tb_dokter on tb_rekam_medis.NIP=tb_dokter.NIP where id_pasien='".$_GET['id_pasien']."' and jenis_kunjungan='baru'");
      // $query = mysqli_query($koneksi,"select * from tb_pendaftaran where proses = '".$_SESSION['poli']."' and keterangan = 'selesai'");
      // $query = mysqli_query($koneksi,"SELECT tb_pendaftaran.nama,tb_pendaftaran.tanggal,tb_pendaftaran.jenis_kunjungan,tb_pendaftaran.proses,tb_pendaftaran.no_cm,tb_pasien.NIK from tb_pendaftaran inner join tb_pasien on tb_pendaftaran.id_pasien=tb_pasien.id_pasien where keterangan = 'selesai'");
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
<!--    <td><?php echo "Rp ".number_format($row->biaya,2,',','.');?></td> -->
   <!-- <td><span class="label label-success"><?php echo "$row->status"?></span></td>
   <td><span class="label label-success"><?php echo "$row->keterangan"?></span></td> -->
   <!-- <td>
     <form class="" action="" method="post">
       <input type="hidden" name="id_rawat" value="<?php echo $row->id_rawat; ?>">
       <input type="hidden" name="id_pasien" value="<?php echo $row->id_pasien; ?>">

       <button name="rekam" class="btn btn-default btn-flat btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Proses">
         <i class="glyphicon glyphicon-eye-open"></i>
       </button>

       <button type="submit" class="btn btn-danger btn-flat btn-sm" name="hapus" data-toggle="tooltip" data-placement="bottom" title="Hapus">
         <i class="glyphicon glyphicon-remove"></i>
       </button>
     </form>
  </td> -->
 </tr>
      <?php
       $n= $n+1;
  }
  ?>
  </table>
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
                if(tanggal_awal != '' && tanggal_akhir != '')  
                {  
                     $.ajax({  
                          url:"pages/md/pencarianKunjungan.php",  
                          method:"POST",  
                          data:{tanggal_awal:tanggal_awal, tanggal_akhir:tanggal_akhir},  
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
