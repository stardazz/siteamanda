<?php

    $hostBD   = "localhost"; //Define o local do servidor do BD
    $userBD   = "root"; //Define o usuário do BD (Padrão: root)
    $senhaBD  = "root"; //Define a senha do BD (Padrão: "")
    $database = "inf3amanda"; //Define qual base será realizada a conexão

    //Função do PHP para estabelecer conexão com BD
    $conn     = mysqli_connect($hostBD, $userBD, $senhaBD, $database);

    //Verificar se houve conexão
    if(!$conn){
        echo "<p>Erro ao tentar conectar a aplicação à base de dados <strong>$database</strong>!</p>";
    }

?>