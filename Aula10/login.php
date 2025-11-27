<?php
session_start();

if (isset($_SESSION["usuario"])){
 $_SESSION['usuario'] = $_POST ['usuario'];
  $_SESSION['senha'] = $_POST ['senha'];

setcookie("usuario", "jenifer", time() + (+60 * 5), "/");
if (isset($_COOKIE["usuario"])){
    echo $_COOKIE["usuario"];
    
}else {
    echo "não existe";
}
  echo "sessão inicada e usuario cadastrado";

} else {
    echo "usuario ". $_SESSION["usuario"] ."ja esta logado.<br>";
     echo "senha ". $_SESSION["senha"] ."br";
}
?>