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
    $query = "DELETE FROM tbl_cargo WHERE id_cargo = '$id'";
    $result = mysqli_query($conn, $query);
    echo '
    <script>
    alert("cargo eliminado correctamente");
    window.location.href = "readSaceuapay.php";
    </script>
    ';
    echo $id;
} else if (!$result) {
    echo '
    <script>
    alert("cargo no eliminado correctamente");
    window.location.href = "readSaceuapay.php";
    </script>
    ';
}
