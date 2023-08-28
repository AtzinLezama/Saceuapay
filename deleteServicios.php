<?php

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'saceuapay'
);

echo $_GET['id'];





if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM tbl_concepto WHERE id_concepto = '$id'";
    $result = mysqli_query($conn, $query);
    echo '
    <script>
    alert("Periodo eliminado correctamente");
    window.location.href = "readServicios.php";
    </script>
    ';
    echo $id;
} else if (!$result) {
    echo '
    <script>
    alert("Periodo eliminado correctamente");
    window.location.href = "readServicios.php";
    </script>
    ';
}
