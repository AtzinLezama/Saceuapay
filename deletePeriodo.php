<?php

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'saceuapay'
);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM tbl_periodo WHERE id_periodo = '$id'";
    $result = mysqli_query($conn, $query);
    echo '
    <script>
    alert("periodo eliminado correctamente");
    window.location.href = "readPeriodo.php";
    </script>
    ';
    echo $id;
} else if (!$result) {
    echo '
    <script>
    alert("periodo eliminado correctamente");
    window.location.href = "readPeriodo.php";
    </script>
    ';
}
