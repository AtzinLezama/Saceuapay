<?php

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'saceuapay'
);

$id = $_POST['txtId'];
$numcontrol = $_POST["txtNumcontrol"];
$alumno = $_POST["txtRalumno"];
$cuatrimestre = $_POST["txtCuatrimestre"];
$carrera = $_POST["txtCarrera"];
$concepto = $_POST["txtConcepto"];
$estatus = $_POST["txtEstatus"];
$cantidad = $_POST["txtCantidad"];
$descuento = $_POST["txtDescuento"];
$total = $_POST["txtTotal"];
$tpago = $_POST["txtTpago"];
$comentarios = $_POST["txtComentarios"];




$sql = "UPDATE tbl_cargo SET cuatrimestre='$cuatrimestre', carrera='$carrera', status='$estatus', cantidad='$cantidad',descuento ='$descuento', total='$total', tipo_pago='$tpago', observaciones='$comentarios' WHERE id_cargo  = '$id'";
$query = mysqli_query($conn, $sql);

if ($query) {

    header("Location: readSaceuapay.php");
}
