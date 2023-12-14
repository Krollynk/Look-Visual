<?php
session_start();
$varsesion = $_SESSION['usuario'];
if($varsesion == null || $varsesion = ''){
    header("Location:../index.php");
    die();
}


include("../functions/db_connection.php");
$id = $_GET["id"];
$consulta = "select a.fecha, a.nombre, a.apellidos,
d.OD_ESF, d.OD_CIL, d.OD_EJE, d.OD_ADD, d.OD_PRISMA, d.OI_ESF, d.OI_CIL, d.OI_EJE, d.OI_ADD, d.OI_PRISMA,
e.material, e.dip, e.tipo_lente
from ficha_clinica a
inner join rx_final d on a.id_ficha = d.id_rxfinal
inner join detalles_final e on d.id_rxfinal = e.id_dtfinal where a.id_ficha = $id";

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
        <link rel="stylesheet" href="../styles/estilo_refrac.css">
        <title>Refractograma</title>
    </head>
    <body>
        <header>
            <div class="navbar">
                <a href="lobby_consultas.php" class="logo">Look Visual</a>

                <ul id="navegacion">
                    <li><a href="consulta_ficha.php">Ficha Clinica</a></li>  
                    <li><a href="consulta_orden.php">Laboratorios</a></li>
                    <li><a href="consulta_venta.php">Ventas</a></li>
                </ul>
            </div>
        </header>

        <main>
            <div class="refractograma" id="refractograma">
                <div><img src="../assets/Imagen1.png" alt="logo" class="logo_img"></div>
                <h1>REFRACTOGRAMA</h1>
                <div class="identificacion">
                    <p>
                        <label>Nombre</label>
                        <label id="lbl_ident"><?php echo $row["nombre"];?> <?php echo $row["apellidos"];?></label>
                    </p>
                    <p>
                        <label>Fecha</label>
                        <label id="lbl_ident"><?php echo $row["fecha"];?></label>
                    </p>
                </div>
                <div class="tabla_contenido">
                    <table>
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
                            <td><?php echo $row["OD_ESF"];?></td>
                            <td><?php echo $row["OD_CIL"];?></td>
                            <td><?php echo $row["OD_EJE"];?></td>
                            <td><?php echo $row["OD_ADD"];?></td>
                            <td><?php echo $row["OD_PRISMA"];?></td>
                        </tr>
                        <tr>
                            <td>OI</td>
                            <td><?php echo $row["OI_ESF"];?></td>
                            <td><?php echo $row["OI_CIL"];?></td>
                            <td><?php echo $row["OI_EJE"];?></td>
                            <td><?php echo $row["OI_ADD"];?></td>
                            <td><?php echo $row["OI_PRISMA"];?></td>
                        </tr>
                    </table>
                </div>
                <div class="otros_datos">
                    <p>
                        <label>MATERIAL</label>
                        <label id="lbl_otros"><?php echo $row["material"];?></label>
                    </p>
                    <p>
                        <label>Tipo de Lente</label>
                        <label id="lbl_otros"><?php echo $row["tipo_lente"];?></label>
                    </p>
                    <p>
                        <label>DIP</label>
                        <label id="lbl_otros"><?php echo $row["dip"];?></label>
                    </p>
                </div>
                <div class="observaciones">
                    <label>Observaciones</label>
                    <br>
                    <textarea name="" id="" cols="70" rows="5"></textarea>
                </div>
                <div><img src="../assets/Imagen2.png" alt="contacto" class="contacto"></div>
            </div>
            <button class="boton" id="descargar">Descargar</button>
        </main>

        <script src="../js/html2canvas.min.js"></script>
        <script>
            document.getElementById("descargar").onclick = function(){
                const screenshotTarget = document.getElementById('refractograma');
                html2canvas(screenshotTarget).then((canvas)=>{
                    const base64image = canvas.toDataURL("image/png");
                    var anchor = document.createElement('a');
                    anchor.setAttribute("href", base64image);
                    anchor.setAttribute("download", "refractograma-<?php echo $row["nombre"];?>-<?php echo $row["apellidos"];?>.png");
                    anchor.click();
                    anchor.remove();
                });
            }
        </script>
    </body>
</html>