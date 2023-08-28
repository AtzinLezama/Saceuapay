<?php

$conn = new mysqli("localhost", "root", "", "saceuapay");

/* Comprobando si hay un error de conexión. */
if ($conn->connect_error) {
    die('Error de conexion ' . $conn->connect_error);
}



/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id_inscripcion', 'id_alumno', 'beca', 'inscripcion ', 'sep', 'oct', 'nov', 'dic', 'comentarios', 'estado', 'saldo', 'carrera'];

/* Nombre de la tabla */
$table = "tbl_inscripcion";


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
FROM $table
$where ";
$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;


/* Mostrado resultados */
$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $alu = $row['id_alumno'];
        $sql2 = "SELECT * FROM tbl_alumno WHERE id_alumno = '$alu'";
        $query2 = mysqli_query($conn, $sql2);
        $row3 = mysqli_fetch_array($query2);



        $html .= '<tr>';
        $html .= '<td>' . $row3['numero_control'] . '</td>';
        $html .= '<td>' . $row3['nombre'] . '</td>';
        $html .= '<td>' . $row['beca'] . '</td>';
        $html .= '<td>' . $row['inscripcion'] . '</td>';
        $html .= '<td>' . $row['sep'] . '</td>';
        $html .= '<td>' . $row['oct'] . '</td>';
        $html .= '<td>' . $row['nov'] . '</td>';
        $html .= '<td>' . $row['dic'] . '</td>';
        $html .= '<td>' . $row['comentarios'] . '</td>';
        $html .= '<td>' . $row['estado'] . '</td>';
        $html .= '<td>' . $row['saldo'] . '</td>';
        $html .= '<td>' . $row['carrera'] . '</td>';

        $html .= '<td><a href="editIngreso.php?id=' . $row['id_inscripcion'] . '" ><img src = "images/iconedit.svg"  width="30" height="30" /> </a></td>';
        $html .= '<td><a href="deleteIngreso.php?id=' . $row['id_inscripcion'] . '" onclick="return confirmacion()"><img src = "images/icondelete.svg" width="30" height="30" /></a></td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}
//  data-href="eliminarAlumno.php?id=' . echo $row|['id'];. '"

echo json_encode($html, JSON_UNESCAPED_UNICODE);
