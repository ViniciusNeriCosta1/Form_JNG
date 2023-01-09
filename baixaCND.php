<?php
    include_once('sql/Sql.php');
    $sql = new Sql();

    $result = $sql->select("SELECT za_pedido, za_origem, za_empresa, za_nf, za_transportador, za_prazo, za_dt_lib_fat, za_obs, za_id
    FROM prd_p12.sza WHERE za_tp_saida = 'transporte' AND za_origem = 'CND' AND za_dt_saida IS NULL ORDER BY za_id DESC");
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
    <title>Baixa CND | JNG</title>
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
        <div class="fundo_table">
            <fieldset>
                <legend><b>Baixa CND</b></legend>
                <table>
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Origem</th>
                            <th>NF</th>
                            <th>Transportador</th>
                            <th>Prazo</th>
                            <th>Entrada</th>
                            <th>Saída</th>
                            <th>OBS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($result as $k => $v) {
                                echo"<tr>";
                                echo"<td>".$v['za_pedido']."</td>";
                                echo"<td>".$v['za_origem']."</td>";
                                echo"<td>".$v['za_nf']."</td>";
                                echo"<td>".$v['za_transportador']."</td>";
                                echo"<td>".$v['za_prazo']."</td>";
                                echo"<td>".$v['za_dt_lib_fat']."</td>";
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