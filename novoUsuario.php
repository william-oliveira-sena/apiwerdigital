<?php

require_once "vendor/autoload.php";

$json = file_get_contents('php://input');
$aux = json_decode($json);


$login = $aux->login;
$senha = md5($aux->senha);
$nome_usuario= $aux->nome;


$usuario = new User();
$usuario->cadastrarUsuario($login,$senha,$nome_usuario);

header("Location: index.php");

?>