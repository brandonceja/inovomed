<?php

/*Database connection */
include "dbh.php";

session_start();

if(isset($_SESSION['u_id']))
{
    if(isset($_GET['submit'])){

        $paciente =  $_SESSION["u_id"];
        $medico = $_GET["cedula"];
        $especialidad = $_GET["especialidad"];
        $horario = $_GET["horario"];
        $consultorio =  $_GET["consultorio"];
        $fecha = $_GET["fecha"];

        $horario = $horario.":00:00";

        $sql = "INSERT INTO citas (id, medico, paciente, consultorio, horario, fecha) ".
            "VALUES ('', '$medico', '$paciente', '$consultorio', '$horario', '$fecha')";

        $query =  mysqli_query($conn, $sql);
        header("Location: ./users/profile.php");
        exit();
    }
}else{
    header("Location: ../index.php?error=1");
    exit();
}