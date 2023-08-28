<?php


if(isset($_GET['id'])){
    $id = $_GET['id'];
}
echo $id; 

echo'
<script>


var answer = window.confirm("Deseas eliminar el usuario?");
if (answer) {
    
else {
   window.location.href = "readUsuario.php";
}
</script>
';



?>