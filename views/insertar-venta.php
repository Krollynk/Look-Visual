<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if($varsesion == null || $varsesion = ''){
    header("Location:../index.php");
    die();
}

include("../functions/db_connection.php");
$idnuevo = "select id_venta from venta order by id_venta desc limit 1;";

$resultado1 = mysqli_query($con_db, $idnuevo);
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
                <a href="lobby.php" class="logo">Look Visual</a>

                <ul id="navegacion">
                    <li><a href="ficha.php">Ficha Clinica</a></li>  
                    <li><a href="laboratorios.php">Laboratorios</a></li>
                    <li><a href="#">Ventas</a></li>
                </ul>
            </div>
        </header>

        <main>
            <h1>RECIBO</h1>
            <div class="venta">
                <form action="../functions/insertar_venta.php" method="POST">
                    <div id="imprimir_form">
                        <div class="identificacion">
                            <p>
                                <input type="hidden" id="id_oculto2" value="<?php echo $row["id_venta"]+1;?>">
                                ID: <input type="text" class="id_venta" id="id_venta" name="id_venta" value="">
                                <label class="asignar_id" onclick="asignar_3()">Asignar</label>
                                Nombre: <input type="text" class="nombre" name="nombre">
                            </p>
                            <p>
                                Fecha: <input type="date" name="fecha">
                            </p>
                        </div>
                        <p>Detalles de venta</p>
                        <div class="detalles_venta">
                            <input type="hidden" name="estuche" value="no">
                            <input type="hidden" name="spray" value="no">
                            <table class="tbl_venta">
                                <tr>
                                    <td>Lente</td>
                                    <td><input type="text" name="lente"></td>
                                    <td>Q</td>
                                    <td><input type="text" class="monto" id="precio_lente" name="precio_lente" onclick="suma_auto()" onchange="suma_auto()"></td>
                                </tr>
                                <tr>
                                    <td>Montura</td>
                                    <td><input type="text" name="montura"></td>
                                    <td>Q</td>
                                    <td><input type="text" class="monto" id="precio_montura" name="precio_montura" onclick="suma_auto()" onchange="suma_auto()"></td>
                                </tr>
                                <tr>
                                    <td>Estuche <input type="checkbox" name="estuche" value="si"></td>
                                    <td>Spray <input type="checkbox" name="spray" value="si"></td>
                                    <td>Q</td>
                                    <td><input type="text" class="monto" id="precio_accs" name="precio_accs" onclick="suma_auto()" onchange="suma_auto()"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Total</td>
                                    <td>Q</td>
                                    <td><input type="text" class="monto" id="total" name="total"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Abono</td>
                                    <td>Q</td>
                                    <td><input type="text" class="monto" id="abono" name="abono" onclick="suma_auto()" onchange="suma_auto()"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Saldo</td>
                                    <td>Q</td>
                                    <td><input type="text" class="monto" id="saldo" name="saldo"></td>
                                </tr>
                                <tr>
                                    <td>Entrega</td>
                                    <td><input type="date" name="entrega"></td>
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