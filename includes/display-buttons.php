<?php 
 if(!isset($_SESSION['u_id'])){
 ?>
        <div id="login">
        	<button id="btn-l">Iniciar Sesión</button>
        	<a href="signup-view.php">
        		<button class="btn-s">Registrarse</button>
        	</a>
       	</div>
 <?php  
 }
else{ ?>
     	<div id="login">
     		<a href="./includes/logout.php">
     			<button id="btn-lout">Cerrar Sesión</button>
     		</a>
     	</div>
<?php } ?>
  