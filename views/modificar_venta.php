<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if($varsesion == null || $varsesion = ''){
    header("Location:../index.php");
    die();
}

include("../functions/db_connection.php");
$id = $_GET["id"];
$consulta = "select a.id_venta, a.fecha, a.nombre, b.lente, b.precio_lente, b.montura, b.precio_montura, 
b.estuche, b.spray, b.precio_accs, b.total,
a.abono, a.saldo, a.fecha_entrega
from venta a
inner join detalle_venta b on a.id_venta = b.id_detalle where a.id_venta = $id";

$resultado1 = mysqli_query($con_db, $consulta);
$row = mysqli_fetch_assoc($resultado1);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/navbar.css">
        <link rel="stylesheet" href="../styles/estilo_venta.css">
        <title>Ventas</title>
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
            <h1>RECIBO</h1>
            <div class="venta">
                <form action="../functions/actualizar_venta.php" method="POST">
                    <div id="imprimir_form">
                        <div class="identificacion">
                            <p>
                                ID: <input type="text" class="id_venta" id="id_venta" name="id_venta" value="<?php echo $row["id_venta"];?>">
                                Nombre: <input type="text" class="nombre" name="nombre" value="<?php echo $row["nombre"];?>">
                            </p>
                            <p>
                                Fecha: <input type="date" name="fecha" value="<?php echo $row["fecha"];?>">
                            </p>
                        </div>
                        <p>Detalles de Venta</p>
                        <div class="detalles_venta">
                            <table class="tbl_venta">
                                <tr>
                                    <td>Lente</td>
                                    <td><input type="text" name="lente" value="<?php echo $row["lente"];?>"></td>
                                    <td>Q</td>
                                    <td><input type="text" class="monto" id="precio_lente" name="precio_lente" value="<?php echo $row["precio_lente"];?>" onclick="suma_auto()" onchange="suma_auto()"></td>
                                </tr>
                                <tr>
                                    <td>Montura</td>
                                    <td><input type="text" name="montura" value="<?php echo $row["montura"];?>"></td>
                                    <td>Q</td>
                                    <td><input type="text" class="monto" id="precio_montura" name="precio_montura" value="<?php echo $row["precio_montura"];?>" onclick="suma_auto()" onchange="suma_auto()"></td>
                                </tr>
                                <tr>
                                    <td>Estuche <input type="text" class="accs" name="estuche" value="<?php echo $row["estuche"];?>"></td>
                                    <td>Spray <input type="text" class="accs" name="spray" value="<?php echo $row["spray"];?>"></td>
                                    <td>Q</td>
                                    <td><input type="text" class="monto" id="precio_accs" name="precio_accs" value="<?php echo $row["precio_accs"];?>" onclick="suma_auto()" onchange="suma_auto()"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Total</td>
                                    <td>Q</td>
                                    <td><input type="text" class="monto" id="total" name="total" value="<?php echo $row["total"];?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Abono</td>
                                    <td>Q</td>
                                    <td><input type="text" class="monto" id="abono" name="abono" value="<?php echo $row["abono"];?>" onclick="suma_auto()" onchange="suma_auto()"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Saldo</td>
                                    <td>Q</td>
                                    <td><input type="text" class="monto" id="saldo" name="saldo" value="<?php echo $row["saldo"];?>"></td>
                                </tr>
                                <tr>
                                    <td>Entrega</td>
                                    <td><input type="date" name="entrega" value="<?php echo $row["fecha_entrega"];?>"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <input type="submit" class="btn_final">
                    <input type="button" value="Imprimir" class="btn_final">
                    <input type="button" value="Descargar" class="btn_final" id="descargar">
                </form>
            </div>
        </main>
        <script src="../js/jsventas.js"></script>
        <script src="../js/html2canvas.min.js"></script>
        <script>
            document.getElementById("descargar").onclick = function(){
                const screenshotTarget = document.getElementById('imprimir_form');
                html2canvas(screenshotTarget).then((canvas)=>{
                    const base64image = canvas.toDataURL("image/png");
                    var anchor = document.createElement('a');
                    anchor.setAttribute("href", base64image);
                    anchor.setAttribute("download", "my-image.png");
                    anchor.click();
                    anchor.remove();
                });
            }
        </script>
    </body>
</html>