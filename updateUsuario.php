<?php

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'saceuapay'
);

$id = $_POST['txtId'];

$nombre = $_POST['txtNombre'];
$puesto = $_POST['txtPuesto'];
$email = $_POST['txtEmail'];
$contraseña = $_POST['txtContraseña'];
$telefono = $_POST['txtTelefono'];

$sql = "UPDATE tbl_empleado SET nombre = '$nombre', puesto = '$puesto', email = '$email', contraseña = '$contraseña',telefono = '$telefono' WHERE id_empleado = '$id'";
$query = mysqli_query($conn, $sql);

    if($query){
        
        header("Location: readUsuario.php");
    }



?>