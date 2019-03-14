<?php session_start(); ?> 
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style/register.css">
	<title>InovoMed</title>
	<meta charset="utf-8 ">
	<link rel="shortcut icon" href="icon.bmp" type="image/x-icon" />
 </head>
<body>
	<div id="reg-content">
		<div id="left-reg">
		</div>
		<div id="right-reg">
		
				<div id="first-row">
					<img src="Boceto.png" alt="">
					<h1><span class="inov"><span class="big">I</span>NOVO</span><span class="med"><span class="big">M</span>ED</span></h1>
				</div>
		
			<form id="signup" action="includes/signup.php" method="POST"><br>
				<span>Nombre</span><br>
				<input type="text" name="first" placeholder="Nombre"><br>
				<span>Apellido Paterno</span>	<br>	
				<input type="text" name="last" placeholder="Apellido Paterno"><br>
				<span>Apellido Materno</span>	<br>	
				<input type="text" name="last2" placeholder="Apellido Materno"><br>
				<span>Nombre de usuario</span><br>
				<input type="text" name="username" placeholder="Usuario"><br>
				<span>Correo electrónico</span><br>
				<input type="email" name="email" placeholder="Correo electrónico"><br>
				<span>Contraseña</span><br>
				<input type="password" name="pwd" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;"><br>
				<span>Fecha de nacimiento</span><br>
				<input type="date" name="date"><br>
				<span>Colonia</span><br>
				<input type="text" name="colon" placeholder="Colonia"><br>
				<span>Calle</span><br>
				<input type="text" name="calle" placeholder="Calle"><br>
				<span>Número</span><br>
				<input type="number" name="number" placeholder="Número"><br>
				<br>
				<button name="submit" type="submit">Siguiente</button>
			</form>
		</div>
	</div>
</body>
</html>