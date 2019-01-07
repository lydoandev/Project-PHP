<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  
  </style>
</head>
<body>
<?php 
  $showDangki_Dangnhap = "show";
  $showUsername = "hidden";
  $username = "";
  if (isset($_SESSION['username'])) {
    $showDangki_Dangnhap = "hidden";
    $username = $_SESSION['username'];
    $avatar = $_SESSION['avatar_url'];
    $showUsername = "show";
  }
 ?>
<div id="header">
      <div class="header-top">
        <div class="container">
          <div class="header-left col-lg-5 col-md-5 col-sm-6 col-xs-6">
            <div class="info">
              <span>
              <i class="glyphicon glyphicon-cloud"></i>
              27°C
              </span>
              <span>
                <i class="glyphicon glyphicon-map-marker"></i>
                101B Lê Hữu Trác
              </span>
              <span>
                <i class="glyphicon glyphicon-earphone"></i>
                +84 648 534 343
              </span>
            </div>
          </div>
          <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0">
            
          </div>
          <div class="header-right col-lg-5 col-md-6 col-sm-6 col-xs-6">
            <ul class="nav navbar-nav">
              <li>
                <a href="" data-toggle="modal" data-target="#dangki"><span><i class="fa fa-bell-o "></i></span> THÔNG BÁO </a>
              </li>
              <li>
                <a href="" data-toggle="modal" data-target="#dangki">
                  <span>
                    <i class="fa fa-question-circle  "></i>
                  </span>TRỢ GIÚP
                </a>
              </li>
              <li class="<?php echo $showDangki_Dangnhap?>">
                <a href="" data-toggle="modal" data-target="#dangki">
                  <span>
                    <i class="fa fa-user-plus "></i>
                  </span> ĐĂNG KÍ
                </a>
              </li>
              <li class="<?php echo $showDangki_Dangnhap?>">
                <a href="" data-toggle="modal" data-target="#dangnhap">
                  <span>
                    <i class="fa fa-sign-in"></i>
                  </span> ĐĂNG NHẬP
                </a>
              </li>
              <li class="dropdown" class="<?php echo $showUsername;?>">
                  <a href="#" id="user" class="<?php echo $showUsername;?> ?>" data-toggle="dropdown">
                    <img class="img-circle" width="15" height="15" src="<?php echo $avatar ?>">
                    <?php echo $username; ?>
                  </a>
                  <ul class="dropdown-menu text-capitalize" role="menu">
                    <li><a href="#"><span><i class="fa fa-shopping-cart"></i></span>Giỏ hàng</a></li>
                    <li><a href="profile.php"><span><i class="fa fa-user-circle-o"></i></span> Tài khoản của tôi</a></li>
                    <li><a href="logout.php"><span><i class="fa fa-sign-out"></i></span> Đăng xuất</a></li>
                  </ul>
              </li>
                          
            </ul>
          </div>

        </div>
      </div>
      
      <div class="header-content">
        <div class="container">
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 logo">
            <img src="Image/logo.png" width="120px" height="100px">
          </div>
          <div class="solugan col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <h3>PHONG ĐỘ LÀ TỨC THỜI. ĐẲNG CẤP LÀ MÃI MÃI</h3>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-0 ship" style="float: left;">
            <img src="Image/ship.png" width="200px" height="100px">
          </div>
        </div>
      </div>
      <div class="header-menu text-uppercase" id="myMenu">
        <nav class="navbar navbar-default">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
              </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="dropdown" >
                  <a href="#" id="category" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-bars "></span>  DANH MỤC SẢN PHẨM</a>
                  <ul class="dropdown-menu text-capitalize" role="menu">
                    <li><a href="#">Ví Da</a></li>
                    <li><a href="#">Túi & Clutch</a></li>
                    <li><a href="#">Phụ Kiện Da</a></li>
                  </ul>
                </li>
                <li><a href="#">TRANG CHỦ</span></a></li>
                <li><a href="#">SẢN PHẨM </a></li>
                <li><a href="#">LIÊN HỆ </span></a></li>
                <li>
                <form method="post" class="navbar-form">
                  <div class="input-group search-box">
                    <input type="text" class="form-control" placeholder="Search here...">
                    <span class="input-group-addon btn btn-primary"> <i class="glyphicon glyphicon-search"></i> </span>
                  </div>
                </form>
              </li>      
              </ul>
            </div>
          </div>
        </nav>
      </div>
</div>
</body>
<script>
  window.onscroll = function() {scrollMenu()};

  var header = document.getElementById("myMenu");
  var sticky = header.offsetTop;

  function scrollMenu() {
    if (window.pageYOffset > sticky) {
      header.classList.add("sticky");
    } else {
      header.classList.remove("sticky");
    }
  }
</script>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>