<?php 

/*Database connection*/

include "../dbh.php";

/*Variables*/

$id = mysqli_real_escape_string($conn, $_GET['consult']);

/*Query to drop doctor*/

$sql = "DELETE FROM citas WHERE id='".$id."';";
$query = mysqli_query($conn, $sql);

header("location: ../../catalogo/consultas.php?status=success");
exit();