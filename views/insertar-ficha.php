<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if($varsesion == null || $varsesion = ''){
    header("Location:../index.php");
    die();
}

include("../functions/db_connection.php");
$idnuevo = "select id_ficha from ficha_clinica order by id_ficha desc limit 1";

$resultado = mysqli_query($con_db, $idnuevo);
$row = mysqli_fetch_assoc($resultado);
?>



<main class="main__formularios">
    <h1>DATOS DEL PACIENTE</h1>
    <!-- inicio del formulario -->
    <form action="../functions/insertar_ficha.php" method="post">
        <div class="ficha__form">
            <div class="ficha__identificacion">
                <p>
                    <label>ID</label>
                    <!-- dato -->
                    <input type="hidden" id="id_oculto" value="<?php echo $row["id_ficha"]+1;?>">
                    <input type="text" class="ficha_id" id="ficha_id" name="ficha_id" value="">
                    <label class="asignar_id" onclick="asignar()">Asignar</label>
                </p>
                <p>
                    <label>Fecha</label>
                    <!-- dato -->
                    <input type="date" name="fecha_ficha">
                </p>
            </div>

            <div class="ficha_datos_paciente">
                <p>
                    <!-- datos -->
                    Nombres <input type="text" class="datoP" name="nombre">
                    <br>
                    Apellidos <input type="text" class="datoP" name="apellido">
                    <br>
                    Direccion <input type="text" class="datoP" name="direccion">
                    <br>
                    Edad <input type="text" class="edad" name="edad">
                    Telefono <input type="text" class="telefono" name="telefono">
                    Correo <input type="text" class="correo" name="correo">
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
                    <input type="hidden" name="usa_lentes" value="no">
                    Usa Lentes <input type="checkbox" name="usa_lentes" value="si">
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
                        <td><input type="text" class="dato_rx" name="agudeza_od1"></td>
                        <td><input type="text" class="dato_rx" name="agudeza_od2"></td>
                        <td><input type="text" class="dato_rx" name="agudeza_od3"></td>
                        <td><input type="text" class="dato_rx" name="agudeza_od4"></td>
                        <td><input type="text" class="dato_rx" name="agudeza_od5"></td>
                    </tr>
                    <tr>
                        <td>OI</td>
                        <td><input type="text" class="dato_rx" name="agudeza_oi1"></td>
                        <td><input type="text" class="dato_rx" name="agudeza_oi2"></td>
                        <td><input type="text" class="dato_rx" name="agudeza_oi3"></td>
                        <td><input type="text" class="dato_rx" name="agudeza_oi4"></td>
                        <td><input type="text" class="dato_rx" name="agudeza_oi5"></td>
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
                        <td><input type="text" class="dato_rx" name="ambuOD_esf"></td>
                        <td><input type="text" class="dato_rx" name="ambuOD_cil"></td>
                        <td><input type="text" class="dato_rx" name="ambuOD_eje"></td>
                        <td><input type="text" class="dato_rx" name="ambuOD_add"></td>
                        <td><input type="text" class="dato_rx" name="ambuOD_pris"></td>
                    </tr>
                    <tr>
                        <td>OI</td>
                        <td><input type="text" class="dato_rx" name="ambuOI_esf"></td>
                        <td><input type="text" class="dato_rx" name="ambuOI_cil"></td>
                        <td><input type="text" class="dato_rx" name="ambuOI_eje"></td>
                        <td><input type="text" class="dato_rx" name="ambuOI_add"></td>
                        <td><input type="text" class="dato_rx" name="ambuOI_pris"></td>
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
                        <td><input type="text" class="dato_rx" name="finalOD_esf"></td>
                        <td><input type="text" class="dato_rx" name="finalOD_cil"></td>
                        <td><input type="text" class="dato_rx" name="finalOD_eje"></td>
                        <td><input type="text" class="dato_rx" name="finalOD_add"></td>
                        <td><input type="text" class="dato_rx" name="finalOD_pris"></td>
                    </tr>
                    <tr>
                        <td>OI</td>
                        <td><input type="text" class="dato_rx" name="finalOI_esf"></td>
                        <td><input type="text" class="dato_rx" name="finalOI_cil"></td>
                        <td><input type="text" class="dato_rx" name="finalOI_eje"></td>
                        <td><input type="text" class="dato_rx" name="finalOI_add"></td>
                        <td><input type="text" class="dato_rx" name="finalOI_pris"></td>
                    </tr>
                    <tr>
                        <td>Material</td>
                        <td><input type="text" class="dato_rx" name="final_material"></td>
                        <td>DIP</td>
                        <td><input type="text" class="dato_rx" name="final_dip"></td>
                        <td>Tipo de lente</td>
                        <td><input type="text" class="dato_rx" name="final_tipolent"></td>
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
                        <td><input type="text" class="dato_rx" name="antOD_esf"></td>
                        <td><input type="text" class="dato_rx" name="antOD_cil"></td>
                        <td><input type="text" class="dato_rx" name="antOD_eje"></td>
                        <td><input type="text" class="dato_rx" name="antOD_add"></td>
                        <td><input type="text" class="dato_rx" name="antOD_pris"></td>
                    </tr>
                    <tr>
                        <td>OI</td>
                        <td><input type="text" class="dato_rx" name="antOI_esf"></td>
                        <td><input type="text" class="dato_rx" name="antOI_cil"></td>
                        <td><input type="text" class="dato_rx" name="antOI_eje"></td>
                        <td><input type="text" class="dato_rx" name="antOI_add"></td>
                        <td><input type="text" class="dato_rx" name="antOI_pris"></td>
                    </tr>
                </table>
            </div>
            <input type="submit" value="Guardar" class="submit">
        </div>
    </form>
</main>
<script src="../js/insertid.js"></script>
