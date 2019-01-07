<?php 
	session_start();
	include "connectMySQL.php";

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="admin">
		<div class="header">
			<div class="container">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">
					<img src="Image/logo.png" width="80px" height="60px">
        </div>
				<div class="solugan col-lg-5 col-md-5 col-sm-5 col-xs-5 text-center">
          <h3>WELLCOME TO LEONARDO ADMIN</h3>
        </div>
        <div class="header-right col-lg-5 col-md-5 col-sm-5 col-xs-5">
          <ul class="nav navbar-nav">
            <li>
              <a href=""><span><i class="fa fa-bell-o "></i></span> THÔNG BÁO </a>
            </li>
            <li>
              <a href="">
                <span>
                  <i class="fa fa-question-circle  "></i>
                </span>TRỢ GIÚP
              </a>
            </li>
            <li class="dropdown" class="<?php echo $showUsername;?>">
                <a href="#" id="user" class="<?php echo $showUsername;?> ?>" data-toggle="dropdown">
                  <img src="<?php echo $_SESSION['avatar_url']; ?>">
                  <?php echo $_SESSION['username']; ?>
                </a>
                <ul class="dropdown-menu text-capitalize" role="menu">
                  <li><a href="#"><span><i class="fa fa-shopping-cart"></i></span>Giỏ hàng</a></li>
                  <li><a href="profile.php">Tài khoản của tôi</a></li>
                  <li><a href="logout.php">Đăng xuất</a></li>
                </ul>
            </li>
          </ul>
        </div>
			</div>
		</div>

		<div class="content">
			<div class="container">

				<div class="sidenav col-lg-3 col-md-3 col-sm-3 col-xs-3">
				  <ul role="tablist" class="">
				  	 <li><a href=""><span><i class="fa fa-home" style="color: #ff661a;"></i></span> Trang chủ Admin</a></li>
             <li class="active">
               <a href="#tabs-1" data-toggle="tab" aria-expanded="true"><span><i class="fa fa-list-alt" style="color: #3399ff;"></i></span> Quản lí đơn hàng</a>
             </li>
             <li>
               <a href="#tabs-2" data-toggle="tab" aria-expanded="true"><span><i class="fa fa-shopping-cart" style="color: #ffff66;"></i></span> Quản lí giỏ hàng</a>
             </li>
             <li>
               <a href="#tabs-3" data-toggle="tab" aria-expanded="true"><span><i class="fa fa-address-card-o" style="color: #a31aff;"></i></span> Quản lí khách hàng</a>
             </li>
           </ul>
				</div>

				<div class="text col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-9 col-xs-offset-3">
					<div class="info">
						<?php 
							if (isset($_GET["viewUsername"])) {
								$sql = "SELECT * FROM users WHERE username = '" . $_GET["viewUsername"] . "'";
								$result = $connect->query($sql);
								if ($result->num_rows > 0) {
									$row = $result->fetch_assoc();
									adminView($row['username'], $row['avatar_url'],$row['last_name'], $row['first_name'], $row['birthday'], $row['gender'], $row['email'], $row['address'], $row['phone'], $row['u_role'], $row['is_active'], $row['last_access'] );
								}
							}
						 ?>
						<div class="tab-content">
			        <div id="tabs-1" class="tab-pane active">
			          <?php showAllUsers($connect); ?>
			        </div>

			        <div id="tabs-2" class="tab-pane fade">
			          ghjhgjkhg
			        </div>

			        <div id="tabs-3" class="tab-pane fade">
			          fjhgjh
			        </div>
			      </div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>