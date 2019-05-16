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
    <link rel="stylesheet" href="../../style/citas-doctor.css">
	<link rel="shortcut icon" href="../../icon.bmp" type="image/x-icon" />
</head>
<body>
	<div id="menu">
		<div id="logo">
			<img src="../../logo.png" alt="">
			<div id="categories">
            <a href="./profile-doctor.php"><button class="lgn">Perfil</button></a>
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
        <?php
            $sql = "SELECT * FROM citas_archivadas INNER JOIN users ON citas_archivadas.paciente=users.id INNER JOIN consultorios ON 
             consultorios.id_consultorio=citas_archivadas.consultorio INNER JOIN medicos ON citas_archivadas.medico = medicos.cedula 
             WHERE users.id='$id' "; 
            $query = mysqli_query($conn, $sql);

            if (mysqli_num_rows($query)==0){
            
        ?>
        <h2>Este paciente no ha acudido a ninguna cita.</h2>
        <?php
            }else{

              $form1 = '  <form class="cancel" action="javascript:void(0)" METHOD="GET">
                        <input class="citta" type="hidden" value="';
              $form2 = '" name="cita">
                            <input type="submit" value="Cancelar cita">
                        </form>';


                echo "<h2>Este paciente ha tenido: ".mysqli_num_rows($query)." citas.</h2>";
                echo "<br><br>";
                echo "<table >";
                echo "<tr>";
                echo "<th>id</th>";
                echo "<th>fecha</th>";
                echo "<th>hora</th>";
                echo "<th>lugar</th>";
                echo "<th>médico</th>";
                echo "</tr>";
                while($row = mysqli_fetch_array($query)){
                    $id_cita = $row[0];
                    echo "<tr>";
                    echo "<td>".$id_cita."</td>";
                    echo "<td>".$row['fecha']."</td>";
                    echo "<td>".$row['horario']."</td>";
                    echo "<td> Edificio: ".$row['edificio']."<br> Piso: ".$row['piso']."<br> Consultorio:".$row['id_consultorio']."</td>";
                    echo '<td>'.$row[24]." ".$row[25]." ".$row[26].'</td>';
                    echo "</tr>";
                }
                echo "</table>";
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