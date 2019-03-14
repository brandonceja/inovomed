<?php 
	/*Database connection*/

	include "../dbh.php";

	/*POST variables*/
	$numero =    	mysqli_real_escape_string($conn, $_POST["numero"]);
	$edificio =    	mysqli_real_escape_string($conn, $_POST["edificio"]);
	$piso = 		mysqli_real_escape_string($conn, $_POST["piso"]);
	$t_inicio = 	mysqli_real_escape_string($conn, $_POST["a_time"]);
	$t_fin =   		mysqli_real_escape_string($conn, $_POST["c_time"]);
	$especialidad = mysqli_real_escape_string($conn, $_POST["especialidad"]);

	/*
		Check if empty
	*/

	if (!empty($numero) || !empty($edificio) || !empty($piso) || !empty($t_inicio)
		&& !empty($t_fin) || !empty($especialidad)) {
	
		/*Check regex*/

		if (preg_match("/^([a-zA-Z]*\s*)*$/", $edificio)) {

			/*Check if numeric*/

			if (is_numeric($numero) && is_numeric($piso) && is_numeric($especialidad)) {

				/*Check if not registered cedula*/

				$sql = "SELECT id_consultorio FROM consultorios WHERE id_consultorio='".$numero."'";
				$query = mysqli_query($conn, $sql);

				if(mysqli_num_rows($query) == 0){			
				
					/*Insert into database*/

					$sql = "INSERT INTO consultorios (id_consultorio, edificio, piso, horario_apertura, horario_cierre, especialidad) 
							VALUES ('".$numero."', '".$edificio."', '".$piso."', '".$t_inicio."', '".$t_fin."', '".$especialidad."');";
					$query = mysqli_query($conn, $sql);

					header("location: ../../catalogo/consultorios.php?status=success");
					exit();
				}else{
					header("location: ../../catalogo/consultorios.php?error=consultorio-ya-registrado");
					exit();
				}
			}else{
				header("location: ../../catalogo/consultorios.php?error=invalid-char");
				exit();
			}
		}else{
			header("location: ../../catalogo/consultorios.php?error=invalid-char");
			exit();
		}
	}else{
		header("location: ../../catalogo/consultorios.php?error=empty");
		exit();
	}
