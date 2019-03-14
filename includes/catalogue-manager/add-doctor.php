<?php 
	/*Database connection*/

	include "../dbh.php";

	/*POST variables*/
	$cedula =    	mysqli_real_escape_string($conn, $_POST["cedula"]);
	$nombre =    	mysqli_real_escape_string($conn, $_POST["nombre"]);
	$apellidop = 	mysqli_real_escape_string($conn, $_POST["apellidop"]);
	$apellidom = 	mysqli_real_escape_string($conn, $_POST["apellidom"]);
	$fecha_nac = 	mysqli_real_escape_string($conn, $_POST["fecha"]);
	$colonia =   	mysqli_real_escape_string($conn, $_POST["colonia"]);
	$calle = 	 	mysqli_real_escape_string($conn, $_POST["calle"]);
	$numero = 	 	mysqli_real_escape_string($conn, $_POST["numero"]);
	$especialidad = mysqli_real_escape_string($conn, $_POST["especialidad"]);

	/*
		Check if empty
		Cedula  length
		Positive Street number
	*/

	if (!empty($cedula) && !empty($nombre) && !empty($apellidop) && !empty($apellidom)
		&& !empty($fecha_nac) && !empty($colonia) && !empty($calle) && !empty($numero) && !empty($especialidad) && strlen($cedula)== 8 && $numero > 1) {
	
		/*Check regex*/

		if (preg_match("/^([a-zA-Z]*\s*)*$/", $nombre) && preg_match("/^([a-zA-Z]*\s*)*$/", $apellidop) &&
		 preg_match("/^([a-zA-Z]*\s*)*$/", $apellidom) && preg_match("/^([a-zA-Z]*\s*)*$/", $colonia) && 
		 preg_match("/^([a-zA-Z]*\s*)*$/", $calle)) {

			/*Check if numeric*/

			if (is_numeric($cedula) && is_numeric($numero) && is_numeric($especialidad)) {

				/*Check if not registered cedula*/

				$sql = "SELECT cedula FROM medicos WHERE cedula='".$cedula."'";
				$query = mysqli_query($conn, $sql);

				if(mysqli_num_rows($query) == 0){			
				
					/*Insert into database*/

					$sql = "INSERT INTO medicos (cedula, nombres, apellidoP, apellidoM, fecha_nac, colonia, calle, numero, especialidad) 
							VALUES ('".$cedula."', '".$nombre."', '".$apellidop."', '".$apellidom."', '".$fecha_nac."', '".$colonia."', '".$calle."',
							'".$numero."' ,'".$especialidad."');";
					$query = mysqli_query($conn, $sql);

					header("location: ../../catalogo/medicos.php?status=success");
					exit();
				}else{
					header("location: ../../catalogo/medicos.php?error=cedula-ya-registrada");
					exit();
				}
			}else{
				header("location: ../../catalogo/medicos.php?error=invalid-char");
				exit();
			}
		}else{
			header("location: ../../catalogo/medicos.php?error=invalid-char");
			exit();
		}
	}else{
		header("location: ../../catalogo/medicos.php?error=empty");
		exit();
	}
