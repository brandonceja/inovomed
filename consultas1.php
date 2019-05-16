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
	<?php	
       include "includes/display-buttons.php";
    ?>
	</div>
	<div id="mini-cover">
		<h2>Consultas</h2>
	</div>
	<div id="consult-content">
		<p>Agende una cita para ser atendido por los mejores profesionales.</p>
		<div id="cita">
		<?php
		if(isset($_SESSION['u_id']))
		{

            $especialidad = $_GET["especialidad"];

	?>
			<form action="consultas2.php" method="GET"><br><br>
					<img src="./img/paso2.png" alt=""><br>
					<span>Seleccione al médico que desea que lo atienda:</span><br>
					<span>En caso de no conocer a ningún médico se le asignará uno automáticamente según el horario que elija.</span><br><br>
					<select name="cedula">
						<option value="0">&nbsp ----</option>
	<?php 

		/*Query to get specialties*/

		$sql = "SELECT cedula, nombres, apellidoP, apellidoM FROM medicos WHERE especialidad='$especialidad';";
		$query =  mysqli_query($conn, $sql);

		/*Add specialties to select*/

		while($row = mysqli_fetch_array($query)){
			echo "<option value=".$row[0].">".
					$row[1]." ".$row[2]." ".$row[3].
				"</option>";
		}

	?>
                    </select><br><br><br>
                    <input type="hidden" name="especialidad" value="<?php echo $especialidad;?>">
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
</body>
</html>