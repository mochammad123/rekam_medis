<!DOCTYPE html>
<html lang="en">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/dataTables.bootstrap4.min.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <title>Document</title>

<body>

<div class="container">
<table id="example" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th><span class="fa fa-th-list"></span> No</th>
            <th> Nama</th>
            <th> Tanggal lahir</th>
            <th> Umur</th>
            <th> Jenis Kelamin</th>
            <th> Agama</th>
            <th> Pekerjaan</th>
            <th> Pendidikan</th>
            <th> Alamat</th>
            <th> Opsi</th>
        </tr>
    </thead>
    <tbody>
      <?php
       include"koneksi.php";
        $n=1;
        $query = mysqli_query($koneksi,"select * from tb_pasien order by nama asc ");
        while ($row=mysqli_fetch_object($query))
        {
     ?>
     <?php
      // cari umur
      $tgl_lahir =date_format(date_create($row->tgl_lahir), 'Y');
      $sekarang = date('Y');
      $usia = $sekarang - $tgl_lahir;
        ?>
             <tr>
               <td> <?php echo $n ?> </td>
               <td><?php echo "$row->nama"?></td>
               <td><?php echo "$row->tgl_lahir"?></td>
               <td><?php echo  $usia ?> Tahun</td>
               <td><?php echo "$row->jk"?></td>
               <td><?php echo "$row->agama"?></td>
               <td><?php echo "$row->pekerjaan"?></td>
               <td><?php echo "$row->pendidikan"?></td>
               <td><?php echo "$row->alamat"?></td>
               <td>
                 <form class="" action="" method="post">
                   <input type="hidden" name="id" value="">
                   <a name="cetak" href="" target="_blank" class="btn btn-default btn-flat btn-sm">
                     <i class="glyphicon glyphicon-print"></i>
                   </a>
                   <button type="button" class="btn btn-warning btn-flat btn-sm" onclick="">
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
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</body>
</html>