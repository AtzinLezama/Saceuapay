
<?php

$conn = new mysqli("localhost", "root", "", "saceuapay");

/* Comprobando si hay un error de conexión. */
if ($conn->connect_error) {
    die('Error de conexion ' . $conn->connect_error);
}



/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id_alumno', 'nombre', 'numero_control', 'id_carrera', 'cuatrimestre',];
$columns2 = ['id_carrera', 'nombre'];

/* Nombre de la tabla */
$table = "tbl_alumno";
$table2 = "tbl_carrera";

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
$sql = "SELECT " . implode(", ", $columns) . " FROM $table $where ";
$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;

/*
$sql2 = "SELECT nombre FROM $table2";
$resultado2 = $conn->query($sql2);
$num_rows2 = $resultado2->num_rows2;


/* Mostrado resultados */
$html = '';



if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        /*$sql2 = "SELECT nombre FROM tbl_carrera WHERE id_carrera = $row[id_carrera]";
			$query2 = mysqli_query($conn, $sql2);
			$res2 = mysqli_fetch_array($query2);
			$max = $res2[0];**/
        //echo $max;
        $html .= '<tr>';
        $html .= '<td>' . $row['id_alumno'] . '</td>';
        $html .= '<td>' . $row['nombre'] . '</td>';
        $html .= '<td>' . $row['numero_control'] . '</td>';
        if ($row['id_carrera'] == 0) {
            $html .= '<td>Mercadotecnia</td>';
        } else if ($row['id_carrera'] == 1) {
            $html .= '<td>Contaduria</td>';
        } else if ($row['id_carrera'] == 2) {
            $html .= '<td>Derecho</td>';
        } else if ($row['id_carrera'] == 3) {
            $html .= '<td>Ciencias de la comunicación</td>';
        } else if ($row['id_carrera'] == 4) {
            $html .= '<td>Administración de empresas turísticas</td>';
        }
        $html .= '<td>' . $row['cuatrimestre'] . '</td>';
        $html .= '<td><a href="actualizarAlumno.php?id=' . $row['id_alumno'] . '" ><img src = "images/iconedit.svg"  width="30" height="30" /> </a></td>';
        $html .= '<td><a href="deleteAlumno.php?id=' . $row['id_alumno'] . '"   onclick="return confirmacion()"><img src = "images/icondelete.svg" width="30" height="30" /></a></td>';
        $html .= '<td><a href="ASaceuapay.php?id=' . $row['id_alumno'] . '" ><img src = "images/pago.png"  width="30" height="30" /> </a></td>';

        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}
//  data-href="eliminarAlumno.php?id=' . echo $row|['id'];. '"

echo json_encode($html, JSON_UNESCAPED_UNICODE);
//echo $row['id_carrera'];
?>