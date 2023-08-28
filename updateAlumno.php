<?php

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'saceuapay'
);

$id = $_POST['txtId'];

$nombre = $_POST['txtNombre'];
$numcontrol = $_POST['txtNumcontrol'];
$carrera = $_POST['txtCarrera'];
$cuatrimestre = $_POST['txtCuatrimestre'];

$sql = "UPDATE tbl_alumno SET nombre = '$nombre', numero_control = '$numcontrol', id_carrera = '$carrera', cuatrimestre = '$cuatrimestre' WHERE id_alumno = '$id'";
$query = mysqli_query($conn, $sql);

    if($query){
        
        header("Location: readalumno.php");
    }



?>