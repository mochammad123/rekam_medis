<?php
include '../../../backend/koneksi.php';
?>
<?php  
 //filter.php  
 if(isset($_POST["tanggal_awal"], $_POST["tanggal_akhir"]))  
 {  
    $query = mysqli_query($koneksi,"SELECT tb_rekam_medis.tgl_rekam,tb_rekam_medis.jenis_kunjungan,tb_rekam_medis.periksa,tb_rekam_medis.diagnosa,tb_rekam_medis.tindakan,tb_pasien.NIK,tb_pasien.nama from tb_rekam_medis inner join tb_pasien on tb_rekam_medis.id_pasien=tb_pasien.id_pasien WHERE tgl_rekam BETWEEN '".$_POST["tanggal_awal"]."' AND '".$_POST["tanggal_akhir"]."'  
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
           <table class="table table-bordered">  
                <tr>  
                     <th width="5%">ID</th>  
                     <th width="30%">Customer Name</th>  
                     <th width="43%">Item</th>  
                     <th width="10%">Value</th>  
                     <th width="12%">Order Date</th>  
                </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'. $row["order_id"] .'</td>  
                          <td>'. $row["order_customer_name"] .'</td>  
                          <td>'. $row["order_item"] .'</td>  
                          <td>$ '. $row["order_value"] .'</td>  
                          <td>'. $row["order_date"] .'</td>  
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
 }  
 ?>
