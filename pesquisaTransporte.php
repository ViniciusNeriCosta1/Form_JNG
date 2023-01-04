<?php
    include_once('sql/Sql.php');
    $sql = new Sql();

    $info = "Ultimos 5";

    if(!empty($_GET['search']))
    {   
        $origem = $_GET['origem'];
        $select = $_GET['select'];
        $data = $_GET['search'];
        $result = $sql->select("SELECT za_pedido, za_origem, za_nf, za_transportador, za_prazo,za_dt_lib_fat, za_dt_saida, za_obs 
        FROM prd_p12.sza WHERE za_tp_saida = 'transporte' AND za_origem = '$origem' AND $select = '$data' ORDER BY za_id DESC");
        $info = "Infos";
    }else{
        $result = $sql->select("SELECT za_pedido, za_origem, za_nf, za_transportador, za_prazo, za_dt_lib_fat, za_dt_saida, za_obs 
        FROM prd_p12.sza WHERE za_tp_saida = 'transporte' ORDER BY za_id DESC LIMIT 5"); 
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="shortcut icon" type = "imagem/x-icon" href = "./assets/logo_jng.ico"/>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa Transporte | JNG</title>
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
                <fieldset>
                    <legend><b>Pesquisa Transporte</b></legend>
                    <div class="inputPesq">
                        <select type="text" name="select" id="select" style="width: 200px;">
                            <option value="za_pedido">Pedido</option>
                            <option value="za_nf">NF</option>
                            <option value="za_dt_saida">Data Saída</option>
                        </select>
                        <input type="search" name="pesquisar" id="pesquisar" placeholder="NF, Nº Pedido ou Data Saída">
                    </div>
                    <div class="inputSelect">
                        <label for="origem" class="labelSelect">Origem</label>
                        <select type="text" name="origem" id="origem">
                            <option value="CND">CND</option>
                            <option value="CDA">CDA</option>
                        </select>
                    </div>
                    <div class="inputPesq" style="margin-top: 10px">
                        <button onclick="searchDataTransporte()" name="submit" id="submit">Pesquisar</button>
                        <?php 
                        if(!empty($_GET['search']))
                        {
                            echo "<a href='./pesquisaTransporte.php' name='submit' id='submit'>Voltar</a>";  
                        }else
                        {
                            echo "<a href='./pesquisa.php' name='submit' id='submit'>Voltar</a>";
                        }
                        ?>
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
                            foreach ($result as $k => $v) {
                                echo"<tr>";
                                echo"<td>".$v['za_pedido']."</td>";
                                echo"<td>".$v['za_origem']."</td>";
                                echo"<td>".$v['za_nf']."</td>";
                                echo"<td>".$v['za_transportador']."</td>";
                                echo"<td>".$v['za_prazo']."</td>";
                                echo"<td>".$v['za_dt_lib_fat']."</td>";
                                echo"<td>".$v['za_dt_saida']."</td>";
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
    <script src="./js/chancePlaceholder.js"></script>
    <script src="./js/getPesquisa.js"></script>
</body>
</html>



