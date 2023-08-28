<?php
//conexion bd
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "saceuapay";


$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
    die("no hay conexion " . mysqli_connect_error());
}
//variables
$año = $_POST["txtAño"];
$periodo = $_POST["txtPeriodo"];

//duplicacion
$duplicacion = "SELECT * FROM tbl_periodo WHERE año = '$año' AND periodo = '$periodo'";
$querty0 = mysqli_query($conn, $duplicacion);

if ($querty0->num_rows > 0) {
    echo '
    <script>
    alert("Periodo ya registrado");
    window.location.href = "periodos.html";
    </script>
    ';
} else {
    //insert
    $insertarperiodo = "INSERT INTO tbl_periodo (año, periodo) VALUES ('$año','$periodo')";                             //columnas											//informacion a subir
    $query = mysqli_query($conn, $insertarperiodo);

    if (!$query) {

        echo '
    <script>
    alert("hubo algun error");
    window.location.href = "periodos.html";
    </script>
    ';
    } else {
        echo '
    <script>
    alert("Periodo creado correctamente");
    window.location.href = "periodos.html";
    </script>
    ';
    }
}
