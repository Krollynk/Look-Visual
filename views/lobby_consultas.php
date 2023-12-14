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
        <link rel="stylesheet" href="../styles/estilo_lobbyconsulta.css">
        <title>Lobby</title>
    </head>
    <body>
        <header>
            <div class="navbar">
                <a href="lobby.php" class="logo">Look Visual</a>

                <ul id="navegacion">
                    <li><a href="consulta_ficha.php">Consulta Ficha</a></li>  
                    <li><a href="consulta_orden.php">Consulta Pedidos</a></li>
                    <li><a href="consulta_venta.php">Consulta Ventas</a></li>
                    <li><a href="../functions/cerrar_sesion.php">Cerrar Sesion</a></li>
                </ul>
            </div>
        </header>

        <main>
            <h2>Consultas de Optica Look Visual</h2>

            <div class="menu">
                <div class="ficha">
                    <p>Consulstar Fichas Clínica</p>
                    <a href="consulta_ficha.php"><img src="../assets/ficha_clinica.png" alt="ficha_clinica"></a>
                </div>
                <div class="laboratorio">
                    <p>Consultar pedidos a Laboratorios</p>
                    <a href="consulta_orden.php"><img src="../assets/laboratorios.png" alt="laboratorios"></a>
                </div>
                <div class="venta">
                    <p>Consultar Venta</p>
                    <a href="consulta_venta.php"><img src="../assets/ventas.png" alt="ventas"></a>
                </div>
                <div class="consulta">
                    <p>Ingresar Datos</p>
                    <a href="lobby.php"><img src="../assets/consultas.png" alt="insertar"></a>
                </div>
            </div>
        </main>
    </body>
</html>