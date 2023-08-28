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
        $html .= '<tr>';
        $html .= '<td>' . $row['id_cargo'] . '</td>';
        $html .= '<td>' . $row['numero_control'] . '</td>';
        $html .= '<td>' . $row['id_alumno'] . '</td>';
        $html .= '<td>' . $row['cuatrimestre'] . '</td>';
        $html .= '<td>' . $row['carrera'] . '</td>';
        $html .= '<td>' . $row['id_conceptos'] . '</td>';
        $html .= '<td>' . $row['status'] . '</td>';
        $html .= '<td>' . $row['cantidad'] . '</td>';
        $html .= '<td>' . $row['descuento'] . '</td>';
        $html .= '<td>' . $row['total'] . '</td>';
        $html .= '<td>' . $row['tipo_pago'] . '</td>';
        $html .= '<td>' . $row['fecha'] . '</td>';
        $html .= '<td>' . $row['observaciones'] . '</td>';
       
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}
//  data-href="eliminarAlumno.php?id=' . echo $row|['id'];. '"

echo json_encode($html, JSON_UNESCAPED_UNICODE);
