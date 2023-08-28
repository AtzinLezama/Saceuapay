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

if (isset($_GET['term'])) {
    $find_nombre = find_nombre($conn, $_GET['term']);
    $id_List = array();
    foreach ($find_nombre as $nombre) {
        $id_List[] = $nombre['nombre'];
    }
    echo json_encode($id_List);
}

function find_nombre($conn, $term)
{
    $query = "SELECT * FROM clientes WHERE nombre LIKE '%" . $term . "%'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}
