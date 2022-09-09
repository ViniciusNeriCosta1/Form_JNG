<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();
    $info = "Ultimos 5";
    
    if(!empty($_GET['search']))
    {   
        $data = $_GET['search'];
        $result = $sql->select("SELECT * FROM formulario_retira.retira WHERE pedido = '$data' OR data_retira = '$data'ORDER BY id DESC");
        $info = "Infos";
    }else{
        $result = $sql->select("SELECT * FROM formulario_retira.retira ORDER BY id DESC LIMIT 5"); 
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
    <title>Pesquisa Retira | JNG</title>
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
                    <legend><b><?php echo $info; ?></b></legend>
                    <div class="inputPesq">
                        <input type="search" placeholder="Nº Pedido ou Data(Ano-Mes-Dia)" id="pesquisar" maxlength="6">
                        <button onclick="searchData()">Pesquisar</button>
                    </div>
                </fieldset>
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
                                echo"<td>".$v['time_saida']."</td>";
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
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'pesquisaRetira.php?search='+search.value;
    }
</script>
</body>
</html>



