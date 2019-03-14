<?php

session_start();
if(isset($_SESSION['u_id']))
	{
        $uid = $_SESSION['u_id'];
        $uname = $_SESSION['u_name'];
        $uapat = $_SESSION['u_apat'];
        $uamat = $_SESSION['u_amat'];
        $unameR = $_SESSION['u_nameR'];
		$uemail = $_SESSION['u_email'];
        $ufecha = $_SESSION['u_fecha'] ;
		$ucolonia = $_SESSION['u_colonia'];
        $ucalle = $_SESSION['u_calle'] ;
		$unum = $_SESSION['u_num'] ;
						
?>
 <!DOCTYPE html>
<html>
<head>
	<?php
    	$omitMenu = false;
    ?>
	<title>InovoMed</title>
	<meta charset="utf-8 ">
	<link rel="stylesheet" href="../../style/profile.css">
    <link rel="stylesheet" href="../../style/style.css">
	<link rel="shortcut icon" href="../../icon.bmp" type="image/x-icon" />
</head>
<body>
	<div id="menu">
		<div id="logo">
			<img src="../../logo.png" alt="">
			<div id="categories">
			</div>
		</div>
        <div id="login">
     		<a href="../logout.php">
     			<button id="btn-lout">Cerrar Sesión</button>
     		</a>
     	</div>
    </div>
    <div class="content">
        <h2>Bienvenido <?php echo $uname;?></h2>
        <div class="profile-top">
            <div class="profile-image">
                <img src="../../img/profile-icon.png" alt="">
            </div>
            <div class="data">
                <p>Nombre(s): <?php echo $unameR;?></p>
                <p>Apellidos: <?php echo $uapat." ".$uamat;?></p>
                <p>Email: <?php echo $uemail;?></p>
                <p>Fecha de nacimiento: <?php echo $ufecha;?></p>
                <p>Dirección</p>
                <p>Colonia: <?php echo $ucolonia;?></p>
                <p>Calle: <?php echo $ucalle;?></p>
                <p>Número: <?php echo "#".$unum;?></p>
            </div>
        </div>
        <div class="check-consults">
            <a href="#">Citas agendadas</a>
        </div>
    </div>
</body>
</html>
<?php 
    }else{
        header("location: ../../index.php?login=error");
		exit();
    }
?>