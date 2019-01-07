
<?php
	session_start();
	include "connectMySQL.php";
  	$errUserName = "";
  	$errConfirmpassword = "";
  	$username = "";
	$password = "";
	$remember = "";

	if (isset($_COOKIE['username']) and isset($_COOKIE['password'])) {
		$username = $_COOKIE['username'];
		$password = $_COOKIE['password'];
		$remember = "checked";
	}

	if (isset($_POST['dangnhap'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$user = new user();
		$user->check_login($connect, $username, $password);
	}

  	if (isset($_POST['dangki'])) {
  		$last_name = $_POST['ho'];
		$first_name = $_POST['ten'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$gender = $_POST['gender'];
		$birthday = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirmpassword = $_POST['confirmpassword'];
		$user = new user();
		if ($confirmpassword == $password) {
			$user->insert_user($connect, $last_name, $first_name, $email, $address, $phone, $gender, $birthday, $username, $password);
		} else echo "<script> alert('Nhập lại mật khẩu không chính xác');</script>";
  	}

  	function selectDay(){
  		for ($i=1; $i <= 31; $i++) { 
  			echo "<option value='$i'>$i</option>";
  		}
  	}

  	function selectYear(){
  		for ($i=1; $i <= 100; $i++) { 
  			$year = 2018-$i;
  			echo "<option value='$year'>$year</option>";
  		}
  	}

   ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
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
	<?php include "header.php" ?>

	<div id="dangki" class="modal fade" role="dialog">
	    <div class="modal-dialog">

	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
				    <h3 class="modal-title">ĐĂNG KÍ</h3>
	        </div>
	        <form method="POST" action="">
	        	<div class="modal-body">
		         	<div class="col-md-6 home">
						<input type="text" name="ho" class="form-control" placeholder="Họ" required>
					</div>
					<div class="col-md-6 home">
						<input type="text" name="ten" class="form-control" placeholder="Tên" required>
					</div>
					<div class="col-md-12 home">
						<input type="text" name="email" class="form-control" placeholder="Email" required>
					</div>
					<div class="col-md-12 home">
						<input type="text" name="address" class="form-control" placeholder="Địa chỉ" required>
					</div>
					<div class="col-md-12 home">
						<input type="text" name="phone" class="form-control" placeholder="Số điện thoại" required>
					</div>
					<div class="col-md-12 home">
						<input type="radio" name="gender" value="Male">Male
						<input type="radio" name="gender" value="Female">Female
					</div>
					<div class="col-md-4 home">
						<select class="form-control" name="day">
						  <?php selectDay(); ?>
						</select>
					</div>
					<div class="col-md-4 home">
						<select class="form-control" name="month">
						  <option value="1">Tháng 1</option>
						  <option value="2">Tháng 2</option>
						  <option value="3">Tháng 3</option>
						  <option value="4">Tháng 4</option>
						  <option value="5">Tháng 5</option>
						  <option value="6">Tháng 6</option>
						  <option value="7">Tháng 7</option>
						  <option value="8">Tháng 8</option>
						  <option value="9">Tháng 9</option>
						  <option value="10">Tháng 10</option>
						  <option value="11">Tháng 11</option>
						  <option value="12">Tháng 12</option>
						</select>
					</div>
					<div class="col-md-4 home">
						<select class="form-control" name="year">
						  <?php selectYear(); ?>
						</select>
					</div>
					<div class="col-md-12 home">
						<input type="text" name="username" class="form-control" placeholder="User Name" required>
					</div>
					<div class="col-md-6 home">
						<input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
					</div>
					<div class="col-md-6 home">
						<input type="password" name="confirmpassword" class="form-control" placeholder="Xác nhận mật khẩu" required>
					</div>
		        </div>

		        <div class="modal-footer">
							<button class="btn" name="dangki" > REGISTER </button>
		        </div>
	        </form>
	      </div>

	    </div>
	</div>

  <div id="dangnhap" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
			    <h3 class="modal-title">ĐĂNG NHẬP</h3>
        </div>
        <form method="POST" action="">
        	<div class="modal-body">
	          <div class="col-md-12 home">
							User Name:
							<input type="text" name="username" class="form-control" placeholder="User Name" value="<?php echo $_COOKIE['username']; ?>" required>
						</div>
						<div class="col-md-12 home">
							Mật Khẩu:
							<input type="password" name="password" class="form-control" placeholder="Mật khẩu" value="<?php echo $password; ?>"required>
						</div>
						<div class="col-md-12 home">
							Nhớ mật khẩu  <input type="checkbox" <?php echo $remember; ?> name="remember">
						</div>
		      </div>
	        <div class="modal-footer">
						<button class="btn" name="dangnhap" > LOG IN </button>
	        </div>
        </form>
      </div>

    </div>
  </div>
	<div class="content"> 
	  <div id="myCarousel" class="carousel slide" data-ride="carousel">
	    <!-- Indicators -->
	    <ol class="carousel-indicators">
	      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	      <li data-target="#myCarousel" data-slide-to="1"></li>
	      <li data-target="#myCarousel" data-slide-to="2"></li>
	      <li data-target="#myCarousel" data-slide-to="3"></li>
	    </ol>

	    <!-- Wrapper for slides -->
	    <div class="carousel-inner">
	      <div class="item active">
	        <img src="Image/slider1.png" style="width:100%;">
	      </div>

	      <div class="item">
	        <img src="Image/slider2.png" style="width:100%;">
	      </div>
	    
	      <div class="item">
	        <img src="Image/slider3.png" style="width:100%;">
	      </div>

	      <div class="item">
	        <img src="Image/slider4.png" style="width:100%;">
	      </div>
	    </div>

	    <!-- Left and right controls -->
	    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
	      <span class="glyphicon glyphicon-chevron-left"></span>
	      <span class="sr-only">Previous</span>
	    </a>
	    <a class="right carousel-control" href="#myCarousel" data-slide="next">
	      <span class="glyphicon glyphicon-chevron-right"></span>
	      <span class="sr-only">Next</span>
	    </a>
		</div>
		<div class="container">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
			<div class="product-item">
				<div class="product-image">
					<img src="Image/thumb2.png">
				</div>

				<div class="product-control text-center">
					<button class="btn">
						<i class="fa fa-cart-plus fa-lg"></i> Giỏ hàng
					</button>
					<button class="btn">
						<i class="fa fa-eye fa-lg"></i>
					</button>
				</div>

				<div class="caption center">
					<h4>$name</h4>
					<span class="price">$price</span><strike>$new_price</strike>
				</div>
			</div>
		</div>
		<?php  showInfoProduct("01", "Vi da", "Image/thumb.png", 200000, 150000);?>
		</div>
		
		
	</div>

	<?php include "footer.php" ?>
</body>
</html>


