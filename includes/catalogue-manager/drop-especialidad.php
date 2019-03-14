<?php 

/*Database connection*/

include "../dbh.php";

/*Variables*/

$id = mysqli_real_escape_string($conn, $_GET['especialidad']);

/*Query to drop doctor*/

$sql = "DELETE FROM especialidades WHERE id_especialidad='".$id."';";
$query = mysqli_query($conn, $sql);

header("location: ../../catalogo/especialidades.php?status=success");
exit();