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
			<h2>Catálogo de medicamentos</h2>
		</div>
		<a href="../admin.php"><button class="lgn">Panel de administración</button></a>
	</div>
	<div class="catalogo">

<?php 
/*Database connection*/

include "../includes/dbh.php";


/* Queries to list medics*/

$sql = "SELECT * FROM medicamentos;";
$query = mysqli_query($conn, $sql);

/*Table header*/

echo "<table>
		<thead>
			<tr>
				<th>Código</th>
				<th>Nombre</th>
				<th>Laboratorio</th>
				<th>Precio</th>
				<th>Cantidad</th>
                <th></th>
                <th></th>
				</tr>
		</thead>";

/*List medics*/

while($row = mysqli_fetch_array($query)){
		echo "<tr>
				<th>".$row[0]."</th>
				<th>".$row[1]."</th>
				<th>".$row[2]."</th>
                <th>$".$row[3]."</th>
                <th>".$row[4]."</th>
				<th><a href=\"javascript:void(0)\" class=\"yellow upd\" id=\"".$row[0]."\">modificar</a></th>
				<th><a href=\"../includes/catalogue-manager/drop-med.php?med=".$row[0]."\">eliminar</a></th>
			 </tr>";							
}

/*End of table*/

echo "</table>";

?>
	</div>
	<div class="adder">
		<button class="lgn no-p hidder" id="add">Agregar Medicamento</button>
		<div class="hidden">
			<form action="../includes/catalogue-manager/add-med.php" method="POST">
                <span>Nombre</span><input type="text" name="nombre"><br>
				<span>Laboratorio</span><input type="text" name="lab"><br>
				<span>Precio</span><input type="number" name="precio"><br>
				<span>Cantidad</span><input type="number" name="cantidad"><br>
				<input type="submit" class="lgn no-p">
			</form>
		</div>
		<!-- Updater -->
		<div class="updater">
			<br><br>
			<h2>Modifique los datos necesarios, los demás déjelos vacios.</h2>
            <form action="../includes/catalogue-manager/update-med.php" method="POST">
            <input id="key" type="hidden" value="none" name="key">
            <span>Nombre</span><input type="text" name="nombre"><br>
				<span>Laboratorio</span><input type="text" name="lab"><br>
				<span>Precio</span><input type="text" name="precio"><br>
				<span>Cantidad</span><input type="number" name="cantidad"><br>
				<input type="submit" class="lgn no-p">
			</form>
		</div>
	</div>
<script src="../js/hide-element.js"></script>
</body>
</html>