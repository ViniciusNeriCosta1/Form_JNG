<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $info = $sql->select('SELECT * FROM formulario_retira.transporte WHERE id = :id', array(
            ':id' => $_GET['id']
        ));
        print_r($info);
        foreach($info as $k => $v){}

        if(isset($_POST['submit']))
        {   
        $result = $sql->select('UPDATE formulario_retira.transporte SET nf = :nf, motorista = :motorista, data_saida = :data_saida, obs = :obs 
        WHERE id = :id', 
        array(
            ':nf' => $_POST['nf'],
            ':motorista' => $_POST['motorista'],
            ':obs' => $_POST['obs'],
            ':data_saida' => $_POST['data_saida'],
            ':id' => $v['id']
        ));
        if(! $result){//valida se o resultado do array e informa o erro do insert
            $erros = $sql->getErrors();
            var_dump($erros);
            //print_r("<script>alert($erros);</script>");
        }else{
            header('Location: transporteEdit.php');
            die();
        }
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
    <title>Transporte | JNG</title>
</head>
<body>
    <header>
        <div class="logo_header">
            <img src="./assets/logo_JNG_azul.png" alt="Logo JNG" class="img_logo_header">
        </div>
        <div class="header-content">
            <div class="navbar">
                <a href="./retira.php">Retira</a>
                <a href="./transporte.php">Transporte</a>
                <a href="./sedex.php">Sedex</a>
                <a href="./retira.php">Pesquisa</a>
            </div>    
        </div>
    </header>
    <main>
        <div class="fundo_dados">
            <form action="transporteEdit.php" method="POST">
                <fieldset>
                    <legend><b>Formulário de Transporte</b></legend>
                    <br>
                    <div class="inputBox">
                        <label for="data_entrada" class="labelTime">Data Entrada</label>
                        <input type="date" name="data_entrada" id="data_entrada" class="inputUser" value="<?php echo $v['data_entrada'] ?>" required>
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="data_saida" class="labelTime">Data Saida</label>
                        <input type="date" name="data_saida" id="data_saida" class="inputUser">
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="text" name="pedido" id="pedido" class="inputUser" value="<?php echo $v['pedido'] ?>" required maxlength="6" min="0" >
                        <label for="pedido" class="labelInput">Pedido</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="number" name="nf" id="nf" class="inputUser" value="<?php echo $v['nf'] ?>" maxlength="6" min="0">
                        <label for="nf" class="labelInput">NF</label>
                    </div>
                    <br>
                    <div class="inputSelect">
                        <label for="motorista" class="labelSelect">Motorista</label>
                        <select type="text" name="motorista" id="motorista">
                            <option value="<?php echo $v['motorista'] ?>"><?php echo $v['motorista'] ?></option>
                            <option value="Extramila">Extramila</option>
                            <option value="Eduardo">Eduardo</option>
                            <option value="Jonas">Jonas</option>
                            <option value="Gilvan">Gilvan</option>
                            <option value="Douglas">Douglas</option>
                            <option value="Jefferson">Jefferson</option>
                            <option value="Silvan">Silvan</option>
                        </select>
                    </div>
                    <br></br>
                    <div class="inputBox">
                        <input type="text" name="obs" id="obs" class="inputUser" maxlength="20">
                        <label for="obs" class="labelInput">OBS</label>
                    </div>
                    <br>
                    <input type="submit" name="submit" id="submit">
                    <br></br>
                </fieldset>
            </form>
        </div>
    </main>
    <footer>
        <div class="rodape">
            <p>Copyright © 2022 Intranet JNG</p>
        </div>
    </footer>
    <script>
        //funcao para selecionar todos os input tipo number e maxlength funcionar
        document.querySelectorAll('input[type="number"]').forEach(input =>{
            input.oninput = () => {
                if(input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLength);
            };
        });
    </script>
</body>
</html>



