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
    <link rel="stylesheet" href="../../style/citas-doctor.css">
    <link rel="stylesheet" href="../../style/style.css">
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
    <div class="content"><br><br><br><br>
        <h2>Bienvenido/a <?php echo $uname;?></h2>
        <?php
            $sql = "SELECT * FROM citas INNER JOIN users ON citas.paciente=users.id INNER JOIN consultorios ON 
             consultorios.id_consultorio=citas.consultorio WHERE medico='$uid' "; 
            $query = mysqli_query($conn, $sql);

            if (mysqli_num_rows($query)==0){
            
        ?>
        <h2>Por el momento no tiene citas agendadas.</h2>
        <?php
            }else{

              $form1 = '  <form class="cancel" action="javascript:void(0)" METHOD="GET">
                        <input class="citta" type="hidden" value="';
              $form2 = '" name="cita">
                            <input type="submit" value="Cancelar cita">
                        </form>';


                echo "<h2>Usted tiene: ".mysqli_num_rows($query)." citas agendadas.</h2>";
                echo "<br><br>";
                echo "<table>";
                echo "<tr>";
                echo "<th>id</th>";
                echo "<th>fecha</th>";
                echo "<th>hora</th>";
                echo "<th>lugar</th>";
                echo "<th>paciente</th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "</tr>";
                while($row = mysqli_fetch_array($query)){
                    $id_cita = $row[0];
                    echo "<tr>";
                    echo "<td>".$id_cita."</td>";
                    echo "<td>".$row['fecha']."</td>";
                    echo "<td>".$row['horario']."</td>";
                    echo "<td> Edificio: ".$row['edificio']."<br> Piso: ".$row['piso']."<br> Consultorio:".$row['id_consultorio']."</td>";
                    echo "<td>".$row['nombre']."  ".$row['apellidoP']."  ".$row['apellidoM']."</td>";	
                    echo "<td><a href=\"profile-paciente.php?paciente=".$row[6]."\">ver paciente</a></td>";
                    echo "<td>".$form1.$id_cita.$form2."</td>";	
                    echo "</tr>";
                }
                echo "</table>";
            }         
        ?>
    </div>
</body>
<script>

    var length = document.getElementsByClassName('cancel').length;

    document.getElementsByClassName('cancel')[0].addEventListener("click", function(){
        if(confirm("¿Seguro de que quiere cancelar su cita?")){   
             var cita = document.getElementsByClassName('citta')[0].value;
             window.location = "../delete-cita.php?cita="+cita+"&doc=true";
            }
        });
    

    document.getElementsByClassName('cancel')[1].addEventListener("click", function(){
        if(confirm("¿Seguro de que quiere cancelar su cita?")){   
             var cita = document.getElementsByClassName('citta')[1].value;
             window.location = "../delete-cita.php?cita="+cita+"&doc=true";
            }
        });
    

</script>
</html>
<?php 
    }else{
        header("location: ../../index.php?login=error");
		exit();
    }
?>