<?php 
	if(isset($_POST['submit'])){
		include_once 'dbh.php';
		$first = mysqli_real_escape_string($conn, $_POST['first']);
		$last = mysqli_real_escape_string($conn, $_POST['last']);
		$last2 = mysqli_real_escape_string($conn, $_POST['last2']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$uid = mysqli_real_escape_string($conn, $_POST['username']);
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		$date = mysqli_real_escape_string($conn, $_POST['date']);
		$colon = mysqli_real_escape_string($conn, $_POST['colon']);
		$calle = mysqli_real_escape_string($conn, $_POST['calle']);
		$number = mysqli_real_escape_string($conn, $_POST['number']);
		//Error handlers
		//Check for empty fields
		if(empty($first) || empty($last) || empty($last2) || empty($email) || empty($uid) || empty($pwd) || empty($date) || empty($colon) || 
			empty($calle) || empty($number)){
			header("location: ../signup-view.php?signup=empty");
			exit();
		}else{
			//Check if input characters are valid
			if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last) || !preg_match("/^[a-zA-Z]*$/", $last2)){
				header("location: ../signup-view.php?signup=invalid");
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
						$sql = "INSERT INTO users (nombre, apellidoP, apellidoM, username, pass, email, fecha_nac, colonia, calle, numero)
							 VALUES ('$first', '$last', '$last2', '$uid', '$hashedPwd', '$email', '$date', '$colon', '$calle','$number');";
						mysqli_query($conn, $sql);
						$_SESSION['u_id'] = $row['id'];
						$_SESSION['u_nameR'] = $row['nombre'];
						$_SESSION['u_apat'] = $row['apellidoP'];
						$_SESSION['u_amat'] = $row['apellidoM'];
						$_SESSION['u_name'] = $row['username'];
						$_SESSION['u_email'] = $row['email'];
						$_SESSION['u_fecha'] = $row['fecha_nac'];
						$_SESSION['u_colonia'] = $row['colonia'];
						$_SESSION['u_calle'] = $row['calle'];
						$_SESSION['u_num'] = $row['numero'];

						header("location: ../includes/users/profile.php");
						exit();
					}
				}
			}
		}
	}else{
		header("location: ../signup-view.php");
		exit();
	}