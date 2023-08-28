<?php

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'saceuapay'
);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //select 
    $query1 = "SELECT id_usuario FROM tbl_alumno WHERE id_alumno = '$id'";
    $result1 = mysqli_query($conn, $query1);
    $row = mysqli_fetch_array($result1);

    //delete alumno

    $query = "DELETE FROM tbl_alumno WHERE id_alumno = '$id'";
    $result = mysqli_query($conn, $query);


    //delete usuario
    $query2 = "DELETE FROM tbl_usuario WHERE id_usuario = '$row[0]'";
    $result2 = mysqli_query($conn, $query2);

    echo '
    <script>
    alert("Alumno eliminado correctamente");
    window.location.href = "readAlumno.php";
    </script>
    ';
    echo $id;
} else if (!$result) {
    echo '
    <script>
    alert("Alumno no eliminado ");
    window.location.href = "readAlumno.php";
    </script>
    ';
}
