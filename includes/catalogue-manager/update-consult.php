<?php 
	/*Database connection*/

	include "../dbh.php";

    /*POST variables*/
    $id =           mysqli_real_escape_string($conn, $_POST["id"]);
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
                
                /* Check if patient has already a scheduled consult */
                $sql = "SELECT * FROM citas WHERE id <> '$id' AND paciente = '$paciente'";
                $query = mysqli_query($conn, $sql);

                if(mysqli_num_rows($query) == 0){

                    /*Check if doctor is busy*/
                    $sql = "SELECT * FROM citas WHERE medico = '$medico' AND horario = '$hora' AND fecha = '$fecha' AND id != '$id';";
                    $query = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($query) == 0){  

                        /*Check if consult room is busy*/
                        $sql = "SELECT * FROM citas WHERE consultorio = '$consultorio' AND horario = '$hora' AND fecha = '$fecha' AND id != '$id';";
                        $query = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($query) == 0){

                             /*Check if specialties match*/
                            $sql = "SELECT * FROM medicos INNER JOIN consultorios ON medicos.especialidad = consultorios.especialidad
                                        WHERE medicos.cedula = '$medico' AND consultorios.id_consultorio='$consultorio';";
                            $query = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($query) > 0){

                                /*Delete previous schedule*/
                                $sql = "DELETE FROM citas WHERE id='".$id."';";
                                $query = mysqli_query($conn, $sql);


                                /*Insert into database*/
                                $sql = "INSERT INTO citas (id, medico, paciente, consultorio, horario, fecha) 
                                VALUES ('', '$medico', '$paciente', '$consultorio', '$hora', '$fecha')";
                                $query = mysqli_query($conn, $sql);

                                header("location: ../../catalogo/consultas.php?status=success");
                                exit();
                            }else{
                                header("location: ../../catalogo/consultas.php?error=doctor-and-consultorio-dont-match");
                                exit();
                            }  
                        }else{
                            header("location: ../../catalogo/consultas.php?error=consultorio-busy");
                            exit();
                        }  
                    }else{
                        header("location: ../../catalogo/consultas.php?error=doctor-busy");
                        exit();
                    }	
                }else{
                    header("location: ../../catalogo/consultas.php?error=patient-already-$id-scheduled");
				    exit();
                }	
			}else{
				header("location: ../../catalogo/consultas.php?error=invalid-char");
				exit();
			}
	}else{
		header("location: ../../catalogo/consultas.php?error=empty");
		exit();
	}
