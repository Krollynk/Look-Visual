<?php
include("db_connection.php");

$usuario = $_POST['usuario'];
$contra = $_POST['password'];
session_start();
$_SESSION['usuario']=$usuario;

$consulta = "select * from acceso_usuario where user_user = '$usuario' and user_password = '$contra'";
$resultado = mysqli_query($con_db,$consulta);

$row = mysqli_num_rows($resultado);

if($row){
    echo "<script>window.location='../views/menu'</script>";
}else{
    echo "<script>alert('Usuario o Contraseña incorrectos, verifique de nuevo'); window.history.go(-1);</script>";
}

mysqli_free_result($resultado);
mysqli_close($con_db);