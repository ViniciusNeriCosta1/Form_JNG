<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');
    include_once('sql/erro.php');

    $sql = new Sql();
    $erro = new erro();

    if(isset($_GET['za_id']) && !empty($_GET['za_id'])) 
    {
        $result = $sql->select('SELECT za_pedido, za_id FROM prd_p12.sza WHERE za_id = :za_id', array(
            ':za_id' => $_GET['za_id']
        ));
        foreach($result as $k => $v){}
    }else{
       $erro->erroPedido();
    }

    if(isset($_POST['submit']) && !empty($_POST['submit']))
    {
        if(empty($_GET['za_id'])){
            $erro->erroPedido();
        }else{
            $result = $sql->query('UPDATE prd_p12.sza SET 
            za_empresa = :za_empresa, za_nf = :za_nf, za_prazo = :za_prazo, za_volume = :za_volume, za_rastreio = :za_rastreio, za_dt_saida = :za_dt_saida, za_obs = :za_obs, za_ip = :za_ip, za_id = :za_id  
            WHERE za_id = :za_id', 
            array(
                ':za_empresa' => $_POST['empresa'],
                ':za_nf' => $_POST['nf'],
                ':za_prazo' => $_POST['prazo'],
                ':za_volume' => $_POST['volume'],
                ':za_rastreio' => $_POST['rastreio'],
                ':za_dt_saida' => date('Y-m-d'),
                ':za_obs' => $_POST['obs'],
                ':za_ip' => $_SERVER['REMOTE_ADDR'],
                ':za_id' => $_POST['za_id']
            ));
            if(!$result){//valida se o resultado do array e informa o erro do insert
                $erros = $sql->getErrors();
                echo "<script>alert($erros);</script>";
            }else{
                header('Location: sedex.php');
                die();
            }
        }

    }

    $result = $sql->select("SELECT za_pedido, za_dt_lib_fat, za_id
    FROM prd_p12.sza WHERE za_tp_saida = 'sedex' AND za_dt_saida IS NULL ORDER BY za_id DESC");
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
    <title>Sedex | JNG</title>
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
            <form action="sedex.php" method="POST">
                <fieldset>
                    <legend><b>Formulário de Sedex</b></legend>
                    <input type="hidden" name="za_id" id="za_id" value="<?php if(!empty($_GET['za_id'])){ echo $v['za_id'];}else{ echo "";}?>">
                    <div class="inputBox">
                        <label for="pedido" class="labelInput">Pedido</label>
                        <input type="text" name="pedido" id="pedido" class="inputUser" value="<?php if(!empty($_GET['za_id'])){ echo $v['za_pedido'];}else{ echo "Clique em editar pedido";}?>" disabled>
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="empresa" class="labelInput">Empresa</label>
                        <input type="text" name="empresa" id="empresa" class="inputUser" required maxlength="20" style="text-transform: uppercase" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="nf" class="labelInput">Nota Fiscal</label>
                        <input type="text" name="nf" id="nf" class="inputUser" maxlength="7">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="prazo" class="labelInput">Prazo</label>
                        <input type="text" name="prazo" id="prazo" class="inputUser" maxlength="2">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="volume" class="labelInput">Volume</label>
                        <input type="text" name="volume" id="volume" class="inputUser" maxlength="3">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="rastreio" class="labelInput">Rastreio</label>
                        <input type="text" name="rastreio" id="rastreio" class="inputUser" maxlength="13">
                    </div>
                    <br>
                    <div class="inputBox">
                        <label for="obs" class="labelInput">OBS</label>
                        <input type="text" name="obs" id="obs" class="inputUser" maxlength="20">
                    </div>
                    <br>
                    <input type="submit" name="submit" id="submit" value="Atualizar">
                    <br>
                </fieldset>
            </form>
        </div>
        <div class="fundo_table">
            <fieldset>
                <legend><b>Pendentes</b></legend>
                <table>
                    <thead>
                        <tr>
                            <th>Editar</th>
                            <th>Nº Pedido</th>
                            <th>Faturamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($result as $k => $v) {
                                echo"<tr>";
                                echo"<td>
                                <a href='sedex.php?za_id={$v['za_id']}' name='editar' id='editar''><i class='fal fa-solid fa-file-pen'></i></a>
                                </td>";
                                echo"<td>".$v['za_pedido']."</td>";
                                echo"<td>".$v['za_dt_lib_fat']."</td>";
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