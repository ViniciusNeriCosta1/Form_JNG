<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();

    if(isset($_POST['submit']))
    {
        $pedido = $_POST['pedido'];
        $tp_saida = $_POST['tp_saida'];
        $dt_lib_fat = $_POST['dt_lib_fat'];

        $result = $sql->query('INSERT INTO prd_p12.sza(
                za_pedido, za_tp_saida, za_dt_lib_fat
            ) VALUES (
                :za_pedido, :za_tp_saida, :za_dt_lib_fat
            )
        ', array(
            ':za_pedido' => $pedido,
            ':za_tp_saida' => $tp_saida,
            ':za_dt_lib_fat' => date('Y-m-d')
        ));
        if(! $result){//valida se o resultado do array e informa o erro do insert
            $erros = $sql->getErrors();
            echo "<script>alert($erros);</script>";
        }else{
            header('Location: inserir.php');
            die();
        }
    }

    $result = $sql->select("SELECT za_pedido, za_tp_saida, za_dt_lib_fat FROM prd_p12.sza");
?>

<!DOCTYPE html>
<html lang="pt-br">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./fontawesome/css/all.css">
    <link rel="shortcut icon" type = "imagem/x-icon" href = "./assets/logo_jng.ico"/>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300">
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
                    <input type="hidden" name="dt_lib_fat">
                    <div class="inputSelect">
                        <label for="tp_saida" class="labelSelect">Tipo de Saída</label>
                        <select type="text" name="tp_saida" id="tp_saida">
                            <option value="interno">Interno</option>
                            <option value="externo">Externo</option>
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
                <legend><b>Ultimos 5</b></legend>
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
                            foreach($result as $k => $v){
                                echo"<tr>";
                                echo"<td>".$v['za_pedido']."</td>";
                                echo"<td>".$v['za_tp_saida']."</td>";
                                echo"<td>".$v['za_dt_lib_fat']."</td>";
                                echo"<td>
                                <a href='#'><i class='fa-light fa-pen-to-square'></i></a>
                                </td>";
                                echo"</tr>";
                            }
                        ?>    
                    </tbody>
                    <td><i class="fa-light"></i></td>
                </table>
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