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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="./style/meds.css">
	<?php include("modal/login.php"); ?>
</head>
<body>
	<div id="menu">
		<div id="logo">
			<img src="logo.png" alt="">
			<div id="categories">
            <a href="./index.php"><button class="lgn">Página principal</button></a>
			</div>
		</div>
	<?php	
       include "includes/display-buttons.php";
    ?>
	</div>
    <div id="container">
        <div id="search">
            <p>Consulta la existencia de un médicamento en nuestra farmacia.</p>
            <i class="material-icons">search</i>
            <input onkeyup="actualizar()" id="search_res" type="text">
        </div>
        <div class="med-table">
            <table class="blueTable" id="myTable">
                <thead>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Laboratorio</th>
                    <th>Precio unitario</th>
                    <th>Cantidad</th>
                </thead>
                <tbody id="mostrar_inves">
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            actualizar();
        });

        function actualizar(){
            var busq= 0;
            
            busq=$('#search_res').val();
            $.ajax({
                url:"./includes/ajax-list-drugs.php?mi_id="+busq,
                method: "POST",
                dataType:"text",
                success: function (data) {
                    const contenido=document.getElementById('mostrar_inves');
			        contenido.innerHTML=data;
                }
            });
        }
    </script>
</body>
</html>