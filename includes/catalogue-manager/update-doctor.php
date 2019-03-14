<?php 
	if(isset($_POST)){

		/*Database connection*/
		include "../dbh.php";


		/*POST variables*/
		$cedula =    	$_POST["key"];
		$cedula_changed =  mysqli_real_escape_string($conn, $_POST["cedula"]);
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

	if (!empty($cedula) || !empty($nombre) || !empty($apellidop) || !empty($apellidom)
		|| !empty($fecha_nac) || !empty($colonia) || !empty($calle) || !empty($numero) || !empty($especialidad)) {
			
			if(!empty($nombre)){
				if(preg_match("/^([a-zA-Z]*\s*)*$/", $nombre)){
					$sql = "UPDATE medicos SET nombres='$nombre' WHERE cedula='$cedula'";
					$query = mysqli_query($conn, $sql);
					header("Location: ../../catalogo/medicos.php?doctor=success".$cedula);
					exit();
				}else{
					header("Location: ../../catalogo/medicos.php?doctor=error-change1");
					exit();
				}
			}
			if(!empty($apellidop)){
				if(preg_match("/^([a-zA-Z]*\s*)*$/", $apellidop)){
					$sql = "UPDATE medicos SET apellidoP = '".$apellidop."' WHERE cedula = ".$cedula;
					$query = mysqli_query($conn, $sql);
				}else{
					header("Location: ../../catalogo/medicos.php?doctor=error-change2");
					exit();
				}
			}
			if(!empty($apellidom)){
				if(preg_match("/^([a-zA-Z]*\s*)*$/", $apellidom)){
					$sql = "UPDATE medicos SET apellidoM = '".$apellidom."' WHERE cedula = ".$cedula;
					$query = mysqli_query($conn, $sql);
				}else{
					header("Location: ../../catalogo/medicos.php?doctor=error-change3");
					exit();
				}
			}
			if(!empty($fecha_nac)){
				$sql = "UPDATE medicos SET nombre = '".$nombre."' WHERE cedula = ".$cedula;
				$query = mysqli_query($conn, $sql);
			}
			if(!empty($colonia)){
				if(preg_match("/^([a-zA-Z]*\s*)*$/", $colonia)){
					$sql = "UPDATE medicos SET colonia = '".$colonia."' WHERE cedula = ".$cedula;
					$query = mysqli_query($conn, $sql);
				}else{
					header("Location: ../../catalogo/medicos.php?doctor=error-change4");
					exit();
				}
			}
			if(!empty($calle)){
				if(preg_match("/^([a-zA-Z]*\s*)*$/", $calle)){
					$sql = "UPDATE medicos SET calle = '".$calle."' WHERE cedula = ".$cedula;
					$query = mysqli_query($conn, $sql);
				}else{
					header("Location: ../../catalogo/medicos.php?doctor=error-change5");
					exit();
				}
			}
			if(!empty($numero)){
				if(is_numeric($numero)){
					$sql = "UPDATE medicos SET numero = '".$numero."' WHERE cedula = ".$cedula;
					$query = mysqli_query($conn, $sql);
				}else{
					header("Location: ../../catalogo/medicos.php?doctor=error-change6");
					exit();
				}
			}
			if(!empty($especialidad)){
				if(is_numeric($especialidad)){
					$sql = "UPDATE medicos SET especialidad = '".$especialidad."' WHERE cedula = ".$cedula;
					$query = mysqli_query($conn, $sql);
				}else{
					header("Location: ../../catalogo/medicos.php?doctor=error-change7");
					exit();
				}
			}
			if(!empty($cedula_changed)){
				if(is_numeric($cedula_changed) && strlen($cedula_changed)==8){
					$sql = "UPDATE medicos SET cedula = '".$cedula_changed."' WHERE cedula = ".$cedula;
					$query = mysqli_query($conn, $sql);
				}else{
					header("Location: ../../catalogo/medicos.php?doctor=error-change8");
					exit();
				}
			}
		}else{
			header("Location: ../../catalogo/medicos.php?error=empty");
			exit();
		}
	}