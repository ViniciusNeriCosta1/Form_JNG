<?php
session_start();
ob_start();
unset($_SESSION['ZC_id'], $_SESSION['ZC_login'], $_SESSION['ZC_depart'], $_SESSION['ZC_site']);
$_SESSION['msg'] = "<p style='color: green'>Deslogado com sucesso</p>";
header('Location: home.php');