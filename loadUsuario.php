<?php

$conn = new mysqli("localhost", "root", "", "saceuapay");

/* Comprobando si hay un error de conexión. */
if ($conn->connect_error) {
    die('Error de conexion ' . $conn->connect_error);
}



/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id_empleado', 'nombre', 'puesto', 'email', 'telefono', 'contraseña'];

/* Nombre de la tabla */
$table = "tbl_empleado";

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
        $html .= '<td>' . $row['id_empleado'] . '</td>';
        $html .= '<td>' . $row['nombre'] . '</td>';
        $html .= '<td>' . $row['puesto'] . '</td>';
        $html .= '<td>' . $row['email'] . '</td>';
        $html .= '<td>' . $row['contraseña'] . '</td>';
        $html .= '<td>' . $row['telefono'] . '</td>';
        $html .= '<td><a href="actualizarUsuario.php?id=' . $row['id_empleado'] . '"  ><img src = "images/iconedit.svg"  width="30" height="30" /> </a></td>';
        $html .= '<td><a href="deleteUsuario.php?id=' . $row['id_empleado'] . '" onclick="return confirmacion()"><img src = "images/icondelete.svg" width="30" height="30" /></a></td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
