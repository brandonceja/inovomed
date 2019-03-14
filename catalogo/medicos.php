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
			<h2>Catálogo de médicos</h2>
		</div>
		<a href="../admin.php"><button class="lgn">Panel de administración</button></a>
	</div>
	<div class="catalogo">

<?php 
/*Database connection*/

include "../includes/dbh.php";


/* Queries to list medics*/

$sql = "SELECT * FROM medicos INNER JOIN especialidades ON especialidades.id_especialidad = medicos.especialidad;";
$query = mysqli_query($conn, $sql);

/*Table header*/

echo "<table>
		<thead>
			<tr>
				<th>Cédula</th>
				<th>Nombre(s)</th>
				<th>Apellido Paterno</th>
				<th>Apellido Materno</th>
				<th>Fecha nacimiento</th>
				<th>Dirección</th>
				<th>Especialidad</th>
				<th></th>
				<th></th>
				</tr>
		</thead>";

/*List medics*/

while($row = mysqli_fetch_array($query)){
		
		/*
			0 		-> cedula
			1 		-> nombres
			2 		-> Apellido P
			3 		-> Apellido M
			4 		-> Fecha Nacimiento
			5,6,7	-> Direccion (Colonia, calle #número)
			10		-> Especialidad
		*/

		echo "<tr>
				<th>".$row[0]."</th>
				<th>".$row[1]."</th>
				<th>".$row[2]."</th>
				<th>".$row[3]."</th>
				<th>".$row[4]."</th>
				<th>".$row[5].", ".$row[6]." #".$row[7]."</th>
				<th>".$row[10]."</th>
				<th><a href=\"javascript:void(0)\" class=\"yellow upd\" id=\"".$row[0]."\">modificar</a></th>
				<th><a href=\"../includes/catalogue-manager/drop-doctor.php?doctor=".$row[0]."\">eliminar</a></th>
			 </tr>";							
}

/*End of table*/

echo "</table>";

?>
	</div>
	<div class="adder">
		<button class="lgn no-p hidder" id="add">Agregar Médico</button>
		<div class="hidden">
			<form action="../includes/catalogue-manager/add-doctor.php" method="POST">
				<span>Cédula profesional</span><input type="number" name="cedula"><br>
				<span>Nombre(s)</span><input type="text" name="nombre"><br>
				<span>Apellido Paterno</span><input type="text" name="apellidop"><br>
				<span>Apellido Materno</span><input type="text" name="apellidom"><br>
				<span>Fecha de nacimiento</span><input type="date" name="fecha">
				<p>Dirección: </p>
				<span>Colonia</span><input type="text" name="colonia"><br>
				<span>Calle</span><input type="text" name="calle"><br>
				<span>Número</span><input type="number" name="numero"><br>
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
		<!-- Updater -->
		<div class="updater">
			<br><br>
			<h2>Modifique los datos necesarios, los demás déjelos vacios.</h2>
			<form action="../includes/catalogue-manager/update-doctor.php" method="POST">
				<span>Cédula profesional</span><input type="number" name="cedula"><br>
				<input id="key" type="hidden" value="none" name="key">
				<span>Nombre(s)</span><input type="text" name="nombre"><br>
				<span>Apellido Paterno</span><input type="text" name="apellidop"><br>
				<span>Apellido Materno</span><input type="text" name="apellidom"><br>
				<span>Fecha de nacimiento</span><input type="date" name="fecha">
				<p>Dirección: </p>
				<span>Colonia</span><input type="text" name="colonia"><br>
				<span>Calle</span><input type="text" name="calle"><br>
				<span>Número</span><input type="number" name="numero"><br>
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
<script src="../js/hide-element.js"></script>
</body>
</html>