<?php
    include_once('sql/Sql.php');

    $sql = new Sql();

    $transportadora = filter_input(INPUT_GET, "zb_transportador");

    if(!empty($transportadora)){

        $transp = "%".$transportadora."%";
        $info = $sql->select('SELECT zb_id, zb_transportador FROM prd_p12.szb WHERE zb_transportador LIKE :zb_transportador LIMIT 2', array(
            ':zb_transportador' => $transp
        ));
        if(empty($info) and count($info) == 0){
            $retorna = ['erro' => true, 'msg' => "Transportador nao encontrado"];
        }else{
            $retorna = ['erro' => false, 'dados' => $info];
        }
    }else{
        $retorna = ['erro' => true, 'msg' => "Transportador nao encontrado"];
    }

    echo json_encode($retorna);
?>