<!DOCTYPE html>
<html lang="en">
<head>
	<title>InovoMed</title>
	<meta charset="utf-8 ">
	<link rel="stylesheet" href="../style/admin.css">
	<link rel="shortcut icon" href="../icon.bmp" type="image/x-icon" />
</head>
<body>
	<div id="menu">
		<div id="logo">
			<img src="../logo.png" alt="">
		</div>
		<div id="title">
			<h2>Catálogo de especialidades</h2>
		</div>
		<a href="../admin.php"><button class="lgn">Panel de administración</button></a>
	</div>
	<div class="catalogo">
<?php 
/*Database connection*/

include "../includes/dbh.php";


/* Queries to list specialties*/

$sql = "SELECT * FROM especialidades;";
$query = mysqli_query($conn, $sql);

/*Table header*/

echo "<table>
		<thead>
			<tr>
				<th>Identificador</th>
				<th>Especialidad</th>
				<th></th>
			</tr>
		</thead>";

/*List medics*/

while($row = mysqli_fetch_array($query)){
		
		/*
			0 		-> número de especialidad
			1 		-> nombre
		*/

		echo "<tr>
				<th>".$row[0]."</th>
				<th>".$row[1]."</th>
				<th><a href=\"../includes/catalogue-manager/drop-especialidad.php?especialidad=".$row[0]."\">Eliminar</a></th>
			 </tr>";							
}

/*End of table*/

echo "</table>";

?>
<div class="adder">
		<button class="lgn no-p hidder">Agregar Especialidad</button>
		<div class="hidden">
			<form action="../includes/catalogue-manager/add-especialidad.php" method="POST">
				<span>Nombre de especialidad</span><input type="text" name="especialidad">
				<input type="submit" class="lgn no-p">
			</form>
		</div>
	</div>
</div>
<script src="../js/hide-element.js"></script>
</body>
</html>