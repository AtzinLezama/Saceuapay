<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "saceuapay";


$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
    die("no hay conexion " . mysqli_connect_error());
}

$numalumno = $_GET['alumno']; 

//mysqli_set_charset("utf8");

$conalumnos = ("SELECT * FROM tbl_alumno WHERE numero_control = '$numalumno'");
$result = mysqli_query($conn, $conalumnos);

if (mysqli_num_rows($result) > 0) {

    $alumno = mysqli_fetch_object($result);
    $alumno->status = 200;
    echo json_encode($alumno);
} else {
    $error  = array('status' => 400);
    echo json_encode((object)$error);
}
