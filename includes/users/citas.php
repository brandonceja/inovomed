<?php

session_start();
if(isset($_SESSION['u_id']))
	{
        include "../dbh.php";	

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
    <div class="content"><br><br><br><br>
        <h2>Bienvenido <?php echo $uname;?></h2>
        <?php
            $sql = "SELECT * FROM citas INNER JOIN medicos ON citas.medico=medicos.cedula INNER JOIN consultorios ON 
             consultorios.id_consultorio=citas.consultorio WHERE paciente='$uid' "; 
            $query = mysqli_query($conn, $sql);

            if (mysqli_num_rows($query)==0){
            
        ?>
        <h2>Por el momento no tiene citas agendadas.</h2><br><br><br>
        <div class="check-consults">
            <a href="../../consultas.php">Agendar cita</a>
        </div>
        <?php
            }else{
                echo "<br><br>";
                while($row = mysqli_fetch_array($query)){
                    echo "<h2>Su cita es en ".$row['fecha']." a las ".$row['horario']."</h2>";	
                    echo "<h2> en el consultorio ".$row['id_consultorio'].", edificio ". $row['edificio'].", piso ".$row['piso']."</h2>";	
                    echo "<h2>"."con Dr. ".$row['nombres']."  ".$row['apellidoP']."  ".$row['apellidoM']."</h2>";			
                }
            }
        ?>
    </div>
</body>
</html>
<?php 
    }else{
        header("location: ../../index.php?login=error");
		exit();
    }
?>