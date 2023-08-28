<?php

$conn = new mysqli("localhost", "root", "", "saceuapay");

/* Comprobando si hay un error de conexión. */
if ($conn->connect_error) {
    die('Error de conexion ' . $conn->connect_error);
}



/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id_cargo', 'numero_control', 'id_alumno ', 'cuatrimestre', 'carrera', 'id_conceptos', 'status', 'cantidad', 'descuento', 'total', 'tipo_pago', 'fecha', 'observaciones'];

/* Nombre de la tabla */
$table = "tbl_cargo";

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

        $concepto = $row['id_conceptos'];
        $sql4 = "SELECT * FROM tbl_concepto WHERE id_concepto = '$concepto'";
        $query4 = mysqli_query($conn, $sql4);
        $row4 = mysqli_fetch_array($query4);


        $html .= '<tr>';
        $html .= '<td>' . $row['id_cargo'] . '</td>';
        $html .= '<td>' . $row['numero_control'] . '</td>';
        $html .= '<td>' . $row3['nombre'] . '</td>';
        $html .= '<td>' . $row['cuatrimestre'] . '</td>';
        $html .= '<td>' . $row['carrera'] . '</td>';
        $html .= '<td>' . $row4['nombre'] . '</td>';
        $html .= '<td>' . $row['status'] . '</td>';
        $html .= '<td>' . $row['cantidad'] . '</td>';
        $html .= '<td>' . $row['descuento'] . '</td>';
        $html .= '<td>' . $row['total'] . '</td>';
        $html .= '<td>' . $row['tipo_pago'] . '</td>';
        $html .= '<td>' . $row['fecha'] . '</td>';
        $html .= '<td>' . $row['observaciones'] . '</td>';
        $html .= '<td><a href="editSaceuapay.php?id=' . $row['id_cargo'] . '"  ><img src = "images/iconedit.svg"  width="30" height="30" /> </a></td>';
        $html .= '<td><a href="deleteSaceuapay.php?id=' . $row['id_cargo'] . '" onclick="return confirmacion()"><img src = "images/icondelete.svg" width="30" height="30" /></a></td>';
        $html .= '<td><a href="saceuapaypdf.php?id=' . $row['id_cargo'] . '"><img src = "images/print.png" width="30" height="30" /></a></td>';

        $html .= '</tr>'; 
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}
//  data-href="eliminarAlumno.php?id=' . echo $row|['id'];. '"

echo json_encode($html, JSON_UNESCAPED_UNICODE);
