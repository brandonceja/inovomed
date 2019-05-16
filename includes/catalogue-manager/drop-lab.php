<?php 

/*Database connection*/

include "../dbh.php";

/*Variables*/

$id = mysqli_real_escape_string($conn, $_GET['consult']);

/*Query to drop doctor*/

$sql = "DELETE FROM citas_lab WHERE id='".$id."';";
$query = mysqli_query($conn, $sql);

header("location: ../../catalogo/citas_lab.php?status=success");
exit();