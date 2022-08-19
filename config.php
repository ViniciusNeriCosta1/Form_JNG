<?php
    $dbHost = 'localhost';
    $dbUsername = 'suporteti';
    $dbPassword = 'q1Q!q1Q!';
    $dbName = 'formulario_retira';

    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if($conexao->connect_errno){
        echo "Erro";
    }else{
        echo "Conexão efetuada com sucesso";
    }
?>