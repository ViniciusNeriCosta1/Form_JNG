<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $info = $sql->select('SELECT * FROM formulario_retira.transporte WHERE id = :id', array(
            ':id' => $_GET['id']
        ));
        print_r($info);
        if($info)
        {
            foreach($info as $k => $v)
            {
            $pedido = $GET['pedido'];
            $nf = $info['nf'];
            $motorista = $info['motorista'];
            $data_entrada = $info['data_entrada'];
            $data_saida = $info['data_saida'];
            $obs = $info['obs'];
            }
            print_r($pedido);
        }
    }

    if(isset($_POST['submit']))
    {
        $pedido = $_POST['pedido'];
        $nf = $_POST['nf'];
        $motorista = $_POST['motorista'];
        $data_entrada = $_POST['data_entrada'];
        $data_saida = $_POST['data_saida'];
        $obs = $_POST['obs'];
        $ip = $_POST['ip'];

        $result = $sql->query('INSERT INTO formulario_retira.transporte(
                pedido, nf, motorista, data_entrada, data_saida, obs, ip
            ) VALUES (
                :pedido, :nf, :motorista, :data_entrada, :data_saida, :obs, :ip
            )
        ', array(
            ':pedido' => $pedido,
            ':nf' => $nf,
            ':motorista' => $motorista,
            ':obs' => $obs,
            ':data_saida' => '1999-01-01',
            ':data_entrada' => $data_entrada,
            'ip' => $_SERVER['REMOTE_ADDR']
        ));
        if(! $result){//valida se o resultado do array e informa o erro do insert
            $erros = $sql->getErrors();
            var_dump($erros);
            //echo "<script>alert($erros);</script>";
        }else{
            header('Location: transporte.php');
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
            <form action="transporte.php" method="POST">
                <fieldset>
                    <legend><b>Formulário de Transporte</b></legend>
                    <br>
                    <div class="inputBox">
                        <label for="data_entrada" class="labelTime">Data Entrada</label>
                        <input type="date" name="data_entrada" id="data_entrada" class="inputUser" required>
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="data_saida" class="labelTime">Data Saida</label>
                        <input type="date" name="data_saida" id="data_saida" class="inputUser">
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="number" name="pedido" id="pedido" class="inputUser" value="<?php echo $pedido ?>" required maxlength="6" min="0" >
                        <label for="pedido" class="labelInput">Pedido</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="number" name="nf" id="nf" class="inputUser" maxlength="6" min="0">
                        <label for="nf" class="labelInput">NF</label>
                    </div>
                    <br>
                    <div class="inputSelect">
                        <label for="motorista" class="labelSelect">Motorista</label>
                        <select type="text" name="motorista" id="motorista">
                            <option value="extramila">Extramila</option>
                            <option value="eduardo">Eduardo</option>
                            <option value="jonas">Jonas</option>
                            <option value="gilvan">Gilvan</option>
                            <option value="douglas">Douglas</option>
                            <option value="jefferson">Jefferson</option>
                            <option value="jefferson">Silvan</option>
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
<!--        <div class="fundo_table">
            <fieldset>
                <legend><b>INFOS</b></legend>
                <table>
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>NF</th>
                            <th>Motorista</th>
                            <th>Data Entrada</th>
                            <th>Data Saida</th>
                            <th>OBS</th>
                            <th>Editar</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($result as $k => $v) {
                                echo"<tr>";
                                echo"<td>".$v['pedido']."</td>";
                                echo"<td>".$v['nf']."</td>";
                                echo"<td>".$v['motorista']."</td>";
                                echo"<td>".$v['data_entrada']."</td>";
                                echo"<td>".$v['data_saida']."</td>";
                                echo"<td>".$v['obs']."</td>";
                                echo"<td>
                                <a href='transporteEdit.php?id={$v['id']}' name='editar' id='editar'>☐</a>
                                </td>";
                                echo"</tr>";
                            }
                        ?>    
                    </tbody>
                </table>
            </fieldset>
        </div>-->
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



