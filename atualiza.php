<?php

use function PHPSTORM_META\map;

    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();
    
    if (isset($_GET['za_id']) && !empty($_GET['za_id'])) {
        /*
        $result = $sql->query('UPDATE prd_p12.sza SET 
        za_hr_saida = :za_hr_saida, za_dt_saida = :za_dt_saida, za_ip = :za_ip WHERE za_id = :za_id', 
        array(
            ':za_hr_saida' => date('H:i'),
            ':za_dt_saida' => date('Y-m-d'),
            ':za_ip' => $_SERVER['REMOTE_ADDR'],
            ':za_id' => $_GET['za_id']
        ));
        */
        $info = $sql->select('SELECT za_tp_saida FROM prd_p12.sza WHERE za_id = :za_id',
        array(
            ':za_id' => $_GET['za_id'],
        ));
        if($info[0]['za_tp_saida'] == 'retira'){
            echo "retira";
            #header('Location: retira.php');
        }if($info[0]['za_tp_saida'] == 'sedex'){
            echo "sedex";
            #header('Location: sedex.php');
        }else{
            echo "ruim";
            #header('Location: transporte.php');
        }
        
    }
?>