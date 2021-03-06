<?php session_start(); ?> 
<!DOCTYPE html>
<html>
<head>
	<?php
		$omitMenu = false;
		
		/*Database connection */
		include "./includes/dbh.php";	
    ?>
	<title>InovoMed</title>
	<meta charset="utf-8 ">
	<link rel="stylesheet" href="./style/style.css">
	<link rel="stylesheet" href="./style/consultas.css">
	<link rel="shortcut icon" href="icon.bmp" type="image/x-icon" />
	<?php include("modal/login.php"); ?>
</head>
<body>
	<div id="menu">
		<div id="logo">
			<img src="logo.png" alt="">
		</div>
		<a href="./index.php"><button class="lgn">Página principal</button></a>
	<?php	
       include "includes/display-buttons.php";
    ?>
	</div>
	<div id="mini-cover">
		<h2>Laboratorio</h2>
	</div>
	<div id="consult-content">
		<p>Agende una cita en el laboratorio para ser atendido por los mejores profesionales.</p>
		<div id="cita">
		<?php
		if(isset($_SESSION['u_id']))
		{
			$uid = $_SESSION['u_id'];
			
			$sql = "SELECT * FROM citas_lab INNER JOIN users ON citas_lab.paciente = users.id WHERE users.id = '$uid'";
			$query =  mysqli_query($conn, $sql);

			if(mysqli_num_rows($query)>0){
				header("location: ./includes/users/citas-lab.php");
				exit();
			}
	?>
			<form action="lab2.php" method="GET" style="width: 500px;"><br><br>
			<img src="./img/paso1.png" alt=""><br>
			<span>Seleccione un servicio:</span><br>
			<select name="servicio">
	<?php 

		/*Query to get services*/

		$sql = "SELECT * FROM servicios;";
		$query =  mysqli_query($conn, $sql);

		/*Add specialties to select*/

		while($row = mysqli_fetch_array($query)){
			echo "<option value=".$row[0].">".
					$row[1].
				"</option>";
		}

	?>
					</select><br><br><br>
					<input type="submit" class="lgn no-p" value="Continuar">
			</form>
			</div>
			<?php
		}else{
			?>
				<div>
				<span>Inicie sesión o cree una cuenta para agendar una cita.</span><br><br>
				<div class="login">
        	<button id="btn-2">Iniciar Sesión</button>
        	<a href="signup-view.php">
        		<button class="btn-s">Registrarse</button>
        	</a>
       	</div>
				</div>
				</div>
			<?php
			}
			?>
	</div>
	<div id="footer">
		<div id="footer-content">
			<div id="footer-logo">
				<img src="Boceto.png" alt="">
				<h1><span class="inov"><span class="big">I</span>NOVO</span><span class="med"><span class="big">M</span>ED</span></h1>
			</div>
			<hr>
			<div id="footer-columns">
				<div>
				</div>
				<div>
					<span>Acerca de InovoMed</span><br><br>
					<span>Únete a nuestro equipo</span><br><br>
				</div>
				<div>
					<span>Vér todos los médicos</span><br><br>
					<span>Servicios de laboratorio</span><br><br>
					<span>Ayuda</span><br><br>
					<span>FAQs</span><br><br>
				</div>
			</div>
			<hr>
			<div id="social">
				<div></div>
				<img alt="Download on the App Store" width="130px" height="39px" src="https://d3i4yxtzktqr9n.cloudfront.net/web-eats/static/images/components/app-badge-app-store/Download_on_the_App_Store_Badge_US-UK_135x40-d0558d9106.svg" data-reactid="670">
				<img alt="Get it on Google Play" height="39px" width="130px" src="https://d3i4yxtzktqr9n.cloudfront.net/web-eats/static/images/components/app-badge-google-play/en_badge_web_generic-cf6dad406f.png" data-reactid="672">
				<div></div>
			</div>
			<hr>
		</div>
		<div id="footer-end">
				
		</div>
	</div>
	<script src="./js/modal.js"></script>
	<script>
		var btn1 = document.getElementById("btn-2");
		btn1.onclick = function() {
    	document.getElementById("modalshadow").style.display = "block";
		}
	</script>
</body>
</html>