<?php 
	session_start();
	if(isset($_POST['submit'])){
		include 'dbh.php';
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		//Error handlers
		//Check if empty
		if(empty($username) || empty($pwd)){
			header("Location: ../index.php?login=empty");
			exit();
		}else{
			$sql = "SELECT * FROM users WHERE username='$username' OR email='$username'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck < 1){
				header("Location: ../index.php?login=error");
				exit();
			}else{
				if($row = mysqli_fetch_assoc($result)){
					//De-hashing the password
					$hashedPwdCheck = password_verify($pwd, $row['pass']);
					if($hashedPwdCheck == false){
						header("Location: ../index.php?login=error");
						exit();
					}elseif($hashedPwdCheck == true){
						//login the user here
						$_SESSION['u_id'] = $row['id'];
						$_SESSION['u_first'] = $row['first'];
						$_SESSION['u_last'] = $row['last'];
						$_SESSION['u_email'] = $row['email'];
						$_SESSION['u_name'] = $row['username'];
						header("Location: ../index.php?login=success");
						exit();
					}
				}
			}
		}
	}else{
		header("Location: ../index.php?login=error");
		exit();
	}