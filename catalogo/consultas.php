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
			<h2>Catálogo de consultas</h2>
		</div>
		<a href="../admin.php"><button class="lgn">Panel de administración</button></a>
	</div>
	<div class="catalogo">

<?php 
/*Database connection*/

include "../includes/dbh.php";


/* Queries to list medics*/

$sql = "SELECT * FROM citas INNER JOIN medicos ON medicos.cedula = citas.medico INNER JOIN users ON users.id = citas.paciente 
        INNER JOIN especialidades ON medicos.especialidad = especialidades.id_especialidad;";
$query = mysqli_query($conn, $sql);

/*Table header*/

echo "<table>
		<thead>
			<tr>
				<th>id</th>
                <th>Médico</th>
                <th>Especialidad</th>
				<th>Paciente</th>
				<th>Consultorio</th>
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
				<th>".$row[7]." ".$row[8]." ".$row[9]."</th>
				<th>".$row[28]."</th>
				<th>".$row[17]." ".$row[18]." ".$row[19]."</th>
				<th>".$row['consultorio']."</th>
				<th>".$row['fecha']."</th>
				<th>".$row['horario']."</th>
				<th><a href=\"javascript:void(0)\" class=\"yellow upd\" id=\"".$row[0]."\">modificar</a></th>
				<th><a href=\"../includes/catalogue-manager/drop-consult.php?consult=".$row[0]."\">eliminar</a></th>
			 </tr>";							
}

/*End of table*/

echo "</table>";

?>
	</div>
	<div class="adder">
		<button class="lgn no-p hidder" id="add">Agregar Consulta</button>
		<div class="hidden">
			<form action="../includes/catalogue-manager/add-consult.php" method="POST">
            <span>Especialidad-Médico</span><select name="medico">
<?php 

	/*Query to get specialties*/

	$sql = "SELECT * FROM medicos INNER JOIN especialidades ON medicos.especialidad = especialidades.id_especialidad;";
	$query =  mysqli_query($conn, $sql);

	/*Add specialties to select*/

	while($row = mysqli_fetch_array($query)){
		echo "<option value=".$row[0].">".
             $row['nombre']."-".$row['nombres']." ".$row['apellidoP']." ".$row['apellidoM'].
			 "</option>";
	}

?>
				</select><br>
				<span>Fecha</span><input type="date" name="fecha"><br>
                <span>Hora</span><input type="time" name="hora"><br><br>
                <span>*Asegurese de que la especialidad del consultorio concuerda <br> 
                    con la especialidad del médico seleccionado.</span><br><br>
                <span>Consultorio</span><select name="consultorio">
<?php 

	/*Query to get specialties*/

	$sql = "SELECT * FROM consultorios INNER JOIN especialidades ON especialidades.id_especialidad = consultorios.especialidad;";
	$query =  mysqli_query($conn, $sql);

	/*Add specialties to select*/

	while($row = mysqli_fetch_array($query)){
		echo "<option value=".$row[0].">".
                $row[0]."-".$row['nombre'].
			 "</option>";
	}

?>
				</select><br>
                <span>Paciente</span><select name="paciente">
<?php 

	/*Query to get specialties*/

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
			<form action="../includes/catalogue-manager/update-consult.php" method="POST">
            <input type="hidden" name="id" value="none" id="key">
            <span>Especialidad-Médico</span><select name="medico">
<?php 

	/*Query to get specialties*/

	$sql = "SELECT * FROM medicos INNER JOIN especialidades ON medicos.especialidad = especialidades.id_especialidad;";
	$query =  mysqli_query($conn, $sql);

	/*Add specialties to select*/

	while($row = mysqli_fetch_array($query)){
		echo "<option value=".$row[0].">".
             $row['nombre']."-".$row['nombres']." ".$row['apellidoP']." ".$row['apellidoM'].
			 "</option>";
	}

?>
				</select><br>
				<span>Fecha</span><input type="date" name="fecha"><br>
                <span>Hora</span><input type="time" name="hora"><br><br>
                <span>*Asegurese de que la especialidad del consultorio concuerda <br> 
                    con la especialidad del médico seleccionado.</span><br><br>
                <span>Consultorio</span><select name="consultorio">
<?php 

	/*Query to get specialties*/

	$sql = "SELECT * FROM consultorios INNER JOIN especialidades ON especialidades.id_especialidad = consultorios.especialidad;";
	$query =  mysqli_query($conn, $sql);

	/*Add specialties to select*/

	while($row = mysqli_fetch_array($query)){
		echo "<option value=".$row[0].">".
                $row[0]."-".$row['nombre'].
			 "</option>";
	}

?>
				</select><br>
                <span>Paciente</span><select name="paciente">
<?php 

	/*Query to get specialties*/

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