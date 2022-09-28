<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();

    if(isset($_GET['za_id']) && !empty($_GET['za_id'])) 
    {
        $result = $sql->select('SELECT za_pedido, za_id FROM prd_p12.sza WHERE za_id = :za_id', array(
            ':za_id' => $_GET['za_id']
        ));
        foreach($result as $k => $v){}
    }

    if(isset($_POST['submit']) && !empty($_POST['submit']))
    {
        $result = $sql->query('UPDATE prd_p12.sza SET 
        za_nome = :za_nome, za_empresa = :za_empresa, za_documento = :za_documento, za_hr_chegada = :za_hr_chegada, za_obs = :za_obs, za_ip = :za_ip WHERE za_id = :za_id', 
        array(
            ':za_nome' => $_POST['nome'],
            ':za_empresa' => $_POST['empresa'],
            ':za_documento' => $_POST['doc'],
            ':za_hr_chegada' => $_POST['time_ent'],
            ':za_obs' => $_POST['obs'],
            ':za_ip' => $_SERVER['REMOTE_ADDR'],
            ':za_id' => $_POST['za_id']
        ));
        if(! $result){//valida se o resultado do array e informa o erro do insert
            $erros = $sql->getErrors();
            echo "<script>alert($erros);</script>";
        }else{
            header('Location: retira.php');
            die();
        }
    }

    $result = $sql->select("SELECT za_pedido, za_nome, za_empresa, za_documento, za_hr_chegada, za_obs, za_id
    FROM prd_p12.sza WHERE za_tp_saida = 'retira' AND za_dt_saida IS NULL ORDER BY za_id DESC");
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
    <title>Retira | JNG</title>
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
                <a href="./transporte.php">Sedex</a>
                <a href="./pesquisa.php">Pesquisa</a>
            </div>    
        </div>
    </header>
    <main>
        <div class="fundo_dados">
            <form action="retira.php" method="POST">
                <fieldset>
                    <legend><b>Formulário de Retira</b></legend>
                    <input type="hidden" name="za_id" id="za_id" value="<?php if(!empty($_GET['za_id'])){ echo $v['za_id'];}else{ echo "";}?>">
                    <div class="inputBox">
                        <label for="pedido" class="labelInput">Pedido</label>
                        <input type="text" name="pedido" id="pedido" class="inputUser" value="<?php if(!empty($_GET['za_id'])){ echo $v['za_pedido'];}else{ echo "";}?>" maxlength="6">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="time_ent" class="labelInput">Horario Entrada</label>
                        <input type="time" name="time_ent" id="time_ent" class="inputUser" required>
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="nome" class="labelInput">Nome</label>
                        <input type="text" name="nome" id="nome" class="inputUser" required maxlength="20">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="empresa" class="labelInput">Empresa</label>
                        <input type="text" name="empresa" id="empresa" class="inputUser" required maxlength="20">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="doc" class="labelInput">Documento</label>
                        <input type="text" name="doc" id="doc" class="inputUser" required maxlength="11">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="obs" class="labelInput">OBS</label>
                        <input type="text" name="obs" id="obs" class="inputUser" maxlength="20">
                    </div>
                    <br>
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
                            <th>Editar</th>
                            <th>Nº Pedido</th>
                            <th>Nome</th>
                            <th>Empresa</th>
                            <th>Documento</th>
                            <th>Chegada</th>
                            <th>Saída</th>
                            <th>OBS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($result as $k => $v) {
                                echo"<tr>";
                                echo"<td>
                                <a href='transporte.php?za_id={$v['za_id']}' name='editar' id='editar''><i class='fal fa-solid fa-file-pen'></i></a>
                                </td>";
                                echo"<td>".$v['za_pedido']."</td>";
                                echo"<td>".$v['za_nome']."</td>";
                                echo"<td>".$v['za_empresa']."</td>";
                                echo"<td>".$v['za_documento']."</td>";
                                echo"<td>".$v['za_hr_chegada']."</td>";
                                echo"<td>
                                <button onclick='confirme(".$v['za_id'].")' name='saida' id='saida'><i class='fa-solid fa-check'></i></button>
                                </td>";
                                echo"<td>".$v['za_obs']."</td>";
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
    <script src="./js/maxTam.js"></script>
    <script src="./js/saidaPedido.js"></script>
</body>
</html>