<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'saceuapay'
);
session_start();
$actual = $_SESSION['usuario'];
$newusu = $_POST['txtemail'];
$newpass = $_POST['txtpass'];
$newpass2 = $_POST['txtpass2'];
//id_usuario
$id = "SELECT * FROM tbl_usuario WHERE login = '$actual'";
$query2 = mysqli_query($conn, $id);
$row = mysqli_fetch_array($query2);

if ($newpass == $newpass2) {
    $sql = "UPDATE tbl_usuario SET login = '$newusu', password = '$newpass' WHERE id_usuario = '$row[0]'";
    $query = mysqli_query($conn, $sql);


    if ($query) {
        echo '
        <script>
        alert("Usuario actualizado correctamente");
        window.location.href = "index.html";
        </script>
        ';
    }
} else {
    echo '
    <script>
    alert("La contraseña no coinside");
    window.location.href = "actualizarAlumnoa.php";
    </script>
    ';
}
