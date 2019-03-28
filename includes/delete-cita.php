<?php
include "dbh.php";

if(isset($_GET['cita'])){
    $cita = $_GET['cita'];

    $sql = "DELETE FROM citas WHERE id='$cita'";
    $query = mysqli_query($conn, $sql);
    
    if(isset($_GET['doc'])){
        header("Location: ./users/citas-doctor.php");
        exit();
    }

    header("Location: ./users/citas.php");
    exit();

}else{
    header("Location: ../index.php");
    exit();
}