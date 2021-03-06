<link rel="stylesheet" href="../css/sweetalert.css" media="screen" title="no title">
<link rel="stylesheet" href="../css/scroll.css" media="screen" title="no title">
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
<!--                 <th><span class="fa fa-graduation-cap"></span> Kunjungan</th>
                <th><span class="fa fa-heart"></span> Alergi Obat</th> -->
                <th><span class="fa fa-cogs"></span> Opsi</th>
              </tr>
            </thead>
            <tbody>
      <?php
            $n=1;
            // $query = mysqli_query($koneksi,"select * from tb_pasien order by nama asc ");
            $query = mysqli_query($koneksi,"select * from tb_pasien");
            while ($row=mysqli_fetch_object($query))
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
</div>
  <!-- /.box-body -->

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
<!--               <div class="form-group">
                <label for="">Agama</label>
                <select class="form-control" name="agama">
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Kristen</option>
                  <option value="Khatolik">Khatolik</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Budha">Budha</option>
                  <option value='belum dipilih' selected>- pilih agama -</option>
                </select>
              </div> -->
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
            <h4 class="modal-title">Form Data Pasien</h4>
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
              <!-- <div class="form-group">
                <label for="">Agama</label>
                <select class="form-control" name="agama" id="agama">
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Kristen</option>
                  <option value="Khatolik">Khatolik</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Budha">Budha</option>
                </select>
              </div> -->
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
</script>
<?php
include "../backend/backend_tambahPasien.php";
include "../backend/backend_hapusPasien.php";
include "../backend/backend_prosesEditPasien.php";
 ?>
