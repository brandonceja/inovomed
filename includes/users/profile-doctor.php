<?php

session_start();
if(isset($_SESSION['u_id']))
	{
        include "../dbh.php";	

        $uid = $_SESSION['u_id'];
        $uname = $_SESSION['u_name'];
        $uapat = $_SESSION['u_apat'];
        $uamat = $_SESSION['u_amat'];
		$uemail = $_SESSION['u_email'];
        $ufecha = $_SESSION['u_fecha'] ;
		$ucolonia = $_SESSION['u_colonia'];
        $ucalle = $_SESSION['u_calle'] ;
        $unum = $_SESSION['u_num'] ;
        $especialidad = $_SESSION['u_especialidad'] ;

        $sql = "SELECT nombre FROM especialidades WHERE id_especialidad = '$especialidad'";
        $query = mysqli_query($conn, $sql);
        $especialidad = mysqli_fetch_assoc($query)['nombre'];
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
        <h2>Bienvenido Dr. <?php echo $uname." ".$uapat." ".$uamat;?></h2>
        <div class="profile-top">
            <div class="profile-image">
                <img src="../../img/profile-icon.png" alt="">
            </div>
            <div class="data">
                <p>Nombre(s): <?php echo $uname;?></p>
                <p>Apellidos: <?php echo $uapat." ".$uamat;?></p>
                <p>Especialidad: <?php echo $especialidad;?></p>
                <p>Email: <?php echo $uemail;?></p>
                <p>Fecha de nacimiento: <?php echo $ufecha;?></p>
                <p>Dirección</p>
                <p>Colonia: <?php echo $ucolonia;?></p>
                <p>Calle: <?php echo $ucalle;?></p>
                <p>Número: <?php echo "#".$unum;?></p>
            </div>
        </div>
        <div class="check-consults">
            <a href="./citas.php">Citas agendadas</a>
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