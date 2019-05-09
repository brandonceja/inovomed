<?php 
	/*Database connection*/

	include "../dbh.php";

	/*POST variables*/
    $nombre =    	mysqli_real_escape_string($conn, $_POST["nombre"]);
    $laboratorio = mysqli_real_escape_string($conn, $_POST["lab"]);
    $precio = 		mysqli_real_escape_string($conn, $_POST["precio"]);
    $cantidad =    	mysqli_real_escape_string($conn, $_POST["cantidad"]);
	
	/*
		Check if empty
	*/

	if (!empty($nombre) || !empty($laboratorio) || !empty($precio) || !empty($cantidad)) {
	
		/*Check regex*/

		if (preg_match("/^([a-zA-Z]*\s*)*$/", $nombre) && preg_match("/^([a-zA-Z]*\s*)*$/", $laboratorio)) {

			/*Check if numeric*/

			if (is_numeric($precio) && is_numeric($cantidad)) {

				/*Check if not registered med*/

				$sql = "SELECT * FROM medicamentos WHERE nombre='".$nombre."'";
				$query = mysqli_query($conn, $sql);

				if(mysqli_num_rows($query) == 0){			
				
					/*Insert into database*/

					$sql = "INSERT INTO medicamentos (nombre, laboratorio, precio, cantidad) 
							VALUES ('".$nombre."', '".$laboratorio."', '".$precio."', '".$cantidad."');";
					$query = mysqli_query($conn, $sql);

					header("location: ../../catalogo/medicamentos.php?status=success");
					exit();
				}else{
					header("location: ../../catalogo/medicamentos.php?error=medicamento-ya-registrado");
					exit();
				}
			}else{
				header("location: ../../catalogo/medicamentos.php?error=invalid-char");
				exit();
			}
		}else{
			header("location: ../../catalogo/medicamentos.php?error=invalid-char");
			exit();
		}
	}else{
		header("location: ../../catalogo/medicamentos.php?error=empty");
		exit();
	}
