<?php
include "dbh.php";
mysqli_set_charset($conn,'utf8');
$mi_id=$_GET["mi_id"];
if ($mi_id=="") {
	$meds = "SELECT * FROM medicamentos";
}else{
$meds = "SELECT * FROM medicamentos WHERE nombre LIKE '$mi_id%' OR laboratorio LIKE '$mi_id%' OR codigo LIKE '$mi_id%'";
}		
$result = mysqli_query($conn, $meds);
	while($row = mysqli_fetch_assoc($result))
            {
		  		$id = $row['codigo'];
				$nombre = $row['nombre'];
				$lab = $row['laboratorio'];
				$precio = $row['precio'];
				$cantidad = $row['cantidad'];

                echo '<tr>';
                echo '<td>'.$id.'</td>';
				echo '<td>'.$nombre.'</td>';
				echo '<td>'.$lab.'</td>';
                echo '<td>$'.$precio.'</td>';
                echo '<td>'.$cantidad.'</td>';
				echo '</tr>';
            }