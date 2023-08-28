<?php

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'saceuapay'
);

$id = $_POST['txtId'];

$nombre = $_POST['txtNombre'];
$costo = $_POST['txtCosto'];


$sql = "UPDATE tbl_concepto SET nombre = '$nombre', costo = '$costo' WHERE id_concepto = '$id'";
$query = mysqli_query($conn, $sql);

if ($query) {

    header("Location: readServicios.php");
}
