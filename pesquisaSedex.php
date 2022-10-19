<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();
    $info = "Ultimos 5";
    
    if(!empty($_GET['search']))
    {   
        $data = $_GET['search'];
        $result = $sql->select("SELECT * FROM prd_p12.sza WHERE nf = '$data' OR pedido = '$data' OR data_saida = '$data' ORDER BY id DESC");
        $info = "Infos";
    }else{
        $result = $sql->select("SELECT za_pedido, za_empresa, za_dt_lib_fat, za_dt_entrada, za_hr_chegada, za_hr_saida, za_obs FROM prd_p12.sza ORDER BY id DESC LIMIT 5"); 
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
    <title>Pesquisa Transporte | JNG</title>
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
                <fieldset>
                    <legend><b>Pesquisa Sedex</b></legend>
                    <div class="inputPesq">
                        <input type="search" placeholder="Nº Pedido, NF ou Data(Ano-Mes-Dia)" id="pesquisar" maxlength="6">
                        <button onclick="searchData()">Pesquisar</button>
                    </div>
                </fieldset>
            </div>
        <div class="fundo_table">
            <fieldset>
                <legend><b><?php echo $info; ?></b></legend>
                <table>
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Empresa</th>
                            <th>NF</th>
                            <th>Prazo</th>
                            <th>Volume</th>
                            <th>Rastreio</th>
                            <th>Chegada</th>
                            <th>Saída</th>
                            <th>OBS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($result as $k => $v) {
                                echo"<tr>";
                                echo"<td>".$v['za_pedido']."</td>";
                                echo"<td>".$v['za_empresa']."</td>";
                                echo"<td>".$v['za_nf']."</td>";
                                echo"<td>".$v['za_prazo']."</td>";
                                echo"<td>".$v['za_volume']."</td>";
                                echo"<td>".$v['za_rastreio']."</td>";
                                echo"<td>".$v['za_hr_chegada']."</td>";
                                echo"<td>".$v['za_hr_saida']."</td>";
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="./js/getPesquisa.js"></script>
    <script src="./js/chancePlaceholder.js"></script>
</body>
</html>



