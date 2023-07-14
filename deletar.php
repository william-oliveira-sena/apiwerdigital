<?php

require_once "vendor/autoload.php";

$json = file_get_contents('php://input'); 
$aux = json_decode($json);

$id = $aux->id_clientes;

    if($id){
       $usuario = new User();
       $usuario->deletar($id);
    }

   // header("Location: tela_inicial.php");

?>