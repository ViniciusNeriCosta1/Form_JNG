<!DOCTYPE html>
<html lang="pt-br">
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" type = "imagem/x-icon" href = "./assets/logo_jng.ico"/>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | JNG</title>
</head>
<body>
    <header>
        <div class="logo_header">
            <img src="./assets/logo_JNG_azul.png" alt="Logo JNG" class="img_logo_header">
        </div>
    </header>
    <main>
        <div class="fundo_dados">
            <form action="login.php" method="POST">
                <fieldset>
                    <legend><b>Login</b></legend>
                        <div class="inputLogin">
                            <input type="text" placeholder="login" name="login" id="login">
                            <br>
                            <input type="password" placeholder="senha" name="senha" id="senha">
                            <br>
                            <input type="submit" value="Login" id="submit">
                        </div>
                </fieldset>
            </form>
        </div>
    </main>
    <footer>
        <div class="rodape">
            <p>Copyright © 2022 Intranet JNG</p>
        </div>
    </footer>
</body>
</html>



