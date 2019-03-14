<?php 
	/*Database connection*/

	include "../dbh.php";

    /*POST variables*/
    $id = $_POST["key"];
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
		|| !empty($t_fin) || !empty($especialidad)) {
	
        if(!empty($edificio)){
            if (preg_match("/^([a-zA-Z]*\s*)*$/", $edificio)) {
                $sql = "UPDATE consultorios set edificio = '$edificio' WHERE id_consultorio = '$id'";
                $query = mysqli_query($conn, $sql);
            }else{
                header("Location: ../../catalogo/medicos.php?doctor=error-change1");
                exit();
            }
        }
        
        if(!empty($piso)){
            if ( is_numeric($piso)) {
                $sql = "UPDATE consultorios set piso = '$piso' WHERE id_consultorio = '$id'";
                $query = mysqli_query($conn, $sql);
            }else{
                header("Location: ../../catalogo/medicos.php?doctor=error-change1");
                exit();
            }
        }

        if(!empty($t_inicio)){
            $sql = "UPDATE consultorios set horario_apertura = '$t_inicio' WHERE id_consultorio = '$id'";
            $query = mysqli_query($conn, $sql);
        }

        if(!empty($t_fin)){
            $sql = "UPDATE consultorios set horario_cierre = '$t_fin' WHERE id_consultorio = '$id'";
            $query = mysqli_query($conn, $sql);
        }

        if($especialidad != 0){
            $sql = "UPDATE consultorios set especialidad = '$especialidad' WHERE id_consultorio = '$id'";
            $query = mysqli_query($conn, $sql);
        }

        if(!empty($numero)){
            if ( is_numeric($numero)) {
                $sql = "UPDATE consultorios set id_consultorio = '$numero' WHERE id_consultorio = '$id'";
                $query = mysqli_query($conn, $sql);
            }else{
                header("Location: ../../catalogo/medicos.php?doctor=error-change1");
                exit();
            }
        }
        header("Location: ../../catalogo/consultorios.php?cons=success".$especialidad);
			exit();
		
	}else{
		header("location: ../../catalogo/consultorios.php?error=empty");
		exit();
	}
