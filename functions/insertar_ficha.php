<?php
include("db_connection.php");
$id = $_POST["ficha_id"];
$fecha = $_POST["fecha_ficha"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$direccion = $_POST["direccion"];
$edad = $_POST["edad"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];

$sintoma1 = $_POST["sintoma1"];
$sintoma2 = $_POST["sintoma2"];
$sintoma3 = $_POST["sintoma3"];
$sintoma4 = $_POST["sintoma4"];
$sintoma5 = $_POST["sintoma5"];
$sintoma6 = $_POST["sintoma6"];
$sintoma7 = $_POST["sintoma7"];
$sintoma8 = $_POST["sintoma8"];
$sintoma9 = $_POST["sintoma9"];
$sintoma10 = $_POST["sintoma10"];
$sintoma11 = $_POST["sintoma11"];
$sintoma12 = $_POST["sintoma12"];
$sintoma13 = $_POST["sintoma13"];
$sintoma14 = $_POST["sintoma14"];
$sintoma15 = $_POST["sintoma15"];
$otros_sin = $_POST["otros_sintomas"];

$lentes = $_POST["usa_lentes"];

$ag_OD1 = $_POST["agudeza_od1"];
$ag_OD2 = $_POST["agudeza_od2"];
$ag_OD3 = $_POST["agudeza_od3"];
$ag_OD4 = $_POST["agudeza_od4"];
$ag_OD5 = $_POST["agudeza_od5"];
$ag_OI1 = $_POST["agudeza_oi1"];
$ag_OI2 = $_POST["agudeza_oi2"];
$ag_OI3 = $_POST["agudeza_oi3"];
$ag_OI4 = $_POST["agudeza_oi4"];
$ag_OI5 = $_POST["agudeza_oi5"];

$amb_OD1 = $_POST["ambuOD_esf"];
$amb_OD2 = $_POST["ambuOD_cil"];
$amb_OD3 = $_POST["ambuOD_eje"];
$amb_OD4 = $_POST["ambuOD_add"];
$amb_OD5 = $_POST["ambuOD_pris"];
$amb_OI1 = $_POST["ambuOI_esf"];
$amb_OI2 = $_POST["ambuOI_cil"];
$amb_OI3 = $_POST["ambuOI_eje"];
$amb_OI4 = $_POST["ambuOI_add"];
$amb_OI5 = $_POST["ambuOI_pris"];

$fin_OD1 = $_POST["finalOD_esf"];
$fin_OD2 = $_POST["finalOD_cil"];
$fin_OD3 = $_POST["finalOD_eje"];
$fin_OD4 = $_POST["finalOD_add"];
$fin_OD5 = $_POST["finalOD_pris"];
$fin_OI1 = $_POST["finalOI_esf"];
$fin_OI2 = $_POST["finalOI_cil"];
$fin_OI3 = $_POST["finalOI_eje"];
$fin_OI4 = $_POST["finalOI_add"];
$fin_OI5 = $_POST["finalOI_pris"];
$fin_mat = $_POST["final_material"];
$fin_dip = $_POST["final_dip"];
$fin_tiplen = $_POST["final_tipolent"];

$ant_OD1 = $_POST["antOD_esf"];
$ant_OD2 = $_POST["antOD_cil"];
$ant_OD3 = $_POST["antOD_eje"];
$ant_OD4 = $_POST["antOD_add"];
$ant_OD5 = $_POST["antOD_pris"];
$ant_OI1 = $_POST["antOI_esf"];
$ant_OI2 = $_POST["antOI_cil"];
$ant_OI3 = $_POST["antOI_eje"];
$ant_OI4 = $_POST["antOI_add"];
$ant_OI5 = $_POST["antOI_pris"];

$guardar_ficha = "CALL sp_ficha_clinica('$id','$fecha','$nombre','$apellido','$direccion',$edad,'$telefono','$correo','$lentes','$sintoma1','$sintoma2','$sintoma3','$sintoma4','$sintoma5','$sintoma6','$sintoma7','$sintoma8','$sintoma9','$sintoma10','$sintoma11','$sintoma12','$sintoma13','$sintoma14','$sintoma15','$otros_sin','$ag_OD1','$ag_OD2','$ag_OD3','$ag_OD4','$ag_OD5','$ag_OI1','$ag_OI2','$ag_OI3','$ag_OI4','$ag_OI5','$amb_OD1','$amb_OD2','$amb_OD3','$amb_OD4','$amb_OD5','$amb_OI1','$amb_OI2','$amb_OI3','$amb_OI4','$amb_OI5','$fin_OD1','$fin_OD2','$fin_OD3','$fin_OD4','$fin_OD5','$fin_OI1','$fin_OI2','$fin_OI3','$fin_OI4','$fin_OI5','$fin_mat','$fin_dip','$fin_tiplen','$ant_OD1','$ant_OD2','$ant_OD3','$ant_OD4','$ant_OD5','$ant_OI1','$ant_OI2','$ant_OI3','$ant_OI4','$ant_OI5')";

$resultado = mysqli_query($con_db, $guardar_ficha);

if($resultado){
    echo "<script>alert('Se ha registrado correctamente'); window.location='../views/lobby.php'</script>";
}else{
    echo "<script>alert('No se ha podido registrar la información'); window.history.go(-1);</script>";
}