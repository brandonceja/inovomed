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
		
			<form id="signup" action="includes/signup.php" method="POST">
				<span>Nombre</span>
				<br>
				<input type="text" name="first" placeholder="Nombre">
				<br>
				<span>Apellidos</span>
				<br>
				<input type="text" name="last" placeholder="Apellidos">
				<br>
				<span>Nombre de usuario</span>
				<br>
				<input type="text" name="username" placeholder="Usuario">
				<br>
				<span>Correo electrónico</span>
				<br>
				<input type="email" name="email" placeholder="Correo electrónico">
				<br>
				<span>Contraseña</span>
				<br>
				<input type="password" name="pwd" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
				<br>
				<button name="submit" type="submit">Siguiente</button>
			</form>
		</div>
	</div>
</body>
</html>