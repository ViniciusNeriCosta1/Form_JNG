<?php
    include_once('config.php');

    $result2 = '';

    if(isset($_POST['submit']))
    {
        $time_ent = $_POST['time_ent'];
        $nome = $_POST['nome'];
        $empresa = $_POST['empresa'];
        $doc = $_POST['doc'];
        $pedido = $_POST['pedido'];
        $obs = $_POST['obs'];
        $data_retira = $_POST['data_retira'];

        $result = mysqli_query($conexao, "INSERT INTO formulario_retira.retira
        (time_ent,nome,empresa,doc,pedido,obs,data,time_saida) 
        VALUES ('$time_ent','$nome','$empresa','$doc','$pedido','$obs','$data_retira','00:00')");

        header('Location: retira.php');
        die();//para a execução do if
        
    }

    $sql = "SELECT * FROM retira where time_saida = '00:00' ORDER BY id DESC";

    $result2 = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="./style.css">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retira | JNG</title>
</head>
<body>
    <div class="fundo_dados">
        <form action="retira.php" method="POST">
            <fieldset>
                <legend><b>Formulário de Retira</b></legend>
                <br>
                <div class="inputBox">
                    <label for="data_retira" class="labelTime">Data</label>
                    <input type="date" name="data_retira" id="data_retira" class="inputUser" required>
                </div>
                <br>
                <div class="inputBox">
                    <label for="time_ent" class="labelTime">Horario Entrada</label>
                    <input type="time" name="time_ent" id="time_ent" class="inputUser" required>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="empresa" id="empresa" class="inputUser" required>
                    <label for="empresa" class="labelInput">Empresa</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="number" name="doc" id="doc" class="inputUser" required>
                    <label for="doc" class="labelInput">Documento</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="number" name="pedido" id="pedido" class="inputUser" required>
                    <label for="pedido" class="labelInput">Pedido</label>
                </div>
                <br></br>
                <div class="inputBox">
                    <input type="text" name="obs" id="obs" class="inputUser">
                    <label for="obs" class="labelInput">OBS</label>
                </div>
                <br>
                <input type="submit" name="submit" id="submit">
                <br></br>
                <button type="submit" name="submit" id="submit">Pesquisar</button>
            </fieldset>
        </form>
    </div>
    <div class="fundo_table">
        <fieldset>
            <legend><b>INFOS</b></legend>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Empresa</th>
                        <th>Documento</th>
                        <th>Entrada</th>
                        <th>Saida</th>
                        <th>OBS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($aux = mysqli_fetch_assoc($result2)){
                            echo"<tr>";
                            echo"<td>".$aux['id']."</td>";
                            echo"<td>".$aux['nome']."</td>";
                            echo"<td>".$aux['empresa']."</td>";
                            echo"<td>".$aux['doc']."</td>";
                            echo"<td>".$aux['time_ent']."</td>";
                            echo"<td>".$aux['time_saida']."</td>";
                            echo"<td>".$aux['obs']."</td>";
                            echo"</tr>";
                        }
                    ?>    
                </tbody>
            </table>
        </fieldset>
    </div>
</body>
</html>