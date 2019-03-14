<?php 

/*Database connection*/

include "../dbh.php";

/*Variables*/

$cedula = mysqli_real_escape_string($conn, $_GET['doctor']);

/*Query to drop doctor*/

$sql = "DELETE FROM medicos WHERE cedula='".$cedula."';";
$query = mysqli_query($conn, $sql);

header("location: ../../catalogo/medicos.php?status=success");
exit();