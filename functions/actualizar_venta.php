<?php
include("../functions/db_connection.php");

$id_venta = $_POST["id_venta"];
$fecha = $_POST["fecha"];
$nombre = $_POST["nombre"];
$abono = $_POST["abono"];
$saldo = $_POST["saldo"];
$fecha_entrega = $_POST["entrega"];
$lente = $_POST["lente"];
$precio_lente = $_POST["precio_lente"];
$montura = $_POST["montura"];
$precio_montura = $_POST["precio_montura"];
$estuche = $_POST["estuche"];
$spray = $_POST["spray"];
$precio_accs = $_POST["precio_accs"];
$total = $_POST["total"];

$guardarventa = "call sp_actualizar_venta('$id_venta','$fecha','$nombre','$abono','$saldo','$fecha_entrega','$lente','$precio_lente','$montura','$precio_montura','$estuche','$spray','$precio_accs','$total')";
$resultado = mysqli_query($con_db, $guardarventa);

if($resultado){
    echo "<script>alert('Se ha registrado correctamente'); window.location='../views/consulta_venta.php'</script>";
}else{
    echo "<script>alert('No se ha podido registrar la información'); window.history.go(-1);</script>";
}