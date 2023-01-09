<!DOCTYPE html>
<html lang="pt-br">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="shortcut icon" type = "imagem/x-icon" href = "./assets/logo_jng.ico"/>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300">
    <title>Pesquisar | JNG</title>
</head>
<body>
    <header>
        <div class="logo_header">
            <img src="./assets/logo_JNG_azul.png" alt="Logo JNG" class="img_logo_header">
        </div>
        <div class="header-content">
        <div class="navbar">
                <a href="./inserir.php">Inicio</a>
                <a href="./retira.php">Retira</a>
                <a href="./transporte.php">Transporte</a>
                <a href="./sedex.php">Sedex</a>
                <a href="./baixa.php">Baixa</a>
                <a href="./pesquisa.php">Pesquisa</a>
            </div>    
        </div>
        </div>
    </header>
    <main>
        <div class="fundo_dados">
            <fieldset>
                <legend><b>Pesquisa</b></legend>
                <div class="inputPesq">
                    <select name="opcao" id="opcao" onchange="window.location.href=this.value;">
                        <option value="" style="display: none;"></option>
                        <option value="pesquisaRetira.php">Retira</option>
                        <option value="pesquisaSedex.php">Sedex</option>
                        <option value="pesquisaTransporte.php">Transporte</option>
                    </select>
                </div>
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



