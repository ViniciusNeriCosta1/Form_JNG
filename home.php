<?php
    session_start();
    ob_start();
    //echo password_hash('consulta', PASSWORD_DEFAULT);

    include_once('sql/Sql.php');

    $sql = new Sql();

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($dados['login'])){
        unset($_POST['login']);
        $result = $sql->select("SELECT * FROM prd_p12.szc WHERE ZC_login = :ZC_login  LIMIT 1", array(
            ':ZC_login' => $dados['ZC_login']
        ));
        if(($result)AND(count($result)!=0)){
            if(password_verify($dados['ZC_senha'], $result[0]['ZC_senha'])){
                $_SESSION['ZC_id'] = $result[0]['ZC_id'];
                $_SESSION['ZC_login'] = $result[0]['ZC_login'];
                $_SESSION['ZC_depart'] = $result[0]['ZC_depart'];
                $_SESSION['ZC_site'] = $result[0]['ZC_site'];
                switch($result[0]['ZC_depart']){
                    case "faturamento":
                        header('Location: inserir.php');
                        break;
                    case "consulta":
                        header('Location: pesquisa.php');
                        break;
                }
            }else{
                $_SESSION['msg'] = "<p style='color: red'>Erro:  ou senha inválida</p>";
            }
        }else{
            $_SESSION['msg'] = "<p style='color: red'>Erro: Usuário ou  inválida</p>";
        }
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
    <title>Home | JNG</title>
</head>
<body>
    <header>
        <div class="logo_header">
            <img src="./assets/logo_JNG_azul.png" alt="Logo JNG" class="img_logo_header">
        </div>
    </header>
    <main>
        
        <div class="fundo_dados">
            <form action="" method="POST">
                <fieldset>
                    <legend><b>Login</b></legend>
                        <div class="inputLogin">
                            <?php
                                if(isset($_SESSION['msg'])){
                                    echo $_SESSION['msg'];
                                    echo "<br>";
                                    unset($_SESSION['msg']);
                                }        
                            ?>
                            <input type="text" placeholder="Digite o usuário" value="<?php if(isset($dados['ZC_login'])){echo $dados['ZC_login'];} ?>" name="ZC_login" id="ZC_login">
                            <br>
                            <input type="password" placeholder="senha" value="<?php if(isset($dados['ZC_senha'])){echo $dados['ZC_senha'];} ?>" name="ZC_senha" id="ZC_senha">
                            <br>
                            <input type="submit" value="Login" name="login" id="submit">
                        </div>
                </fieldset>
            </form>
        </div>
    </main>
    <footer>
        <div class="rodape">
            <p>Copyright © 2022 Intranet JNG</p>
        </div>
    </footer>
</body>
</html>



