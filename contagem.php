<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();

    if(isset($_POST['submit']))
    {
        $zd_codigo = $_POST['zd_codigo'];
        $zd_quant = $_POST['zd_quant'];
        $zd_end = $_POST['zd_end'];

        $result = $sql->query('INSERT INTO prd_p12.szd(
            zd_codigo, zd_quant, zd_end
        ) VALUES (
            :zd_codigo, :zd_quant, :zd_end
        )
        ', array(
        ':zd_codigo' => $zd_codigo,
        ':zd_quant' => $zd_quant,
        ':zd_end' => $zd_end
        ));        
        if(! $result){//valida se o resultado do array e informa o erro do insert
            $erros = $sql->getErrors();
            echo "<script>alert($erros);</script>";
        }else{
            header('Location: contagem.php');
            die();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" type = "imagem/x-icon" href = "./assets/logo_jng.ico"/>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300">
    <script src="https://kit.fontawesome.com/dadbdef077.js" crossorigin="anonymous"></script>
    <title>Inserir | JNG</title>
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
                <a href="./pesquisa.php">Pesquisa</a>
            </div>    
        </div>
    </header>
    <main>
        <div class="fundo_dados">
            <form action="contagem.php" method="POST">
                <fieldset>
                    <legend><b>Inserir Pedido</b></legend>
                    <div class="inputBox">
                    <label for="zd_codigo" class="labelSelect">Codigo</label>
                        <input type="number" name="zd_codigo" id="zd_codigo" class="inputUser" required maxlength="6" min="0">
                    </div>
                    <div class="inputBox">
                    <label for="zd_quant" class="labelSelect">Quantidade</label>
                        <input type="number" name="zd_quant" id="zd_quant" class="inputUser" required maxlength="6" min="0">
                    </div>
                    <div class="inputSelect">
                        <label for="zd_end" class="labelSelect">Endereço</label>
                        <select type="number" name="zd_end" id="zd_end">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <br>
                    <input type="submit" name="submit" id="submit">
                    <br>
                </fieldset>
            </form>
        </div>
    </main>
    <footer>
        <div class="rodape">
            <p>Copyright © 2022 Intranet JNG</p>
        </div>
    </footer>
    <script src="./js/maxTam.js"></script>
</body>
</html>