<?php 
	/*Database connection*/

	include "../dbh.php";

	/*POST variables*/
	$servicio =    	mysqli_real_escape_string($conn, $_POST["servicio"]);
	$fecha =    	mysqli_real_escape_string($conn, $_POST["fecha"]);
    $hora = 		mysqli_real_escape_string($conn, $_POST["hora"]);
	$paciente =     mysqli_real_escape_string($conn, $_POST["paciente"]);

	/*
		Check if empty
	*/

	if (!empty($servicio) && !empty($fecha) && !empty($hora) && !empty($paciente)) {
	
		/*Check regex*/

			if (is_numeric($servicio) && is_numeric($paciente)) {
                
                /* Check if patient has already a scheduled consult */
                $sql = "SELECT * FROM citas_lab WHERE paciente = '$paciente'";
                $query = mysqli_query($conn, $sql);

                if(mysqli_num_rows($query) == 0){

                        /*Check if consult room is busy*/
                        $sql = "SELECT * FROM citas_lab WHERE servicio = '$servicio' AND hora = '$hora' AND fecha = '$fecha';";
                        $query = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($query) == 0){
                                /*Insert into database*/
                                $sql = "INSERT INTO citas_lab (id, servicio, paciente, hora, fecha) 
                                VALUES ('', '$servicio', '$paciente', '$hora', '$fecha')";
                                $query = mysqli_query($conn, $sql);

                                header("location: ../../catalogo/citas_lab.php?status=success");
                                exit();
                        }else{
                            header("location: ../../catalogo/citas_lab.php?error=consultorio-busy");
                            exit();
                        }  
                }else{
                    header("location: ../../catalogo/citas_lab.php?error=patient-already-scheduled");
				    exit();
                }	
			}else{
				header("location: ../../catalogo/citas_lab.php?error=invalid-char");
				exit();
			}
	}else{
		header("location: ../../catalogo/citas_lab.php?error=empty");
		exit();
	}
