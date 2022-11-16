<?php
    setcookie("login", "", time()-3600);
    setcookie("idUsuario", "", time()-3600);
    header("Location: ./index.php");
?>