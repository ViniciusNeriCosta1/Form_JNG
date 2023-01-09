<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();

    if(isset($_POST['submit']))
    {
        $pedido = $_POST['pedido'];
        $tp_saida = $_POST['tp_saida'];

        $result = $sql->query('INSERT INTO prd_p12.sza(
            za_pedido, za_tp_saida, za_dt_lib_fat, za_ip
        ) VALUES (
            :za_pedido, :za_tp_saida, :za_dt_lib_fat, :za_ip
        )
        ', array(
        ':za_pedido' => $pedido,
        ':za_tp_saida' => $tp_saida,
        ':za_dt_lib_fat' => date('Y-m-d'),
        ':za_ip' => $_SERVER['REMOTE_ADDR']
        ));        
        if(! $result){//valida se o resultado do array e informa o erro do insert
            $erros = $sql->getErrors();
            echo "<script>alert($erros);</script>";
        }else{
            header('Location: inserir.php');
            die();
        }
    }

    $resultRetira = $sql->select("SELECT za_pedido, za_tp_saida, za_dt_lib_fat, za_id FROM prd_p12.sza WHERE za_tp_saida = 'retira' AND za_dt_saida IS NULL ORDER BY za_id DESC");

    $resultTrans = $sql->select("SELECT za_pedido, za_tp_saida, za_dt_lib_fat, za_id FROM prd_p12.sza WHERE za_tp_saida = 'transporte' AND za_dt_saida IS NULL ORDER BY za_id DESC");

    $resultSedex = $sql->select("SELECT za_pedido, za_tp_saida, za_dt_lib_fat, za_id FROM prd_p12.sza WHERE za_tp_saida = 'sedex' AND za_dt_saida IS NULL ORDER BY za_id DESC");

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
                <a href="./baixa.php">Baixa</a>
                <a href="./pesquisa.php">Pesquisa</a>
            </div>    
        </div>
    </header>
    <main>
        <div class="fundo_dados">
            <form action="inserir.php" method="POST">
                <fieldset>
                    <legend><b>Inserir Pedido</b></legend>
                    <div class="inputBox">
                    <label for="pedido" class="labelSelect">Numero do Pedido</label>
                        <input type="number" name="pedido" id="pedido" class="inputUser" required maxlength="6" min="0">
                    </div>
                    <div class="inputSelect">
                        <label for="tp_saida" class="labelSelect">Tipo de Saída</label>
                        <select type="text" name="tp_saida" id="tp_saida">
                            <option value="retira">Retira</option>
                            <option value="transporte">Transporte</option>
                            <option value="sedex">Sedex</option>
                        </select>
                    </div>
                    <br>
                    <input type="submit" name="submit" id="submit">
                    <br>
                </fieldset>
            </form>
        </div>
        <div class="fundo_table">
            <fieldset>
                <legend><b><?php echo count($resultRetira).' Pendentes Retira'?></b></legend>
                <table>
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Tipo de Saída</th></th>
                            <th>Data Entrada</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($resultRetira as $k => $v){
                                echo"<tr>";
                                echo"<td>".$v['za_pedido']."</td>";
                                echo"<td>".$v['za_tp_saida']."</td>";
                                echo"<td>".$v['za_dt_lib_fat']."</td>";
                                echo"<td>
                                <a href='{$v['za_tp_saida']}.php?za_id={$v['za_id']}' name='editar' id='editar''><i class='fal fa-solid fa-file-pen' name='editar' id='editar'></i></a>
                                </td>";
                                echo"</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </fieldset>
        </div>
        <div class="fundo_table">
            <fieldset>
            <legend><b><?php echo count($resultTrans).' Pendentes Transporte'?></b></legend>
                <table>
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Tipo de Saída</th></th>
                            <th>Data Entrada</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($resultTrans as $k => $v){
                                echo"<tr>";
                                echo"<td>".$v['za_pedido']."</td>";
                                echo"<td>".$v['za_tp_saida']."</td>";
                                echo"<td>".$v['za_dt_lib_fat']."</td>";
                                echo"<td>
                                <a href='{$v['za_tp_saida']}.php?za_id={$v['za_id']}' name='editar' id='editar''><i class='fal fa-solid fa-file-pen' name='editar' id='editar'></i></a>
                                </td>";
                                echo"</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </fieldset>
        </div>
        <div class="fundo_table">
            <fieldset>
                <legend><b><?php echo count($resultSedex).' Pendentes Sedex'?></b></legend>
                <table>
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Tipo de Saída</th></th>
                            <th>Data Entrada</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                            foreach($resultSedex as $k => $v){
                                echo"<tr>";
                                echo"<td>".$v['za_pedido']."</td>";
                                echo"<td>".$v['za_tp_saida']."</td>";
                                echo"<td>".$v['za_dt_lib_fat']."</td>";
                                echo"<td>
                                <a href='{$v['za_tp_saida']}.php?za_id={$v['za_id']}' name='editar' id='editar''><i class='fal fa-solid fa-file-pen' name='editar' id='editar'></i></a>
                                </td>";
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
</body>
</html>