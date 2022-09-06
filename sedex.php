<?php
    include_once('sql/Sql.php');

    $sql = new Sql();

    if(isset($_POST['submit']))
    {
        $empresa = $_POST['empresa'];
        $pedido = $_POST['pedido'];
        $nf = $_POST['nf'];
        $prazo = $_POST['prazo'];
        $volume = $_POST['volume'];
        $data_saida = $_POST['data_saida'];
        $rastreio = $_POST['rastreio'];
        $ip = $_POST['ip'];

        $result = $sql->query('INSERT INTO formulario_retira.sedex(
                empresa, pedido, nf, prazo, volume, data_saida, rastreio, ip
            ) VALUES (
                :empresa, :pedido, :nf, :prazo, :volume, :data_saida, :rastreio, :ip
            )
        ', array(
             ':empresa' => $empresa,
             ':pedido' => $pedido,
             ':nf' => $nf,
             ':prazo' => $prazo,
             ':volume' => $volume,
             ':data_saida' => $data_saida,
             ':rastreio' => $rastreio,
             ':ip' => $_SERVER['REMOTE_ADDR']
        ));
        if(! $result){//valida se o resultado do array e informa o erro do insert
            $erros = $sql->getErrors();
            echo "<script>alert($erros);</script>";
        }else{
            header('Location: sedex.php');
            die();
        }
    }

    $result = $sql->select("SELECT * FROM sedex ORDER BY id DESC LIMIT 10");
   
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
    <title>Sedex | JNG</title>
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
                <a href="./pesquisa.php">Pesquisa</a>
            </div>    
        </div>
    </header>
    <main>
        <div class="fundo_dados">
            <form action="sedex.php" method="POST">
                <fieldset>
                    <legend><b>Formulário de Sedex</b></legend>
                    <div class="inputBox">
                        <label for="data_saida" class="labelInput">Data</label>
                        <input type="date" name="data_saida" id="data_saida" class="inputUser" required>
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="empresa" class="labelInput">Empresa</label>
                        <input type="text" name="empresa" id="empresa" class="inputUser" required maxlength="20">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="pedido" class="labelInput">Pedido</label>
                        <input type="number" name="pedido" id="pedido" class="inputUser" required maxlength="6" min="0">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="nf" class="labelInput">NF</label>
                        <input type="number" name="nf" id="nf" class="inputUser" required maxlength="6" min="0">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="prazo" class="labelInput">Prazo</label>
                        <input type="number" name="prazo" id="prazo" class="inputUser" required maxlength="2" min="0">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="volume" class="labelInput">Volume</label>
                        <input type="number" name="volume" id="volume" class="inputUser" required maxlength="2" min="0">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="rastreio" class="labelInput">Rastreio</label>
                        <input type="number" name="rastreio" id="rastreio" class="inputUser" required maxlength="13" min="0">
                    </div>
                    <br></br>
                    <input type="submit" name="submit" id="submit">
                    <br>
                </fieldset>
            </form>
        </div>
        <div class="fundo_table">
            <fieldset>
                <legend><b>INFOS</b></legend>
                <table>
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Empresa</th>
                            <th>Nº NF</th>
                            <th>Data</th>
                            <th>Prazo</th>
                            <th>Volume</th>
                            <th>Rastreio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($result as $k => $v) {
                                echo"<tr>";
                                echo"<td>".$v['pedido']."</td>";
                                echo"<td>".$v['empresa']."</td>";
                                echo"<td>".$v['nf']."</td>";
                                echo"<td>".$v['data_saida']."</td>";
                                echo"<td>".$v['prazo']."</td>";
                                echo"<td>".$v['volume']."</td>";
                                echo"<td>".$v['rastreio']."</td>";
                                echo"</tr>";
                            }
                        ?>    
                    </tbody>
                </table>
            </fieldset>
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