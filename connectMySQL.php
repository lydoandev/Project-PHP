<?php
	$connect = mysqli_connect("localhost","root","","sell_leather");
	mysqli_set_charset($connect,'UTF8');

	class user
	{
		var $username;
		var $password;
		var $avatar_url;
		var $first_name;
		var $last_name;
		var $birthday;
		var $gender;
		var $email;
		var $address;
		var $phone;
		function __construct()
		{

		}

		function newInsert_update($username,$password,$avatar_url,$first_name,$last_name, $birthday,$gender,$email,$address,$phone){
			$this->username = $username;
			$this->password = $password;
			$this->avatar_url = $avatar_url;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->birthday = $birthday;
			$this->gender = $gender;
			$this->email = $email;
			$this->address = $address;
			$this->phone = $phone;
		}

		function newLogin($username, $password){
			$this->username = $username;
			$this->password = $password;
		}

		function showInfo($connect, $username){
			$sql = "SELECT * FROM users WHERE username = '" . $username . "'";
			$result = $connect->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				return $row;
			}
			return 0;
		}

		function check_username($connect, $username){
			if ($connect) {
				$sql = "SELECT username FROM users WHERE username = '$username' ";
				$result = $connect->query($sql);
				if ($result->num_rows > 0) {
					return 0;
				} else return 1;
			} else echo "Failed to connect to MySQL:" .mysqli_connect_error();
			
		}

		function check_email($connect, $email){
			if ($connect) {
				$sql = "SELECT * FROM users WHERE email = '$email' ";
				$result = $connect->query($sql);
				if ($result->num_rows > 0) {
					return 0;
				} else return 1;
			} else echo "Failed to connect to MySQL:" .mysqli_connect_error();
			
		}

		function insert_user($connect, $last_name, $first_name, $email, $address, $phone, $gender, $birthday, $username, $password){
			if ($connect) {
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
				$sql = "INSERT INTO users
						VALUES ('$username', '$hashed_password', 'Image/acount.png', '$first_name', '$last_name', '$birthday', '$gender', '$email', '$address', '$phone', NOW(),'customer', NOW(), 1);";
				if ($this->check_username($connect, $username)) {
					if ($this->check_email($connect, $email)) {
						if ($connect->query($sql)) {

						echo "connect";
							$_SESSION['username'] = $username;
							$_SESSION['avatar_url'] = 'Image/acount.png';
							echo "<script> alert('Chào mừng $username đến với LEONARDO Shop');</script>";
							header("Location: home.php");
						}
					}else echo "<script> alert('Email đã được đăng kí');</script>";
				}else echo "<script> alert('User name đã tồn tại');</script>";
			} else echo "Failed to connect to MySQL:" .mysqli_connect_error();
		}

		function check_login($connect, $username, $password){
			
	     	$sql = "SELECT * FROM users WHERE username = '" . $username . "' LIMIT 1";

			$result = $connect->query($sql);

			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				if (password_verify($password, $row['password'])) {
					$_SESSION['username'] = $username;
					$_SESSION['avatar_url'] = $row['avatar_url'];
					if (isset($_POST['remember'])) {
						setcookie("username", "", time() - 3600); // Cho thằng cookie sống trong 0s :))
						setcookie("password", "", time() - 3600);
						setcookie('username', $_POST['username'], time() + (86400 * 30), "/");
						setcookie('password', $_POST['password'], time() + (86400 * 30), "/");
					}
					$sql = "UPDATE users SET last_access = NOW() WHERE username = '$username'";
					$connect->query($sql);
					if ($row['u_role'] == "admin") {
						echo "<script>
						 alert('Chào Mừng Bạn Đến Với Trang Quản Lí Của Admin');
						 window.location.replace('./administrator.php');
						</script>";
					}else if ($row['u_role'] == "stocker") {
						echo "<script>
						 alert('Chào Mừng Bạn Đến Với Trang Quản Lí Của Thủ Kho');
						 window.location.replace('./stocker.php');
						</script>";
					}else 
						echo "<script>
						 alert('Chào Mừng Bạn Đến Với Trang Mua Sắm LENARDO Shop');
						 window.location.replace('./home.php');
						</script>";
				} else {
					echo "<script> alert('Password không chính xác');</script>";
				}
			} else {
				echo "<script> alert('User name không tồn tại');</script>";
			}
  		}

		function updateInfo($connect, $username, $avatar_url, $last_name, $first_name, $email, $address, $phone, $gender, $birthday){
			if ($connect) {
				if ($avatar_url != 'avatars/') {
					$sql = "UPDATE users SET avatar_url= '$avatar_url', last_name = '$last_name', first_name = '$first_name', email = '$email', address = '$address', phone = '$phone', gender = '$gender', birthday = '$birthday' WHERE username = '$username'";
					if ($connect->query($sql)) {
						$_SESSION['avatar_url'] = $avatar_url;
						echo "<script> alert('Update thành công');</script>";
						header('Location: profile.php');
					}
				}else{
					$sql = "UPDATE users SET last_name = '$last_name', first_name = '$first_name', email = '$email', address = '$address', phone = '$phone', gender = '$gender', birthday = '$birthday' WHERE username = '$username'";
					if ($connect->query($sql)) {
						echo "<script>
						 alert('Update thành công');
						 window.location.replace('./profile.php');
						</script>";
					}
				}
				
				
			}
		}

		function updatePassword($connect, $username, $oldPassword, $newPassword){
			if ($connect) {
				$err = "";
				$hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
				$check_old_pass = "SELECT password FROM users WHERE username = '" . $username . "' LIMIT 1";
				$result = $connect->query($check_old_pass);
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					if (password_verify($oldPassword, $row['password'])) {
						$sql = "UPDATE users SET password = '$hashed_password' WHERE username = '$username'";
						if ($connect->query($sql)) {
							echo "<script> alert('Cập Nhật Password Thành Công');</script>";
						}
					} else {
						$err = "* Password cũ không chính xác";
					}
				}
				return $err;
			}
		}

	}

	function showInfoProduct($prod_id, $name, $image, $price, $new_price){
		echo "
			<div class='col-lg-3 col-md-3 col-sm-6 col-xs-6'>
			<div class='product-item'>
				<div class='product-image'>
					<img src='$image'>
				</div>

				<div class='product-control'>
					<button class='btn' value = '$prod_id'>
						<i class='fa fa-cart-plus fa-lg'></i>Giỏ hàng
					</button>
					<button class='btn'>
						<i class='fa fa-eye fa-lg'></i>
					</button>
				</div>'
				<div class='caption'>
					
				</div>
			</div>
		</div>
		";
	}

	if (isset($_GET["username"])) {
		$sql = "DELETE FROM users WHERE username = '" . $_GET["username"] . "'";
		if ($connect->query($sql)) {
			echo "<script>
			 alert('Xóa Thành Công Tài Khoản');
			 window.location.replace('./administrator.php');
			 </script>";
		}
	}
	function adminView($username, $avatar_url, $last_name, $first_name, $birthday, $gender, $email, $address, $phone, $u_role, $is_active, $last_access){
		echo "
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
			";
	}

	

	function showAllUsers($connect){
		if ($connect) {
			$sql = "SELECT * FROM users";
			$result = $connect->query($sql);
			$stt = 1;
			if ($result->num_rows > 0) {
				echo "<table class='table table-bordered'>
							    <thead>
							      <tr>
							      	<th>STT</th>
							        <th>UserName</th>
							        <th>Họ Tên</th>
							        <th>Ngày Sinh</th>
							        <th>Giới Tính</th>
							        <th>Vai Trò</th>
							        <th>Tình Trạng</th>
							        <th>Đăng Nhập Cuối</th>
							        <th>Thao Tác</th>
							      </tr>
							    </thead>
							    <tbody>";
			    while($row = $result->fetch_assoc()) {
			    	echo "
			    		<tr> <td>$stt</td>
				        <td>" . $row['username'] . "</td>
				        <td>" . $row['last_name']." " .$row['first_name']. "</td>
				        <td>" . $row['birthday'] . "</td>
				        <td>" . $row['gender'] . "</td>
				        <td>" . $row['u_role'] . "</td>
				        <td>" . $row['is_active'] . "</td>
				        <td>" . $row['last_access'] . "</td>
				        <td class = 'text-center'>
				        	<a href='connectMySQL.php?viewUsername=" . $row['username'] . "' data-toggle='modal' data-target='#view'><i class = 'fa fa-eye' style='color: #3399ff;'></i></a> &nbsp;
									<a href='connectMySQL.php?username=" . $row['username'] . "'><i class = 'fa fa-trash-o' style='color: red;'></i></a>
				        </td>
				      </tr>
			    	";
			    	$stt++;
			    }
			    echo "</tbody>
							  </table>";
			} else {
			    echo "0 results";
			}
		}
	}	
 ?>	
