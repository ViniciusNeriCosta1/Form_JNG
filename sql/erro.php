<?php

class erro{
    public function erroPedido(){
        echo "<script>alert('Pedido não selecionado');</script>";
    }

    public function notLogin(){
        if((!isset($_SESSION['ZC_id'])) AND (!isset($_SESSION['ZC_depart']))){
            header('Location: home.php');
            $_SESSION['msg'] = "<p style='color: red'>Erro: Necessário realizar o login</p>";
        }
    }
}

?>