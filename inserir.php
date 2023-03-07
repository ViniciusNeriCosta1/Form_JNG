<?php
    //include_once('sessiontimeout.php');
    session_start();
    ob_start();

    if((!isset($_SESSION['ZC_id'])) AND (!isset($_SESSION['ZC_depart']))){
        header('Location: home.php');
        $_SESSION['msg'] = "<p style='color: red'>Erro: Necessário realizar o login.</p>";
    }

    date_default_timezone_set('America/Sao_Paulo');

    include_once('sql/Sql.php');

    $sql = new Sql();

    function incluirPedido()
    {
        $sql = new Sql();
        $_POST['za_dt_lib_fat'] = date('Y-m-d');
        $_POST['za_ip'] = $_SERVER['REMOTE_ADDR'];
        unset($_POST['submit']);
        $sql -> insert('prd_p12.sza', $_POST);
        //var_dump($sql);
        //var_dump($sql->getErrors());
    }

    if(isset($_POST['submit']))
    {
        $pedido = $_POST['za_pedido'];
        $verifica = $sql->select('SELECT za_id, za_pedido, za_dt_saida FROM prd_p12.sza WHERE za_dt_saida IS NOT NULL AND za_pedido LIKE :za_pedido', array(
            ':za_pedido' => $pedido
        ));
        if(empty($verifica)){
            $result = incluirPedido();
        }elseif($verifica){
            echo "<script type='text/javascript'>var resultado = confirm('Pedido: ".$pedido." já existe, o pedido não será incluido?');
            if(resultado == true){
                alert('false');
            }
            else{
                certo();
            }
            function certo(){"
                .incluirPedido()."
            }
            </script>";
        }elseif(! $result){//valida se o resultado do array e informa o erro do insert
            $erros = $sql->getErrors();
            //echo "<script>alert($erros);</script>";
            var_dump($erros);
        }else{
            header('Location: inserir.php');
            die();
        }
        //var_dump($_POST);
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
        <?php
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
            <form action="inserir.php" method="POST">
                <fieldset>
                    <legend><b>Inserir Pedido</b></legend>
                    <div class="inputBox">
                    <label for="za_pedido" class="labelSelect">Numero do Pedido</label>
                        <input type="number" name="za_pedido" id="za_pedido" class="inputUser" required maxlength="6" min="0">
                    </div>
                    <div class="inputSelect">
                        <label for="za_tp_saida" class="labelSelect">Tipo de Saída</label>
                        <select type="text" name="za_tp_saida" id="za_tp_saida">
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
    <script>
        function certo(){
            alert('true');
        }
    </script>
    <script src="./js/maxTam.js"></script>
</body>
</html>