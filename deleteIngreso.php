<?php

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'saceuapay'
);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM tbl_inscripcion WHERE id_inscripcion = '$id'";
    $result = mysqli_query($conn, $query);
    echo '
    <script>
    alert("inscripcion eliminado correctamente");
    window.location.href = "readIngreso.php";
    </script>
    ';
    echo $id;
} else if (!$result) {
    echo '
    <script>
    alert("inscripcion eliminado correctamente");
    window.location.href = "readIngreso.php";
    </script>
    ';
}
