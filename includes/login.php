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
				$sql = "SELECT * FROM medicos WHERE nombres='$username'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
				
				if($resultCheck < 1){
					header("Location: ../index.php?login=error");
					exit();
				}else{
					if($row = mysqli_fetch_assoc($result)){
						//checking password
						if($row['password'] != $pwd){
							header("Location: ../index.php?login=error");
							exit();
						}else{
							//login the user here
							$_SESSION['u_id'] = $row['cedula'];
							$_SESSION['u_name'] = $row['nombres'];
							$_SESSION['u_apat'] = $row['apellidoP'];
							$_SESSION['u_amat'] = $row['apellidoM'];
							$_SESSION['u_fecha'] = $row['fecha_nac'];
							$_SESSION['u_colonia'] = $row['colonia'];
							$_SESSION['u_email'] = $row['email'];
							$_SESSION['u_calle'] = $row['calle'];
							$_SESSION['u_num'] = $row['numero'];
							$_SESSION['u_especialidad'] = $row['especialidad'];
							header("Location: ../includes/users/profile-doctor.php?login=success");
							exit();
						}
					}
				}
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
						$_SESSION['u_nameR'] = $row['nombre'];
						$_SESSION['u_apat'] = $row['apellidoP'];
						$_SESSION['u_amat'] = $row['apellidoM'];
						$_SESSION['u_name'] = $row['username'];
						$_SESSION['u_email'] = $row['email'];
						$_SESSION['u_fecha'] = $row['fecha_nac'];
						$_SESSION['u_colonia'] = $row['colonia'];
						$_SESSION['u_calle'] = $row['calle'];
						$_SESSION['u_num'] = $row['numero'];
						header("Location: ../includes/users/profile.php?login=success");
						exit();
					}
				}
			}
		}
	}else{
		header("Location: ../index.php?login=error");
		exit();
	}