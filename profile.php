<?php 
	session_start();
	include "connectMySQL.php";
	$user = new user();
	$info = $user->showInfo($connect, $_SESSION['username']);
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

	$errConfirm = "";
	$errOldPass = "";
	if(isset($_POST['updatePass'])) {
		$user = new user();
		$errOldPass = $user->updatePassword($connect, $_SESSION['username'], $_POST['oldPassword'], $_POST['newPassword']);
		if ($_POST['newPassword'] != $_POST['confirmPassword']) {
			$errConfirm = "* Nhập Lại Mật Khẩu Không Chính Xác";
		}
	}

	if(isset($_POST['update'])) {
		$target_dir = "avatars/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check file size
		if ($_FILES["file"]["size"] > 500000) {
			echo "<script>console.log('Sorry, your file is too large.')</script>";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "<script>console.log('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		    $uploadOk = 0;
		}
		if ($uploadOk == 0) {
			echo "<script>console.log('Sorry, your file was not uploaded.')</script>";
		} else{
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				echo "<script>console.log('The file has been uploaded.')</script>";
		    } else {
		    	echo "<script>console.log('Sorry, there was an error uploading your file.')</script>";
		    }
		}
		$user = new user();
		$birthday = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
		$user->updateInfo($connect, $_SESSION['username'], $target_file, $_POST['last_name'], $_POST['first_name'], $_POST['email'], $_POST['address'], $_POST['phone'], $_POST['gender'], $birthday);
	}

	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body> 
<?php include "header.php" ;
?>
<div class="profile">
	<div class="container">
		<div class="content">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<div class="acount">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<img src="<?php echo $avatar ?>">
						</div>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
							<p style="padding-top: 10px;"><b><?php echo $username; ?></b></p>
							<span><i class="fa fa-pencil-square-o "></i></span><a href="" style="text-decoration: none">Sửa Hồ Sơ</a>
						</div>
					</div>
				</div>
				<hr>
				<ul>
					<li class="dropdown">
						<a href="profile.php"><span><i class="fa  fa-user-circle-o" style="color: #ffff1a;"></i></span> Tài khoản của tôi</a>
	          <ul class="">
	            <li><a href="#profile" data-toggle="tab" aria-expanded="true" class="active">Hồ sơ</a></li>
	            <li><a href="#changePass" data-toggle="tab" aria-expanded="true">Đổi mật khẩu</a></li>
	          </ul>
					</li>
					<li><a href="#order" data-toggle="tab" aria-expanded="true"><span><i class="fa fa-list-alt" style="color: #3399ff;"></i></span> Đơn hàng</a></li>
					<li><a href="#" data-toggle="tab" aria-expanded="true"><span><i class="fa fa-bell-o" style="color: #ff0000;"></i></span> Thông báo</a></li>
				</ul>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
				<div class="info">
					<div class="tab-content">
						<div id="profile" class="tab-pane active">
              <h4>Hồ Sơ Của Tôi</h4>
							Quản Lí Thông Tin Hồ Sơ Để Bảo Mật
							<hr>
							<form method="POST" action="" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="border-right: 1px solid #d9d9d9;">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 home">
											<input type="text" name="last_name" class="form-control" placeholder="Họ" value="<?php echo $info['last_name'] ;?>" required>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 home">
											<input type="text" name="first_name" class="form-control" placeholder="Tên" value="<?php echo $info['first_name'] ;?>" required>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 home">
											<input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $info['email'] ;?>" required>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 home">
											<input type="text" name="address" class="form-control" placeholder="Địa chỉ" value="<?php echo $info['address'] ;?>" required>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 home">
											<input type="text" name="phone" class="form-control" placeholder="Số điện thoại" value="<?php echo $info['phone'] ;?>" required>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 home">
											<input type="radio" name="gender" value="Male">Male
											<input type="radio" name="gender" value="Female">Female
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 home">
											<select class="form-control" name="day">
											  <?php selectDay(); ?>
											</select>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 home">
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
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 home">
											<select class="form-control" name="year">
											  <?php selectYear(); ?>
											</select>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 home">
											<button class="btn" name="update">UPDATE</button>
										</div>
									</div>
									<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
										<img class="avatar" src="<?php echo $info['avatar_url']; ?>">
										<input type="file" name="file" class="form-control home">
									</div>
								</div>
							</form>
          	</div>

	          <div id="changePass" class="tab-pane fade">
	            <h4>Đổi Mật Khẩu</h4>
							Để Bảo Mật Tài Khoản Vui Lòng Không Chia Sẻ Mật Khẩu Với Người Khác
							<hr>
							<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
								
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
								<form method="POST" action="">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 home">
										Mật Khẩu Cũ:
									</div>
									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 home">
										<input type="password" name="oldPassword" class="form-control" required>
										<p style="color: red;"><?php echo $errOldPass; ?></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 home">
										Mật Khẩu Mới:
									</div>
									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 home">
										<input type="password" name="newPassword" class="form-control" required>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 home">
										Xác Nhận Mật Khẩu Mới:
									</div>
									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 home">
										<input type="password" name="confirmPassword" class="form-control" required>
										<p style="color: red;"><?php echo $errConfirm; ?></p>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 home">
										<button class="btn" name="updatePass">UPDATE</button>
									</div>
								</form>
							</div>
							<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
								
							</div>
	          </div>

	          <div id="order" class="tab-pane fade">
	            <div class="tablist row">
		            <ul role="tablist" class="nav nav-tabs small">
		              <li class=" nav-item active col-lg-6 col-md-6 col-sm-6 col-xs-6">
		                <a href="#tabs-1" data-toggle="tab" aria-expanded="true"><h4>Đang Giao</h4></a>
		              </li>
		              <li class="nav-item col-lg-6 col-md-6 col-sm-6 col-xs-6">
		                <a href="#tabs-2" data-toggle="tab" aria-expanded="true"><h4><h4>Đã Giao</h4></a>
		              </li>
		            </ul>
		          </div>

		          <div class="tab-content">
		            <div id="tabs-1" class="tab-pane active">
		              
		            </div>

		            <div id="tabs-2" class="tab-pane fade">
		              
		            </div>

		            <div id="tabs-3" class="tab-pane fade">
		              
		            </div>
		          </div>
	          </div>

					</div>
					
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php include "footer.php" ;?>
</body>
</html>