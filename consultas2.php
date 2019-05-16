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
		<h2>Consultas</h2>
	</div>
	<div id="consult-content">
		<p>Agende una cita para ser atendido por los mejores profesionales.</p>
		<div id="cita">
		<?php
		if(isset($_SESSION['u_id']))
		{
            $cedula = $_GET["cedula"];
            $especialidad = $_GET["especialidad"];
	?>
            <form action="./includes/add-consult.php" method="GET"><br><br>
                    <input type="hidden" name="cedula" value="<?php echo $cedula;?>">
                    <input type="hidden" name="especialidad" value="<?php echo $especialidad;?>">
					<img src="./img/paso3.png" alt=""><br>
                    <span>Seleccione la fecha y hora para su cita:</span><br><br>
                    <span>Elija una fecha: </span><br><br>
                    <input type="date" id="date" name="fecha"><br><br>
					<span>A continuación se listan los horarios que el médico seleccionado tiene disponibles.</span><br><br>
					<select name="horario">
    <?php 
    
        /*Query to get consult room*/
        $sql = "SELECT id_consultorio FROM consultorios WHERE especialidad='$especialidad'";
        $query =  mysqli_query($conn, $sql);
        $consultorio = mysqli_fetch_array($query)[0];

		/*Query to get t1*/

		$sql = "SELECT id_consultorio,horario_apertura FROM consultorios WHERE especialidad='$especialidad'";
		$query =  mysqli_query($conn, $sql);

		/*Add specialties to select*/

        $t1 = mysqli_fetch_array($query)[1];
        $t1 = substr($t1, 0, 2);
       
        /*Query to get t2*/

		$sql = "SELECT id_consultorio,horario_cierre FROM consultorios WHERE especialidad='$especialidad'";
		$query =  mysqli_query($conn, $sql);

        /*Set schedules*/
        
        $t2 = mysqli_fetch_array($query)[1];
        $t2 = substr($t2, 0, 2);
       
        $t1 += 0;

		while($t1 <= $t2){
            echo "<option value=".$t1.">".$t1.":00:00</option>";
            $t1++;
		}

	?>
                    </select><br><br><br>
                    <input type="hidden" name="consultorio" value="<?php echo $consultorio;?>">
					<input type="submit" class="lgn no-p" value="Agendar Cita" name="submit">
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
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("date").setAttribute('min', today);
        var month = (Date)(new Date().getMonth() + 1);

        document.getElementById("date").addEventListener("change", function(){
            var date = new Date(this.value);
            
            if(date.getDay() == 5 || date.getDay() == 6){
                alert("Lo sentimos InovoMed no trabaja en fines de semana.");
                this.value = today;
            }
            
        });
    </script>
    <script src="./js/modal.js"></script>
</body>
</html>