<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if($varsesion == null || $varsesion = ''){
    header("Location:../index.php");
    die();
}

include("../functions/db_connection.php");
$idnuevo = "select id_orden from orden order by id_orden desc limit 1";

$resultado1 = mysqli_query($con_db, $idnuevo);
$row = mysqli_fetch_assoc($resultado1);
?>

<main class="main__formularios">
    <h1>Pedidos a Laboratorios</h1>
    <div class="pedidos">
        <form action="../functions/insertar_pedido.php" method="POST">
            <div id="imprimir_form">
                <div class="identificacion">
                    <p>
                        <input type="hidden" id="id_oculto1" value="<?php echo $row["id_orden"]+1;?>">
                        ID <input type="text" class="id_pedidos" id="pedidos_id" name="pedidos_id" value="">
                        <label class="asignar_id" onclick="asignar_2()">Asignar</label>
                        
                        Nombre <input type="text" class="nombre_pedido" name="nombre">
                    </p>
                    <p>
                        Fecha <input type="date" name="fecha_orden">
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
                                <label class="labelico">Enviado Por</label><img src="../assets/whatsicono.png" alt="whatsapp">
                            </button>
                        </a>
                    </p>
                    <p>
                        Armazon <input type="text" class="armazon" name="armazon">
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
                                <td><input type="text" class="dato_rx" name="pedido_od1"></td>
                                <td><input type="text" class="dato_rx" name="pedido_od2"></td>
                                <td><input type="text" class="dato_rx" name="pedido_od3"></td>
                                <td><input type="text" class="dato_rx" name="pedido_od4"></td>
                                <td><input type="text" class="dato_rx" name="pedido_od5"></td>
                            </tr>
                            <tr>
                                <td>OI</td>
                                <td><input type="text" class="dato_rx" name="pedido_oi1"></td>
                                <td><input type="text" class="dato_rx" name="pedido_oi2"></td>
                                <td><input type="text" class="dato_rx" name="pedido_oi3"></td>
                                <td><input type="text" class="dato_rx" name="pedido_oi4"></td>
                                <td><input type="text" class="dato_rx" name="pedido_oi5"></td>
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
                                <td><input type="text" class="datos_medidas" name="dip"></td>
                                <td><input type="text" class="datos_medidas" name="altura"></td>
                                <td><input type="text" class="datos_medidas" name="puente"></td>
                                <td><input type="text" class="datos_medidas" name="horizontal"></td>
                                <td><input type="text" class="datos_medidas" name="vertical"></td>
                                <td><input type="text" class="datos_medidas" name="diagonal"></td>
                                <td><input type="text" class="datos_material" name="material"></td>
                            </tr>
                        </table>
                    </p>
                </div>
            </div>
            <input type="submit" class="btn_finales" value="Guardar">
            <input type="button" value="Imprimir" class="btn_finales">
            <input type="button" id="descarg" value="Descargar" class="btn_finales">
        </form>
    </div>
</main>

<script src="../js/insertid_orden.js"></script>
<script src="../js/html2canvas.min.js"></script>
<script>
    document.getElementById("descarg").onclick = function(){
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