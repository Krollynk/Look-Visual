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
$consulta = "select a.id_ficha, a.fecha, a.nombre, a.apellidos, a.direccion, a.edad, a.telefono, a.correo,
b.OD_AVSC, b.OD_AVCC, b.OD_PH, b.OD_RTC, b.OD_FO, b.OI_AVSC, b.OI_AVCC, b.OI_PH, b.OI_RTC, b.OI_FO,
c.OD_ESF as amb_od1, c.OD_CIL as amb_od2, c.OD_EJE as amb_od3, c.OD_ADD as amb_od4, c.OD_PRISMA as amb_od5, c.OI_ESF as amb_oi1, c.OI_CIL as amb_oi2, c.OI_EJE as amb_oi3, c.OI_ADD as amb_oi4, c.OI_PRISMA as amb_oi5,
d.OD_ESF as fn_od1, d.OD_CIL as fn_od2, d.OD_EJE as fn_od3, d.OD_ADD as fn_od4, d.OD_PRISMA as fn_od5, d.OI_ESF as fn_oi1, d.OI_CIL as fn_oi2, d.OI_EJE as fn_oi3, d.OI_ADD as fn_oi4, d.OI_PRISMA as fn_oi5,
e.material, e.dip, e.tipo_lente,
f.OD_ESF as at_od1, f.OD_CIL as at_od2, f.OD_EJE as at_od3, f.OD_ADD as at_od4, f.OD_PRISMA as at_od5, f.OI_ESF as at_oi1, f.OI_CIL as at_oi2, f.OI_EJE as at_oi3, f.OI_ADD as at_oi4, f.OI_PRISMA as at_oi5
from ficha_clinica a
inner join ficha_agudeza b on a.id_ficha = b.id_agudeza
inner join rx_ambulatoria c on a.id_ficha = c.id_rxambulatoria
inner join rx_final d on a.id_ficha = d.id_rxfinal
inner join detalles_final e on d.id_rxfinal = e.id_dtfinal
inner join rx_anterior f on a.id_ficha = f.id_rxanterior where a.id_ficha = $id";

$resultado = mysqli_query($con_db, $consulta);
$row = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/navbar.css">
        <link rel="stylesheet" href="../styles/estilo_ficha.css">
        <title>Ficha Clínica</title>
    </head>
    <body>
        <header>
            <div class="navbar">
                <a href="./lobby_consultas.php" class="logo">Look Visual</a>

                <ul id="navegacion">
                    <li><a href="#">Ficha Clinica</a></li>  
                    <li><a href="consulta_orden.php">Laboratorios</a></li>
                    <li><a href="consulta_venta.php">Ventas</a></li>
                </ul>
            </div>
        </header>

        <main>
            <h1>DATOS DEL PACIENTE</h1>
            <!-- inicio del formulario -->
            <form action="../functions/actualizar_ficha.php" method="post">
                <div class="f_clinica">
                    <div class="identificacion">
                        <p>
                            <label>ID</label>
                            <!-- dato -->
                            <input type="text" class="ficha_id" name="ficha_id" value="<?php echo $row["id_ficha"];?>">
                        </p>
                        <p>
                            <label>Fecha</label>
                            <!-- dato -->
                            <input type="date" name="fecha_ficha" value="<?php echo $row["fecha"];?>">
                        </p>
                    </div>
                    <div class="datos_paciente">
                        <p>
                            <!-- datos -->
                            Nombres <input type="text" class="datoP" name="nombre" value="<?php echo $row["nombre"];?>">
                            <br>
                            Apellidos <input type="text" class="datoP" name="apellido" value="<?php echo $row["apellidos"];?>">
                            <br>
                            Direccion <input type="text" class="datoP" name="direccion" value="<?php echo $row["direccion"];?>">
                            <br>
                            Edad <input type="text" class="edad" name="edad" value="<?php echo $row["edad"];?>">
                            Telefono <input type="text" class="telefono" name="telefono" value="<?php echo $row["telefono"];?>">
                            Correo <input type="text" class="correo" name="correo" value="<?php echo $row["correo"];?>">
                        </p>
                    </div>
                    <div class="sintomas">
                        <!-- datos hidden -->
                        <input type="hidden" name="sintoma1" value="no">
                        <input type="hidden" name="sintoma2" value="no">
                        <input type="hidden" name="sintoma3" value="no">
                        <input type="hidden" name="sintoma4" value="no">
                        <input type="hidden" name="sintoma5" value="no">
                        <input type="hidden" name="sintoma6" value="no">
                        <input type="hidden" name="sintoma7" value="no">
                        <input type="hidden" name="sintoma8" value="no">
                        <input type="hidden" name="sintoma9" value="no">
                        <input type="hidden" name="sintoma10" value="no">
                        <input type="hidden" name="sintoma11" value="no">
                        <input type="hidden" name="sintoma12" value="no">
                        <input type="hidden" name="sintoma13" value="no">
                        <input type="hidden" name="sintoma14" value="no">
                        <input type="hidden" name="sintoma15" value="no">
                        <!-- datos seleccion -->
                        <table class="tb_sintomas">
                            <tr>
                                <td>Cefaleas<input type="checkbox" name="sintoma1" value="si"></td>
                                <td>Dolor de ojos<input type="checkbox" name="sintoma2" value="si"></td>
                                <td>Ardor de ojos<input type="checkbox" name="sintoma3" value="si"></td>
                                <td>Lagrimeo<input type="checkbox" name="sintoma4" value="si"></td>
                                <td>Presion alta<input type="checkbox" name="sintoma5" value="si"></td>
                            </tr>
                            <tr>
                                <td>Presion baja<input type="checkbox" name="sintoma6" value="si"></td>
                                <td>Flasheos<input type="checkbox" name="sintoma7" value="si"></td>
                                <td>Miodesopsias<input type="checkbox" name="sintoma8" value="si"></td>
                                <td>Embarazo<input type="checkbox" name="sintoma9" value="si"></td>
                                <td>Vision Borrosa<input type="checkbox" name="sintoma10" value="si"></td>
                            </tr>
                            <tr>
                                <td>Vision Nublada<input type="checkbox" name="sintoma11" value="si"></td>
                                <td>Cuerpo extraño<input type="checkbox" name="sintoma12" value="si"></td>
                                <td>Migraña<input type="checkbox" name="sintoma13" value="si"></td>
                                <td>Fotofobia<input type="checkbox" name="sintoma14" value="si"></td>
                                <td>Diabetes<input type="checkbox" name="sintoma15" value="si"></td>
                            </tr>
                        </table>
                        <p>
                            <!-- dato -->
                            Otros Sintomas <input type="text" class="OTSI" name="otros_sintomas">
                        </p>
                        <p>
                            <!-- dato -->
                            Usa Lentes <input type="checkbox" name="usa_lentes">
                        </p>
                    </div>
                    <div class="agudeza">
                        <p>Agudeza Visual</p>
                        <table class="tb_agudeza">
                            <tr>
                                <td> </td>
                                <td>AVSC</td>
                                <td>AVCC</td>
                                <td>PH</td>
                                <td>RTC</td>
                                <td>FO</td>
                            </tr>
                            <!-- datos -->
                            <tr>
                                <td>OD</td>
                                <td><input type="text" class="dato_rx" name="agudeza_od1" value="<?php echo $row["OD_AVSC"];?>"></td>
                                <td><input type="text" class="dato_rx" name="agudeza_od2" value="<?php echo $row["OD_AVCC"];?>"></td>
                                <td><input type="text" class="dato_rx" name="agudeza_od3" value="<?php echo $row["OD_PH"];?>"></td>
                                <td><input type="text" class="dato_rx" name="agudeza_od4" value="<?php echo $row["OD_RTC"];?>"></td>
                                <td><input type="text" class="dato_rx" name="agudeza_od5" value="<?php echo $row["OD_FO"];?>"></td>
                            </tr>
                            <tr>
                                <td>OI</td>
                                <td><input type="text" class="dato_rx" name="agudeza_oi1" value="<?php echo $row["OI_AVSC"];?>"></td>
                                <td><input type="text" class="dato_rx" name="agudeza_oi2" value="<?php echo $row["OI_AVCC"];?>"></td>
                                <td><input type="text" class="dato_rx" name="agudeza_oi3" value="<?php echo $row["OI_PH"];?>"></td>
                                <td><input type="text" class="dato_rx" name="agudeza_oi4" value="<?php echo $row["OI_RTC"];?>"></td>
                                <td><input type="text" class="dato_rx" name="agudeza_oi5" value="<?php echo $row["OI_FO"];?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="ambulatoria">
                        <p>RX Ambulatoria</p>
                        <table>
                            <tr>
                                <td></td>
                                <td>ESF</td>
                                <td>CIL</td>
                                <td>EJE</td>
                                <td>ADD</td>
                                <td>PRISMA</td>
                            </tr>
                            <!-- datos -->
                            <tr>
                                <td>OD</td>
                                <td><input type="text" class="dato_rx" name="ambuOD_esf" value="<?php echo $row["amb_od1"];?>"></td>
                                <td><input type="text" class="dato_rx" name="ambuOD_cil" value="<?php echo $row["amb_od2"];?>"></td>
                                <td><input type="text" class="dato_rx" name="ambuOD_eje" value="<?php echo $row["amb_od3"];?>"></td>
                                <td><input type="text" class="dato_rx" name="ambuOD_add" value="<?php echo $row["amb_od4"];?>"></td>
                                <td><input type="text" class="dato_rx" name="ambuOD_pris" value="<?php echo $row["amb_od5"];?>"></td>
                            </tr>
                            <tr>
                                <td>OI</td>
                                <td><input type="text" class="dato_rx" name="ambuOI_esf" value="<?php echo $row["amb_oi1"];?>"></td>
                                <td><input type="text" class="dato_rx" name="ambuOI_cil" value="<?php echo $row["amb_oi2"];?>"></td>
                                <td><input type="text" class="dato_rx" name="ambuOI_eje" value="<?php echo $row["amb_oi3"];?>"></td>
                                <td><input type="text" class="dato_rx" name="ambuOI_add" value="<?php echo $row["amb_oi4"];?>"></td>
                                <td><input type="text" class="dato_rx" name="ambuOI_pris" value="<?php echo $row["amb_oi5"];?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="final">
                        <p>RX Final</p>
                        <table>
                            <tr>
                                <td></td>
                                <td>ESF</td>
                                <td>CIL</td>
                                <td>EJE</td>
                                <td>ADD</td>
                                <td>PRISMA</td>
                            </tr>
                            <!-- datos -->
                            <tr>
                                <td>OD</td>
                                <td><input type="text" class="dato_rx" name="finalOD_esf" value="<?php echo $row["fn_od1"];?>"></td>
                                <td><input type="text" class="dato_rx" name="finalOD_cil" value="<?php echo $row["fn_od2"];?>"></td>
                                <td><input type="text" class="dato_rx" name="finalOD_eje" value="<?php echo $row["fn_od3"];?>"></td>
                                <td><input type="text" class="dato_rx" name="finalOD_add" value="<?php echo $row["fn_od4"];?>"></td>
                                <td><input type="text" class="dato_rx" name="finalOD_pris" value="<?php echo $row["fn_od5"];?>"></td>
                            </tr>
                            <tr>
                                <td>OI</td>
                                <td><input type="text" class="dato_rx" name="finalOI_esf" value="<?php echo $row["fn_oi1"];?>"></td>
                                <td><input type="text" class="dato_rx" name="finalOI_cil" value="<?php echo $row["fn_oi2"];?>"></td>
                                <td><input type="text" class="dato_rx" name="finalOI_eje" value="<?php echo $row["fn_oi3"];?>"></td>
                                <td><input type="text" class="dato_rx" name="finalOI_add" value="<?php echo $row["fn_oi4"];?>"></td>
                                <td><input type="text" class="dato_rx" name="finalOI_pris" value="<?php echo $row["fn_oi5"];?>"></td>
                            </tr>
                            <tr>
                                <td>Material</td>
                                <td><input type="text" class="dato_rx" name="final_material"  value="<?php echo $row["material"];?>"></td>
                                <td>DIP</td>
                                <td><input type="text" class="dato_rx" name="final_dip" value="<?php echo $row["dip"];?>"></td>
                                <td>Tipo de lente</td>
                                <td><input type="text" class="dato_rx" name="final_tipolent" value="<?php echo $row["tipo_lente"];?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="anterior">
                        <p>RX Anterior</p>
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
                                <td><input type="text" class="dato_rx" name="antOD_esf" value="<?php echo $row["at_od1"];?>"></td>
                                <td><input type="text" class="dato_rx" name="antOD_cil" value="<?php echo $row["at_od2"];?>"></td>
                                <td><input type="text" class="dato_rx" name="antOD_eje" value="<?php echo $row["at_od3"];?>"></td>
                                <td><input type="text" class="dato_rx" name="antOD_add" value="<?php echo $row["at_od4"];?>"></td>
                                <td><input type="text" class="dato_rx" name="antOD_pris" value="<?php echo $row["at_od5"];?>"></td>
                            </tr>
                            <tr>
                                <td>OI</td>
                                <td><input type="text" class="dato_rx" name="antOI_esf" value="<?php echo $row["at_oi1"];?>"></td>
                                <td><input type="text" class="dato_rx" name="antOI_cil" value="<?php echo $row["at_oi2"];?>"></td>
                                <td><input type="text" class="dato_rx" name="antOI_eje" value="<?php echo $row["at_oi3"];?>"></td>
                                <td><input type="text" class="dato_rx" name="antOI_add" value="<?php echo $row["at_oi4"];?>"></td>
                                <td><input type="text" class="dato_rx" name="antOI_pris" value="<?php echo $row["at_oi5"];?>"></td>
                            </tr>
                        </table>
                    </div>
                    <input type="submit" value="Actualizar" class="submit">
                </div>
            </form>
        </main>
    </body>
</html>