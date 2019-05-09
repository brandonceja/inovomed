<?php 
	/*Database connection*/

	include "../dbh.php";

    /*POST variables*/
    $id = $_POST["key"];
    $nombre =    	mysqli_real_escape_string($conn, $_POST["nombre"]);
    $laboratorio = mysqli_real_escape_string($conn, $_POST["lab"]);
    $precio = 		mysqli_real_escape_string($conn, $_POST["precio"]);
    $cantidad =    	mysqli_real_escape_string($conn, $_POST["cantidad"]);
	

	/*
		Check if empty
	*/

	if (!empty($nombre) || !empty($laboratorio) || !empty($precio) || !empty($cantidad)) {
	
        if(!empty($nombre)){
            if (preg_match("/^([a-zA-Z]*\s*)*$/", $nombre)) {
                $sql = "UPDATE medicamentos set nombre = '$nombre' WHERE codigo = '$id'";
                $query = mysqli_query($conn, $sql);
            }else{
                header("Location: ../../catalogo/medicamentos.php?medicamento=error-change");
                exit();
            }
        }

        if(!empty($laboratorio)){
            if (preg_match("/^([a-zA-Z]*\s*)*$/", $laboratorio)) {
                $sql = "UPDATE medicamentos set laboratorio = '$laboratorio' WHERE codigo = '$id'";
                $query = mysqli_query($conn, $sql);
            }else{
                header("Location: ../../catalogo/medicamentos.php?medicamento=error-change");
                exit();
            }
        }
        
        if(!empty($precio)){
            if ( is_numeric($precio)) {
                $sql = "UPDATE medicamentos set precio = '$precio' WHERE codigo = '$id'";
                $query = mysqli_query($conn, $sql);
            }else{
                header("Location: ../../catalogo/medicamentos.php?medicamento=error-change");
                exit();
            }
        }

        if(!empty($cantidad)){
            if ( is_numeric($cantidad)) {
                $sql = "UPDATE medicamentos set cantidad = '$cantidad' WHERE codigo = '$id'";
                $query = mysqli_query($conn, $sql);
            }else{
                header("Location: ../../catalogo/medicamentos.php?medicamento=error-change");
                exit();
            }
        }

        header("Location: ../../catalogo/medicamentos.php?medicamento=success");
        exit();
        
	}else{
        header("Location: ../../catalogo/medicamentos.php?medicamento=empty");
        exit();
	}
