<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();
    $info = "Ultimos 5";

    if(!empty($_GET['search']))
    {   
        $data = $_GET['search'];
        $result = $sql->select("SELECT * FROM formulario_retira.transporte WHERE nf = '$data' OR pedido = '$data' OR data_saida = '$data' OR motorista = '$data' ORDER BY id DESC");
        $info = "Infos";
    }else{
        $result = $sql->select("SELECT * FROM formulario_retira.transporte ORDER BY id DESC LIMIT 5"); 
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
                    <legend><b>Pesquisa Transporte</b></legend>
                    <div class="inputPesq">
                        <input type="search" placeholder="Nº Pedido, NF ou Data(Ano-Mes-Dia)" id="pesquisar" maxlength="10">
                        <button onclick="searchData()" name="pesquisar" id="pesquisar">Pesquisar</button>
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
                            <th>NF</th>
                            <th>Motorista</th>
                            <th>Data Entrada</th>
                            <th>Data Saida</th>
                            <th>OBS</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($result as $k => $v) {
                                echo"<tr>";
                                echo"<td>".$v['pedido']."</td>";
                                echo"<td>".$v['nf']."</td>";
                                echo"<td>".$v['motorista']."</td>";
                                echo"<td>".$v['data_entrada']."</td>";
                                echo"<td>".$v['data_saida']."</td>";
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
        window.location = 'pesquisaTransporte.php?search='+search.value;
    }
</script>
</body>
</html>



