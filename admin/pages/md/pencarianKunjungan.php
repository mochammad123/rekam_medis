<?php
include '../../../backend/koneksi.php';
?>
<?php  
 //filter.php  
 $query = mysqli_query($koneksi,"SELECT tb_rekam_medis.tgl_rekam,tb_rekam_medis.jenis_kunjungan,tb_rekam_medis.periksa,tb_rekam_medis.diagnosa,tb_rekam_medis.tindakan,tb_pasien.NIK,tb_pasien.nama from tb_rekam_medis inner join tb_pasien on tb_rekam_medis.id_pasien=tb_pasien.id_pasien WHERE tgl_rekam BETWEEN tanggal AND '".$_POST["tanggal_akhir"]."'  
 ");
 while ($row=mysqli_fetch_object($query))
 // $query = mysqli_query($koneksi,"select * from tb_pasien where nama like '%".$_GET['q']."%' order by nama asc ");
 // while ($row=mysqli_fetch_object($query))
 // { 
 //   $query = "  
 //        SELECT * FROM tbl_order  
 //        WHERE order_date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  
 //   ";  
   $result = mysqli_query($connect, $query);  
   $output .= '  
   <table class="table table-bordered table-striped">
       <tr>
            <th><span class="fa fa-th-list"></span> No</th>
            <th><span class="fa fa-check-square-o"></span> NIK</th>
            <th><span class="fa fa-user"></span> Nama Pasien</th>
            <th><span class="fa fa-calendar"></span> Tanggal</th>
            <th><span class="fa fa-clock-o"></span> Jenis Kunjungan</th>
            <th><span class="fa fa-stethoscope"></span> Periksa</th>
            <th><span class="fa fa-heartbeat"></span> Diagnosa</th>
            <th><span class="fa fa-user-md"></span> Tindakan</th>
       </tr>  
   ';  
   if(mysqli_num_rows($result) > 0)  
   {  
        while($row = mysqli_fetch_array($result))  
        {  
             $output .= '  
                  <tr>  
                       <td>'. $row["NIK"] .'</td>  
                       <td>'. $row["nama"] .'</td>  
                       <td>'. $row["tgl_rekam"] .'</td>  
                       <td>'. $row["jenis_kunjungan"] .'</td>  
                       <td>'. $row["periksa"] .'</td>
                       <td>'. $row["diagnosa"] .'</td>
                       <td>'. $row["tindakan"] .'</td>  
                  </tr>  
             ';  
        }  
   }  
   else  
   {  
        $output .= '  
             <tr>  
                  <td colspan="5">No Order Found</td>  
             </tr>  
        ';  
   }  
   $output .= '</table>';  
   echo $output;  
 if(isset($_POST["tanggal_awal"], $_POST["tanggal_akhir"]))  
 {  
 }  
 ?>
