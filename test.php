<?php echo password_hash('123', PASSWORD_DEFAULT); ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>
	<div id='view' class='modal fade' role='dialog'>
	    <div class='modal-dialog'>

	      <div class='modal-content'>
	        <div class='modal-header'>
	          <button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h3 class='modal-title'>ĐĂNG KÍ</h3>
	        </div>
	        <form method='POST' action=''>

	        	<div class='modal-body'>
		         	<div class='avatar text-center'>
		         		<img class='img-circle' width='150px' height='160px'> src='<?php echo $avatar_url; ?>'> <br>
		         		<p><b><?php echo $username; ?></b></p>
		         	</div>
		         	<div class='col-lg-3 col-md-3 col-sm-3 col-xs-2 home'>
						Họ Tên:
					</div>
					<div class='col-lg-9 col-md-9 col-sm-9 col-xs-9 home'>
						<?php echo $last_name. ' '. $first_name; ?>
					</div>
					<div class='col-lg-3 col-md-3 col-sm-3 col-xs-2 home'>
						Ngày Sinh:
					</div>
					<div class='col-lg-9 col-md-9 col-sm-9 col-xs-9 home'>
						<?php echo $birthday; ?>
					</div>
					<div class='col-lg-3 col-md-3 col-sm-3 col-xs-2 home'>
						Giới Tính:
					</div>
					<div class='col-lg-9 col-md-9 col-sm-9 col-xs-9 home'>
						<?php echo $birthday; ?>
					</div>
					<div class='col-lg-3 col-md-3 col-sm-3 col-xs-2 home'>
						Địa Chỉ:
					</div>
					<div class='col-lg-9 col-md-9 col-sm-9 col-xs-9 home'>
						<?php echo $address; ?>
					</div>
					<div class='col-lg-3 col-md-3 col-sm-3 col-xs-2 home'>
						Email:
					</div>
					<div class='col-lg-9 col-md-9 col-sm-9 col-xs-9 home'>
						<?php echo $email; ?>
					</div>
					<div class='col-lg-3 col-md-3 col-sm-3 col-xs-2 home'>
						Số Điện Thoại:
					</div>
					<div class='col-lg-9 col-md-9 col-sm-9 col-xs-9 home'>
						<?php echo $phone; ?>
					</div>
		        </div>

		        <div class='modal-footer'>
		        </div>
	        </form>
	      </div>

	    </div>
	</div>
</body>
</html>