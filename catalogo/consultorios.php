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
			<h2>Catálogo de consultorios</h2>
		</div>
		<<a href="../admin.php"><button class="lgn">Panel de administración</button></a>
	</div>
	<div class="catalogo">
<?php 
/*Database connection*/

include "../includes/dbh.php";


/* Queries to list consulting rooms*/

$sql = "SELECT * FROM consultorios INNER JOIN especialidades ON especialidades.id_especialidad = consultorios.especialidad;";
$query = mysqli_query($conn, $sql);

/*Table header*/

echo "<table>
		<thead>
			<tr>
				<th>Número</th>
				<th>Edificio</th>
				<th>Piso</th>
				<th>Horario</th>
				<th>Especialidad</th>
				</tr>
		</thead>";

/*List medics*/

while($row = mysqli_fetch_array($query)){
		
		/*
			0 		-> número de consultorio
			1 		-> edificio
			2 		-> piso
			3, 4	-> Horario (apertura-cierre)
			5		-> Especialidad
		*/

		echo "<tr>
				<th>".$row[0]."</th>
				<th>".$row[1]."</th>
				<th>".$row[2]."</th>
				<th>".$row[3]."-".$row[4]."</th>
				<th>".$row[7]."</th>
				<th><a href=\"../includes/catalogue-manager/drop-consultorio.php?consultorio=".$row[0]."\">Eliminar</a></th>
			 </tr>";							
}

/*End of table*/

echo "</table>";

?>
<div class="adder">
		<button class="lgn no-p hidder">Agregar Consultorio</button>
		<div class="hidden">
			<form action="../includes/catalogue-manager/add-consultorio.php" method="POST">
				<span>Número de consultorio</span><input type="number" name="numero"><br>
				<span>Edificio</span><input type="text" name="edificio"><br>
				<span>Piso</span><input type="number" name="piso"><br>
				<span>Horario de apertura</span><input type="time" name="a_time"><br>
				<span>Horario de cierre</span><input type="time" name="c_time"><br>
				<span>Especialidad</span><select name="especialidad">
<?php 

	/*Query to get specialties*/

	$sql = "SELECT * FROM especialidades;";
	$query =  mysqli_query($conn, $sql);

	/*Add specialties to select*/

	while($row = mysqli_fetch_array($query)){
		echo "<option value=".$row[0].">".
				$row[1].
			 "</option>";
	}

?>
				</select><br>
				<input type="submit" class="lgn no-p">
			</form>
		</div>
	</div>
</div>
<script src="../js/hide-element.js"></script>
</body>
</html>