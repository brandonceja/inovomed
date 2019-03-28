<?php
include "dbh.php";

if(isset($_GET['cita'])){
    $cita = $_GET['cita'];

    $sql = "DELETE FROM citas WHERE id='$cita'";
    $query = mysqli_query($conn, $sql);

    header("Location: ./users/citas.php");
    exit();

}else{
    header("Location: ../index.php");
    exit();
}