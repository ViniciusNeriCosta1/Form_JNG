<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $sql->select('UPDATE formulario_retira.retira SET time_saida = :time_saida WHERE id = :id', array(
            ':time_saida' => date('H:i'),
            ':id' => $_GET['id']
        ));

        header('Location: retira.php');
        die();
    }

    if(isset($_POST['submit']))
    {
        $time_ent = $_POST['time_ent'];
        $time_saida = $_POST['time_saida'];
        $nome = $_POST['nome'];
        $empresa = $_POST['empresa'];
        $doc = $_POST['doc'];
        $pedido = $_POST['pedido'];
        $obs = $_POST['obs'];
        $data_retira = $_POST['data_retira'];
        $ip = $_POST['ip'];

        $result = $sql->query('INSERT INTO formulario_retira.retira(
                time_ent, nome, empresa, doc, pedido, obs, time_saida, data, ip
            ) VALUES (
                :time_ent, :nome, :empresa, :doc, :pedido, :obs, :time_saida, :data, :ip
            )
        ', array(
            ':time_ent' => $time_ent,
             ':nome' => $nome,
             ':empresa' => $empresa,
             ':doc' => $doc,
             ':pedido' => $pedido,
             ':obs' => $obs,
             ':data' => $data_retira,
             ':time_saida' => '00:00',
             ':data' => $data_retira,
             'ip' => $_SERVER['REMOTE_ADDR']
        ));
        if(! $result){//valida se o resultado do array e informa o erro do insert
            $erros = $sql->getErrors();
            echo "<script>alert($erros);</script>";
        }else{
            header('Location: retira.php');
            die();
        }
    }

    $result = $sql->select("SELECT * FROM retira WHERE time_saida = '00:00' ORDER BY id ASC");
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
    <title>Retira | JNG</title>
</head>
<body>
    <header>
        <div class="logo_header">
            <img src="./assets/logo_JNG_azul.png" alt="Logo JNG" class="img_logo_header">
        </div>
        <div class="header-content">
            <div class="navbar">
                <a href="./retira.php">Retira</a>
                <a href="./retira.php">Entrada e Saída</a>
                <a href="./retira.php">Sedex</a>
                <a href="./retira.php">Pesquisa</a>
            </div>    
        </div>
    </header>
    <main>
        <div class="fundo_dados">
            <form action="retira.php" method="POST">
                <fieldset>
                    <legend><b>Formulário de Retira</b></legend>
                    <br>
                    <div class="inputBox">
                        <label for="data_retira" class="labelTime">Data</label>
                        <input type="date" name="data_retira" id="data_retira" class="inputUser" required>
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="time_ent" class="labelTime">Horario Entrada</label>
                        <input type="time" name="time_ent" id="time_ent" class="inputUser" required>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="text" name="nome" id="nome" class="inputUser" required maxlength="20">
                        <label for="nome" class="labelInput">Nome</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="text" name="empresa" id="empresa" class="inputUser" required maxlength="20">
                        <label for="empresa" class="labelInput">Empresa</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="text" name="doc" id="doc" class="inputUser" required maxlength="11">
                        <label for="doc" class="labelInput">Documento</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="number" name="pedido" id="pedido" class="inputUser" required maxlength="6" min="0">
                        <label for="pedido" class="labelInput">Pedido</label>
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
        <div class="fundo_table">
            <fieldset>
                <legend><b>INFOS</b></legend>
                <table>
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Nome</th>
                            <th>Empresa</th>
                            <th>Documento</th>
                            <th>Data</th>
                            <th>Entrada</th>
                            <th>Saida</th>
                            <th>OBS</th>
                            <input type="hidden">
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($result as $k => $v) {
                                echo"<tr>";
                                echo"<td>".$v['pedido']."</td>";
                                echo"<td>".$v['nome']."</td>";
                                echo"<td>".$v['empresa']."</td>";
                                echo"<td>".$v['doc']."</td>";
                                echo"<td>".$v['data']."</td>";
                                echo"<td>".$v['time_ent']."</td>";
                                echo"<td>
                                <a href='retira.php?id={$v['id']}' name='informe' id='informe'>Informe</a>
                                </td>";
                                echo"<td>".$v['obs']."</td>";
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



