<?php session_start(); ?> 
<!DOCTYPE html>
<html>
<head>
	<?php
    	$omitMenu = false;
    ?>
	<title>InovoMed</title>
	<meta charset="utf-8 ">
	<link rel="stylesheet" href="./style/style.css">
	<link rel="shortcut icon" href="icon.bmp" type="image/x-icon" />
	<?php include("modal/login.php"); ?>
</head>
<body>
	<div id="menu">
		<div id="logo">
			<img src="logo.png" alt="">
			<div id="categories">
			</div>
		</div>
	<?php	
       include "includes/display-buttons.php";
    ?>
		
	</div>
	<div id="cover">
		<div id="cover-content">
			<div id="first-row">
				<img src="Boceto.png" alt="">
				<h1><span class="inov"><span class="big">I</span>NOVO</span><span class="med"><span class="big">M</span>ED</span></h1>
			</div>
			<!--<button type="" id="btn-cover">Conócenos</button>-->
		</div>	
	</div>
	<div id="phrase">
		<h2>Tu hospital por excelencia</h2>
		<p>Por tu salud desde 1984.</p>
	</div>
	<div id="mini-galery">
		<img src="img/img1.jpg" alt="">
		<img src="img/img2.jpg" alt="">
		<img src="img/img3.jpg" alt="">
	</div>
	<div id="services-container">
		<h2>Nuestros Servicios</h2>
		<div id="services-wrapper">
			<div class="service">
				<div class="logo-srv">
					<img id="unique-logo" src="img/estetos.png" alt="">
				</div>
				<h3 class="title-srv">Consultas</h3>
				<div class="content-srv">Los mejores especialistas al cuidado <br> de tu bienestar.</div>
				<a href="./consultas.php"><button class="btn-srv">ver más</button></a>
			</div>
			<div class="service">
				<div class="logo-srv">
					<img src="img/lab.png" alt="">
				</div>
				<h3 class="title-srv">Laboratorio</h3>
				<div class="content-srv">Resultados 100% confiables en el <br> menor tiempo posible.</div>
				<a href="./lab1.php"><button class="btn-srv">ver más</button></a>
			</div>
			<div class="service">
				<div class="logo-srv">
					<img id="unique-logo2" src="img/pill.png" alt="">
				</div>
				<h3 class="title-srv">Farmacia</h3>
				<div class="content-srv">Medicamentos de calidad al mejor <br> precio.</div>
				<a href="./drugstore.php"><button class="btn-srv">ver más</button></a>
			</div>
		</div>
	</div>
	<div id="multimedia">
		<iframe width="1177" height="662" src="https://www.youtube.com/embed/tpBI7RhVHNI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
	<div id="contact">
		<div>
			<div id="contact-chart">
				<div id="logo-c">
					<img src="Boceto.png" alt="">
					<h1><span class="inov"><span class="big">I</span>NOVO</span><span class="med"><span class="big">M</span>ED</span></h1>
				</div>
				<div id="contact-text">
					<h2>Contáctanos</h2>
					<p>45 Rockefeller Plaza,<br>New York, NY 10111, USA.</p>
					<strong><p>+1 (234) 567 89 00</p></strong><br>
					<strong><p>contacto@inovomed.com</p></strong>
				</div>
				<div id="social-c">
					<img src="img/fb.png" alt="" height="40" width="40">
					<img src="img/twitter.png" alt="" height="40" width="40">
					<img src="img/instagram.png" alt="" height="42" width="42">
				</div><br>
				<br>
				<br>
				<br>
				<br>
				<!--<button>Contactar</button>-->
			</div>
		</div>
		<div id="map-responsive">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9594.153618416714!2d-73.95965174084803!3d40.76270691837295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c3f9c03df7%3A0x57abf16d1f849e95!2sHospital+for+Special+Surgery%2C+Main+Campus!5e0!3m2!1sen!2smx!4v1550728807701" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
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