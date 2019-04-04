<?php

session_start();
if(isset($_SESSION['u_id']))
	{

        include "../dbh.php";

        $id = mysqli_real_escape_string($conn, $_GET["paciente"]);

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($query)){
            $uname = $row['nombre'];
            $uapat = $row['apellidoP'];
            $uamat = $row['apellidoM'];
            $uemail = $row['email'];
            $ufecha = $row['fecha_nac'] ;
            $ucolonia = $row['colonia'];
            $ucalle = $row['calle'] ;
            $unum = $row['numero'] ;
        }
						
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
        <div class="profile-top">
            <div class="profile-image">
                <img src="../../img/profile-icon.png" alt="">
            </div>
            <div class="data">
                <p>Nombre(s): <?php echo $uname;?></p>
                <p>Apellidos: <?php echo $uapat." ".$uamat;?></p>
                <p>Email: <?php echo $uemail;?></p>
                <p>Fecha de nacimiento: <?php echo $ufecha;?></p>
                <p>Dirección</p>
                <p>Colonia: <?php echo $ucolonia;?></p>
                <p>Calle: <?php echo $ucalle;?></p>
                <p>Número: <?php echo "#".$unum;?></p>
            </div>
        </div>
       <!-- <div class="check-consults">
            <a href="./citas.php">Citas agendadas</a>
        </div> -->
    </div>
</body>
</html>
<?php 
    }else{
        header("location: ../../index.php?login=error");
		exit();
    }
?>