<?php

require_once "vendor/autoload.php";

$json = file_get_contents('php://input');
$aux = json_decode($json);


$nome= $aux->nome;
$idade = $aux->idade;
$email = $aux->email;
$endCobranca = $aux->endCobranca;
$endEntrega = $aux->endEntrega;
$id_usuario = $aux->id_usuario;

$usuario = new User();
$usuario->cadastrarClientes($nome,$idade,$email,$endCobranca,$endEntrega,$id_usuario);

//header("Location: tela_inicial.php");

?>