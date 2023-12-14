<?php
include("../functions/db_connection.php");
$id_orden = $_POST["pedidos_id"];
$fecha = $_POST["fecha_orden"];
$nombre = $_POST["nombre"];
$id_laboratorio = $_POST["lab"];
$armazon = $_POST["armazon"];
$od_esf = $_POST["pedido_od1"];
$od_cil = $_POST["pedido_od2"];
$od_eje = $_POST["pedido_od3"];
$od_add = $_POST["pedido_od4"];
$od_prisma = $_POST["pedido_od5"];
$oi_esf = $_POST["pedido_oi1"];
$oi_cil = $_POST["pedido_oi2"];
$oi_eje = $_POST["pedido_oi3"];
$oi_add = $_POST["pedido_oi4"];
$oi_prisma = $_POST["pedido_oi5"];
$dip = $_POST["dip"];
$altura = $_POST["altura"];
$puente = $_POST["puente"];
$horizontal = $_POST["horizontal"];
$vertical = $_POST["vertical"];
$diagonal = $_POST["diagonal"];
$material = $_POST["material"];

$guardarpedido = "call sp_orden('$id_orden','$fecha','$nombre','$id_laboratorio','$armazon','$od_esf','$od_cil','$od_eje','$od_add','$od_prisma','$oi_esf','$oi_cil','$oi_eje','$oi_add','$oi_prisma','$dip','$altura','$puente','$horizontal','$vertical','$diagonal','$material')";

$resultado = mysqli_query($con_db, $guardarpedido);

if($resultado){
    echo "<script>alert('Se ha registrado correctamente'); window.location='../views/laboratorios.php'</script>";
}else{
    echo "<script>alert('No se ha podido registrar la información'); window.history.go(-1);</script>";
}