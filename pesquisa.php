<?php
    //session_start();
    include_once('sessiontimeout.php');

    ob_start();

    //$sql = new Sql();
?>
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
        <?php
        //$_SESSION['ZC_depart'];
        if($_SESSION['ZC_depart'] === 'consulta'){
            echo "<div class='header-content'>";
            echo "<div class='navbar'>";
            echo "<a href='./pesquisa.php'>Pesquisa</a>";
            echo "</div>";    
            echo "</div>";
            echo "</div>";
        }else{
            echo "<div class='header-content'>";
            echo "<div class='navbar'>";
            echo "<a href='./inserir.php'>Inicio</a>";
            echo "<a href='./retira.php'>Retira</a>";
            echo "<a href='./transporte.php'>Transporte</a>";
            echo "<a href='./sedex.php'>Sedex</a>";
            echo "<a href='./pesquisa.php'>Pesquisa</a>";
            echo "</div>";
            echo "</div>";
        }
        ?>
        <a href="sair.php" name="editar" id="editar">Sair</a>
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



