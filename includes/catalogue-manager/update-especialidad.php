<?php 
	/*Database connection*/

	include "../dbh.php";

	/*POST variables*/
    $especialidad = mysqli_real_escape_string($conn, $_POST["especialidad"]);
    $id = $_POST["key"];

	/*Check if empty*/

	if (!empty($especialidad)) {
	
		/*Check regex*/

		if (preg_match("/^([a-zA-Z]*\s*)*$/", $especialidad)) {


			$sql = "SELECT nombre FROM especialidades WHERE nombre = '$especialidad'";
			$query = mysqli_query($conn, $sql);

			//Check if existing

			if(mysqli_num_rows($query) == 0){	
				/*Insert into database*/
				$sql = "UPDATE especialidades SET nombre ='".$especialidad."' WHERE id_especialidad = '$id';";
				$query = mysqli_query($conn, $sql);

				header("location: ../../catalogo/especialidades.php?status=success");
				exit();
			}else{
				header("location: ../../catalogo/especialidades.php?error=existing");
				exit();
			}
		}else{
			header("location: ../../catalogo/especialidades.php?error=invalid-char");
			exit();
		}
	}else{
		header("location: ../../catalogo/especialidades.php?error=empty");
		exit();
	}
