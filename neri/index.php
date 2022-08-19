<?php

ini_set('display_errors', 1);

require_once('Sql.php');

$bd = new Sql();

$result = $bd->select('SELECT * FROM pessoa LIMIT 1'); //sem parâmetros no where
$result2 = $bd->select('SELECT * FROM pessoa where idpessoa = :idpessoa', [
    ':idpessoa' => 2
]);

echo("<pre>");
var_dump($result);
echo "<hr>";
var_dump($result2);