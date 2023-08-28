<?php

$conn = new mysqli("localhost", "root", "", "saceuapay");

/* Comprobando si hay un error de conexión. */
if ($conn->connect_error) {
    die('Error de conexion ' . $conn->connect_error);
}



/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['num_control', 'nombre', 'descuento', 'adeudo', 'mes1', 'mes2', 'mes3', 'mes4', 'saldo', 'comentarios'];

/* Nombre de la tabla */
$table = "tbl_ingreso";


$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;


/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}


/* Consulta */
$sql = "SELECT " . implode(", ", $columns) . "
FROM $table WHERE periodo = '1'";
$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;


/* Mostrado resultados */
$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {

        $html .= '<tr>';
        $html .= '<td>' . $row['num_control'] . '</td>';
        $html .= '<td>' . $row['nombre'] . '</td>';
        $html .= '<td>' . $row['descuento'] . '</td>';
        switch ($row['adeudo']) {
            case 1;
                $html .= '<td>si</td>';
                break;

            case 2;
                $html .= '<td>no</td>';
                break;
        }

        $html .= '<td>' . $row['mes1'] . '</td>';
        $html .= '<td>' . $row['mes2'] . '</td>';
        $html .= '<td>' . $row['mes3'] . '</td>';
        $html .= '<td>' . $row['mes4'] . '</td>';
        $html .= '<td>' . $row['saldo'] . '</td>';
        $html .= '<td>' . $row['comentarios'] . '</td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}
//  data-href="eliminarAlumno.php?id=' . echo $row|['id'];. '"

echo json_encode($html, JSON_UNESCAPED_UNICODE);
