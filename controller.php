<?php
    require 'Action.php';
    require 'config.php';

    session_start();
    $action = new Action();
    $verifica = $action->check($host,$database,$usuario,$senha,$tabela);

    if($_SESSION["Npedido"] == $verifica){
        $verifica = 0;
    }else{
        $_SESSION["Npedido"] = $verifica;
        $verifica = 1;
    }

    echo $verifica;
