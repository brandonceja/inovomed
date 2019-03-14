<?php 

/*Database connection*/

include "../dbh.php";

/*Variables*/

$consultorio = mysqli_real_escape_string($conn, $_GET['consultorio']);

/*Query to drop doctor*/

$sql = "DELETE FROM consultorios WHERE id_consultorio='".$consultorio."';";
$query = mysqli_query($conn, $sql);

header("location: ../../catalogo/consultorios.php?status=success");
exit();