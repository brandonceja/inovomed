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
				<button class="lgn no-p">Cambiar</button>
			</div>
			<div id="c-cover-l"></div>
		</div>
		<div id="change-images">
			<div class="img-c">
				<img src="img/img1.jpg" alt="">
				<p>Cambiar imagen 1</p>
				<center><button class="lgn no-p">Cambiar</button></center>
			</div>
			<div class="img-c">
				<img src="img/img2.jpg" alt="">
				<p>Cambiar imagen 2</p>
				<center><button class="lgn no-p">Cambiar</button></center>
			</div>
			<div class="img-c">
				<img src="img/img3.jpg" alt="">
				<p>Cambiar imagen 3</p>
				<center><button class="lgn no-p">Cambiar</button></center>
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
			<a class="manager" href="">
				<h2>Laboratorio</h2>
			</a>
			<a class="manager" href="">
				<h2>Medicamentos</h2>
			</a>
		</div>
	</div>
</body>
</html>