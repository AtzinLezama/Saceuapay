<?php

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'saceuapay'
);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM tbl_empleado WHERE id_empleado = '$id'";
    $result = mysqli_query($conn, $query);
    echo '
    <script>
    alert("usuario eliminado correctamente");
    window.location.href = "readUsuario.php";
    </script>
    ';
    echo $id;
} else if (!$result) {
    echo '
    <script>
    alert("usuario eliminado correctamente");
    window.location.href = "readUsuario.php";
    </script>
    ';
}
