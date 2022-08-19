<!DOCTYPE html>

<html>
    <?php
    //iniciar a pesquisa no banco de Dados para povoar a tabela
    //criar a conexão com o banco de dados
    $link = new mysqli('localhost', 'suporteti', 'q1Q!q1Q!', 'formulario_retira');

    if (!$link) {
        die('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }
    //Selecionar todos os registros da tabela
    $query = "SELECT * FROM formulario_retira.retira where time_saida = '00:00' ORDER BY time_ent asc;" or die("Error in the consult.." . mysqli_error($link));
    $result = $link->query($query);
    $cont=0;
    ?>
    <body>
        <form method="POST" action="teste.php">
            <table>
                <thead>
                    <tr>
                        <th>Hora Chegada</th>
                        <th>Nome</th>
                        <th>Empresa</th>
                        <th>Documento</th>
						<th>Pedido</th>
                        <th>Obs</th>
                        <th>Data</th>
                        <th>Horário de saída</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- iniciando loop para povoar a tabela --> 
<?php
//Criando variável para armazenar os dados
//Adiciona o ID para poder fazer a gravação no banco posteriormente
$tabela = "Notas";
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        //Saber quantos resgistros existem na tabela
        $cont++;
        //time_ent,nome,empresa,doc,pedido,obs,data,time_saida
        $tabela .= " <tr>"
                . "<td><input type='text' name='time_ent_$id' id= '{time_ent_$id}' value='{$row['time_ent']}'></td>
				   <td><input type='text' name='nome_$id' id= '{nome_$id}' value='{$row['nome']}' disable ></td>
                   <td><input type='text' name='empresa_$id' value='{$row['empresa']}' id= '{empresa_$id}'></td>
                   <td><input type='text' name='doc_$id' value='{$row['doc']}' id= '{doc_$id}'></td>
                   <td><input type='text' name='pedido_$id' value='{$row['pedido']}' id= '{pedido_$id}' ></td>
                   <td><input type='text' name='obs_$id' id= '{obs_$id}' value='{$row['obs']}' ></td>
                   <td><input type='text' name='data_$id' value='{$row['data']}' id= '{data_$id}'></td>
                   <td><input type='text' name='time_saida_$id' value='{$row['time_saida']}' id= '{time_saida_$id}'></td>"
                . "</tr>";
    }
}

echo $tabela;
?>




                </tbody>
            </table>
            <!-- passando para o post a qtd de registros -->
            <input type="hidden" name="totalRegistros" value="<?=$cont;?>">
            <button type="submit">Enviar notas</button>
        </form>
    </body>

</html>