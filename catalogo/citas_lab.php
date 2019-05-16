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
			<h2>Catálogo de citas en laboratorio</h2>
		</div>
		<a href="../admin.php"><button class="lgn">Panel de administración</button></a>
	</div>
	<div class="catalogo">

<?php 
/*Database connection*/

include "../includes/dbh.php";


/* Queries to list medics*/

$sql = "SELECT * FROM citas_lab  INNER JOIN users ON users.id = citas_lab.paciente 
        INNER JOIN servicios ON servicios.id = citas_lab.servicio;";
$query = mysqli_query($conn, $sql);

/*Table header*/

echo "<table>
		<thead>
			<tr>
				<th>id</th>
                <th>Servicio</th>
                <th>Paciente</th>
				<th>Fecha</th>
                <th>Hora</th>
                <th></th>
                <th></th>
			</tr>
		</thead>";

/*List consults*/

while($row = mysqli_fetch_array($query)){
		echo "<tr>
				<th>".$row[0]."</th>
				<th>".$row[17]."</th>
				<th>".$row[6]." ".$row[7]." ".$row[8]."</th>
				<th>".$row[3]."</th>
				<th>".$row[4]."</th>
				<th><a href=\"javascript:void(0)\" class=\"yellow upd\" id=\"".$row[0]."\">modificar</a></th>
				<th><a href=\"../includes/catalogue-manager/drop-lab.php?consult=".$row[0]."\">eliminar</a></th>
			 </tr>";							
}

/*End of table*/

echo "</table>";

?>
	</div>
	<div class="adder">
		<button class="lgn no-p hidder" id="add">Agregar cita en laboratorio</button>
		<div class="hidden">
			<form action="../includes/catalogue-manager/add-lab.php" method="POST">
            <span>Servicio</span><select name="servicio">
<?php 

	/*Query to get service*/

	$sql = "SELECT * FROM servicios;";
	$query =  mysqli_query($conn, $sql);

	/*Add specialties to select*/

	while($row = mysqli_fetch_array($query)){
		echo "<option value=".$row[0].">".
             $row['nombre'].
			 "</option>";
	}

?>
				</select><br>
				<span>Fecha</span><input type="date" name="fecha"><br>
                <span>Hora</span><input type="time" name="hora"><br>
                <span>Paciente</span><select name="paciente">
<?php 

	/*Query to get patient*/

	$sql = "SELECT id, nombre, apellidoP, apellidoM FROM users;";
	$query =  mysqli_query($conn, $sql);

	/*Add specialties to select*/

	while($row = mysqli_fetch_array($query)){
		echo "<option value=".$row[0].">".
             $row['nombre']." ".$row['nombres']." ".$row['apellidoP']." ".$row['apellidoM'].
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
			<form action="../includes/catalogue-manager/update-lab.php" method="POST">
            	<input type="hidden" name="id" value="none" id="key">
				<span>Servicio</span><select name="servicio">
<?php 

	/*Query to get service*/

	$sql = "SELECT * FROM servicios;";
	$query =  mysqli_query($conn, $sql);

	/*Add specialties to select*/

	while($row = mysqli_fetch_array($query)){
		echo "<option value=".$row[0].">".
             $row['nombre'].
			 "</option>";
	}

?>
				</select><br>
				<span>Fecha</span><input type="date" name="fecha"><br>
                <span>Hora</span><input type="time" name="hora"><br>
                <span>Paciente</span><select name="paciente">
<?php 

	/*Query to get patient*/

	$sql = "SELECT id, nombre, apellidoP, apellidoM FROM users;";
	$query =  mysqli_query($conn, $sql);

	/*Add specialties to select*/

	while($row = mysqli_fetch_array($query)){
		echo "<option value=".$row[0].">".
             $row['nombre']." ".$row['nombres']." ".$row['apellidoP']." ".$row['apellidoM'].
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