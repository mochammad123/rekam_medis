<?php
//membuka session
session_start();
//cek apakah sudah Login
if(isset($_SESSION['sudah_login'])){
  //jika iya
  ?>
  <script type="text/javascript">
    window.location='admin/index.php'
  </script>
  <?php
}else {
  //jika belum Login
  ?>
  <script type="text/javascript">
    window.location='login/login.php';
  </script>
  <?php
}
 ?>
