<?php

    include_once('sql/Sql.php');

    $sql = new Sql();

    if(!isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['senha']))
    {
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $result = $sql->query("SELECT * FROM prd_p12.szc WHERE ZD_login = '$login' and ZD_senha = '$senha'");
        var_dump($result);
        if(($result) <= 1)
        {
            print_r ("n existe");

        }
        else
        {
            print_r ("existe");
        }
    }
    else
    {
        header('Location: home.php');
    }
?>
<!--
<!DOCTYPE html>
<html lang="pt-br">
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" type = "imagem/x-icon" href = "./assets/logo_jng.ico"/>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | JNG</title>
</head>
<body>
    <header>
        <div class="logo_header">
            <img src="./assets/logo_JNG_azul.png" alt="Logo JNG" class="img_logo_header">
        </div>
    </header>
    <main>
        <div class="fundo_dados">
            <fieldset>
                <legend><b>Login</b></legend>
                <br>
                <form action="login.php" method="POST">
                    <div class="inputLogin">
                        <input type="text" placeholder="login" name="login" id="login">
                        <br>
                        <input type="password" placeholder="senha" name="senha" id="senha">
                        <br>
                        <input type="submit" value="Login" id="submit">
                    </div>
                </form>
            </fieldset>
        </div>
    </main>
    <footer>
        <div class="rodape">
            <p>Copyright © 2022 Intranet JNG</p>
        </div>
    </footer>
</body>
</html>
-->