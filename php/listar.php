<?php

require 'database.php';
$con = new Database();
$pdo = $con->conectar();



$campo = $_POST["campo"];

$sql = "SELECT numero_control, nombre FROM tbl_alumno WHERE numero_control LIKE ? OR nombre LIKE ? ORDER BY numero_control ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);

$html = "";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	$html .= "<li onclick=\"mostrar('" . $row["numero_control"] . "')\">" . $row["numero_control"] . " - " . $row["nombre"] . "</li>";
	
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>