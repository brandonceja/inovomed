<?php 
	/*Database connection*/

	include "../dbh.php";

	/*POST variables*/
	$medico =    	mysqli_real_escape_string($conn, $_POST["medico"]);
	$fecha =    	mysqli_real_escape_string($conn, $_POST["fecha"]);
    $hora = 		mysqli_real_escape_string($conn, $_POST["hora"]);
    $consultorio=   mysqli_real_escape_string($conn, $_POST["consultorio"]);
	$paciente =     mysqli_real_escape_string($conn, $_POST["paciente"]);

	/*
		Check if empty
	*/

	if (!empty($medico) && !empty($fecha) && !empty($hora) && !empty($consultorio) && !empty($paciente)) {
	
		/*Check regex*/

			if (is_numeric($medico) && is_numeric($consultorio) && is_numeric($paciente)) {
				
					/*Insert into database*/

                    $sql = "INSERT INTO citas (id, medico, paciente, consultorio, horario, fecha) 
                                VALUES ('', '$medico', '$paciente', '$consultorio', '$hora', '$fecha')";
					$query = mysqli_query($conn, $sql);

					header("location: ../../catalogo/consultas.php?status=success");
					exit();
				
			}else{
				header("location: ../../catalogo/consultas.php?error=invalid-char");
				exit();
			}
	}else{
		header("location: ../../catalogo/consultas.php?error=empty");
		exit();
	}
