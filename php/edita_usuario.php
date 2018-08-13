<?php

include "../_app/Config.inc.php";

$info = $_POST;

$crud->edita_usuario($info);

if ($_SESSION['nivel_usuario'] == 'adm') {
    echo "<script>window.location.href='" . HOME . "/lista_ger';</script>";
}else{
    echo "<script>window.location.href='" . HOME . "/';</script>";
}

?>