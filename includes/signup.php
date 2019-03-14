<?php 
	if(isset($_POST['submit'])){
		include_once 'dbh.php';
		$first = mysqli_real_escape_string($conn, $_POST['first']);
		$last = mysqli_real_escape_string($conn, $_POST['last']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$uid = mysqli_real_escape_string($conn, $_POST['username']);
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		//Error handlers
		//Check for empty fields
		if(empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)){
			header("location: ../signup-view.php?signup=empty");
			exit();
		}else{
			//Check if input characters are valid
			if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
				header("location: ../signup.php?signup=invalid");
				exit();
			}else{
				//Check if email is valid
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					header("location: ../signup-view.php?signup=email");
					exit();
				}
				else{
					$sql = "SELECT * FROM users WHERE username='$uid'";
					$result = mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($result);
					if($resultCheck > 0){
						header("location: ../signup-view.php?signup=usertaken");
						exit();
					}else{
						//Hashing the password
						$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
						//Insert the user in the database
						$sql = "INSERT INTO users (first, last, username, pass, email) VALUES ('$first', '$last', '$uid', '$hashedPwd', '$email');";
						mysqli_query($conn, $sql);
						//login the user here
						$_SESSION['u_id'] = $row['id'];
						$_SESSION['u_first'] = $row['first'];
						$_SESSION['u_last'] = $row['last'];
						$_SESSION['u_email'] = $row['email'];
						$_SESSION['u_name'] = $row['username'];


						header("location: ../index.php?login=true");
						exit();
					}
				}
			}
		}
	}else{
		header("location: ../signup-view.php");
		exit();
	}