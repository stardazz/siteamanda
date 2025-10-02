<?php
    session_start(); //Inicia sessão
    session_unset(); //Apaga sessão
    session_destroy(); //Destrói sessão

    header('location:formLogin.php'); //Redireciona para o formulário de login
    exit();
?>