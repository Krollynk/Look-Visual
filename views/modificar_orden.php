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
$consulta = "select a.id_orden, a.fecha, a.nombre, a.armazon, c.OD_ESF, c.OD_CIL, c.OD_EJE, c.OD_ADD, c.OD_PRISMA,
c.OI_ESF, c.OI_CIL, c.OI_EJE, c.OI_ADD, c.OI_PRISMA, 
d.dip, d.altura, d.puente, d.horizontal, d.vertical, d.diagonal, d.material
from orden a
inner join rx_orden c on a.id_orden = c.id_rxorden
inner join detalle_orden d on a.id_orden = d.id_detalles where a.id_orden = $id";

$resultado = mysqli_query($con_db, $consulta);
$row = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/navbar.css">
        <link rel="stylesheet" href="../styles/estilo_lab.css">
        <title>Pedidos</title>
    </head>

    <body>
        <header>
            <div class="navbar">
                <a href="lobby_consultas.php" class="logo">Look Visual</a>

                <ul id="navegacion">
                    <li><a href="consulta_ficha.php">Ficha Clinica</a></li>  
                    <li><a href="#">Laboratorios</a></li>
                    <li><a href="consulta_venta.php">Ventas</a></li>
                </ul>
            </div>
        </header>

        <main>
            <h1>Pedidos a laboratorios</h1>
            <div class="pedidos">
                <form action="../functions/actualizar_orden.php" method="POST">
                    <div id="print_form">
                        <div class="identificacion">
                            <p>
                                ID <input type="text" class="id_pedidos" id="pedidos_id" name="pedidos_id" value="<?php echo $row["id_orden"];?>">
                                Nombre <input type="text" class="nombre_pedido" name="nombre" value="<?php echo $row["nombre"];?>">
                            </p>
                            <p>
                                Fecha <input type="date" name="fecha_orden" value="<?php echo $row["fecha"];?>">
                            </p>
                        </div>
                        <div class="detalles_pedido">
                            <p>
                                Laboratorio: 
                                <select name="lab" id="laboratorio_select" class="laboratorios" onchange="asignar_lab()">
                                    <option value=""></option>
                                    <option value="1">RyR</option>
                                    <option value="2">Santa Lucia</option>
                                    <option value="3">Arcoiris</option>
                                    <option value="4">Oporto Vision</option>
                                </select>
                                <a id="numero_tel" href="https://api.whatsapp.com/send" target="_blank">
                                    <button class="whats_icono" type="button">
                                        <label for="">Enviado Por</label><img src="../assets/whatsicono.png" alt="whatsapp">
                                    </button>
                                </a>
                            </p>
                            <p>
                                Armazon <input type="text" class="armazon" name="armazon" value="<?php echo $row["armazon"];?>">
                            </p>
                            <p>
                                Detalles del pedido
                            </p>
                            <p class="pedido_detalle1">
                                <table class="rx_pedido">
                                    <tr>
                                        <td></td>
                                        <td>ESF</td>
                                        <td>CIL</td>
                                        <td>EJE</td>
                                        <td>ADD</td>
                                        <td>PRISMA</td>
                                    </tr>
                                    <tr>
                                        <td>OD</td>
                                        <td><input type="text" class="dato_rx" name="pedido_od1" value="<?php echo $row["OD_ESF"];?>"></td>
                                        <td><input type="text" class="dato_rx" name="pedido_od2" value="<?php echo $row["OD_CIL"];?>"></td>
                                        <td><input type="text" class="dato_rx" name="pedido_od3" value="<?php echo $row["OD_EJE"];?>"></td>
                                        <td><input type="text" class="dato_rx" name="pedido_od4" value="<?php echo $row["OD_ADD"];?>"></td>
                                        <td><input type="text" class="dato_rx" name="pedido_od5" value="<?php echo $row["OD_PRISMA"];?>"></td>
                                    </tr>
                                    <tr>
                                        <td>OI</td>
                                        <td><input type="text" class="dato_rx" name="pedido_oi1" value="<?php echo $row["OI_ESF"];?>"></td>
                                        <td><input type="text" class="dato_rx" name="pedido_oi2" value="<?php echo $row["OI_CIL"];?>"></td>
                                        <td><input type="text" class="dato_rx" name="pedido_oi3" value="<?php echo $row["OI_EJE"];?>"></td>
                                        <td><input type="text" class="dato_rx" name="pedido_oi4" value="<?php echo $row["OI_ADD"];?>"></td>
                                        <td><input type="text" class="dato_rx" name="pedido_oi5" value="<?php echo $row["OI_PRISMA"];?>"></td>
                                    </tr>
                                </table>

                                <table class="tbl_medidas">
                                    <tr>
                                        <td>DIP</td>
                                        <td>ALTURA</td>
                                        <td>PUENTE</td>
                                        <td>HORIZONTAL</td>
                                        <td>VERTICAL</td>
                                        <td>DIAGONAL</td>
                                        <td>Material</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="datos_medidas" name="dip" value="<?php echo $row["dip"];?>"></td>
                                        <td><input type="text" class="datos_medidas" name="altura" value="<?php echo $row["altura"];?>"></td>
                                        <td><input type="text" class="datos_medidas" name="puente" value="<?php echo $row["puente"];?>"></td>
                                        <td><input type="text" class="datos_medidas" name="horizontal" value="<?php echo $row["horizontal"];?>"></td>
                                        <td><input type="text" class="datos_medidas" name="vertical" value="<?php echo $row["vertical"];?>"></td>
                                        <td><input type="text" class="datos_medidas" name="diagonal" value="<?php echo $row["diagonal"];?>"></td>
                                        <td><input type="text" class="datos_material" name="material" value="<?php echo $row["material"];?>"></td>
                                    </tr>
                                </table>
                            </p>
                        </div>
                    </div>
                    <input type="submit" class="btn_finales" value="Actualizar">
                    <input type="button" id="descargar" value="Descargar" class="btn_finales">
                </form>
            </div>
        </main>

        <script src="../js/insertid_orden.js"></script>
        <script src="../js/html2canvas.min.js"></script>
        <script>
            document.getElementById("descargar").onclick = function(){
                const screenshotTarget = document.getElementById('print_form');
                html2canvas(screenshotTarget).then((canvas)=>{
                    const base64image = canvas.toDataURL("image/png");
                    var anchor = document.createElement('a');
                    anchor.setAttribute("href", base64image);
                    anchor.setAttribute("download", "pedido-lab.png");
                    anchor.click();
                    anchor.remove();
                });
            }
        </script>
    </body>
</html>