<?php 

/*Database connection*/

include "../dbh.php";

/*Variables*/

$med = mysqli_real_escape_string($conn, $_GET['med']);

/*Query to drop doctor*/

$sql = "DELETE FROM medicamentos WHERE codigo='".$med."';";
$query = mysqli_query($conn, $sql);

header("location: ../../catalogo/medicamentos.php?status=success");
exit();