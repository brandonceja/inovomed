<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>inovomed</title>
	<link rel="stylesheet" href="./style/admin.css">
	<link rel="shortcut icon" href="icon.bmp" type="image/x-icon" />
</head>
<body>
	<div id="menu">
		<div id="logo">
			<img src="logo.png" alt="">
		</div>
		<div id="title">
			<h2>Página de administración</h2>
		</div>
		<a href="./index.php"><button class="lgn">Página principal</button></a>
	</div>
	<div id="content">
		<div id="change-cover">
			<div id="c-cover-r">
				<p>Cambiar imagen de portada: </p>
				<form action="./uploads/upload.php" method="post" enctype="multipart/form-data">
					<input type="file" name="fileToUpload" id="fileToUpload"><br>
					<input type="submit" value="Cambiar" name="submit" class="lgn no-p">
				</form>
			</div>
			<div id="c-cover-l"></div>
		</div>
		<div id="change-images">
			<div class="img-c">
				<img src="img/img1.jpg" alt="">
				<p>Cambiar imagen 1</p>
				<center>
				<form action="./uploads/upload1.php" method="post" enctype="multipart/form-data" style="margin-top: -0.1em;">
					<input type="file" name="fileToUpload" id="fileToUpload"><br>
					<input type="submit" value="Cambiar" name="submit" class="lgn no-p">
				</form>
				</center>
			</div>
			<div class="img-c">
				<img src="img/img2.jpg" alt="">
				<p>Cambiar imagen 2</p>
				<center>
				<form action="./uploads/upload2.php" method="post" enctype="multipart/form-data" style="margin-top: -0.1em;">
					<input type="file" name="fileToUpload" id="fileToUpload"><br>
					<input type="submit" value="Cambiar" name="submit" class="lgn no-p">
				</form>
				</center>
			</div>
			<div class="img-c">
				<img src="img/img3.jpg" alt="">
				<p>Cambiar imagen 3</p>
				<center>
				<form action="./uploads/upload3.php" method="post" enctype="multipart/form-data" style="margin-top: -0.1em;">
					<input type="file" name="fileToUpload" id="fileToUpload"><br>
					<input type="submit" value="Cambiar" name="submit" class="lgn no-p">
				</form>
				</center>
			</div>
		</div>
		<div id="management">
			<a class="manager" href="./catalogo/consultas.php">
				<h2>Consultas</h2>
			</a>
			<a class="manager" href="./catalogo/medicos.php">
					<h2>Médicos</h2>
			</a>
			<a class="manager" href="./catalogo/especialidades.php">
				<h2>Especialidades</h2>
			</a>
			<a class="manager" href="./catalogo/consultorios.php">
				<h2>Consultorios</h2>
			</a>
			<a class="manager" href="./catalogo/citas_lab.php">
				<h2>Laboratorio</h2>
			</a>
			<a class="manager" href="./catalogo/medicamentos.php">
				<h2>Medicamentos</h2>
			</a>
		</div>
	</div>
</body>
</html>