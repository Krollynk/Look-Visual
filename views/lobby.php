<?php 
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if($varsesion == null || $varsesion = ''){
    header("Location:../index.php");
    die();
}
?>

<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/navbar.css">
        <link rel="stylesheet" href="../styles/estilolobby.css">
        <title>Lobby</title>
    </head>
    <body>

        <?php include "header.php";?>

        
        <?php
        if(isset($_GET["ruta"])){
            if($_GET["ruta"] == "menu"||
               $_GET["ruta"] == "insertar-ficha"||
               $_GET["ruta"] == "insertar-laboratorios"||
               $_GET["ruta"] == "insertar-venta"||
               $_GET["ruta"] == "insertar-ficha"){
                include $_GET["ruta"].".php";
            }
        }
        ?>
    </body>
</html>