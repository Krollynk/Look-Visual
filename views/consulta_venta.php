<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if($varsesion == null || $varsesion = ''){
    header("Location:../index.php");
    die();
}

include("../functions/db_connection.php");
$consulta = "select id_venta, fecha, nombre, saldo, fecha_entrega from venta order by id_venta desc";
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/navbar.css">
        <link rel="stylesheet" href="../styles/estilo_ficha_edicion.css">
        <title>Ficha Edicion</title>
    </head>
    <body>
        <header>
            <div class="navbar">
                <a href="lobby_consultas.php" class="logo">Look Visual</a>

                <ul id="navegacion">
                    <li><a href="consulta_ficha.php">Ficha Clinica</a></li>  
                    <li><a href="consulta_orden.php">Laboratorios</a></li>
                    <li><a href="#">Ventas</a></li>
                </ul>
            </div>
        </header>

        <main>
            
            <div class="tabla_fichas">
                <h1>LISTA DE VENTAS</h1>
                <table>
                    <tr class="cabecera">
                        <td>ID</td>
                        <td>Fecha</td>
                        <td>Nombre</td>
                        <td>Saldo</td>
                        <td>Fecha de Entrega</td>
                        <td>Acción</td>
                    </tr>
                    <?php $resultado = mysqli_query($con_db, $consulta);
                    while($row = mysqli_fetch_assoc($resultado)){?>
                    <tr>
                        <td><?php echo $row["id_venta"];?></td>
                        <td><?php echo $row["fecha"];?></td>
                        <td><?php echo $row["nombre"];?></td>
                        <td>Q <?php echo $row["saldo"];?></td>
                        <td><?php echo $row["fecha_entrega"];?></td>
                        <td>
                            <a href="./modificar_venta.php?id=<?php echo $row["id_venta"];?>" class="enlace_edicion">Editar</a>
                            
                        </td>
                    </tr>
                    <?php }
                    mysqli_free_result($resultado);
                    ?>
                </table>
            </div>
        </main>
    </body>
</html>