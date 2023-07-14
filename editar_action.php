<?php
   
   require_once "vendor/autoload.php";

   $json = file_get_contents('php://input'); 
   $aux = json_decode($json);

    $id = $aux->id_clientes;
    $nome = $aux->nome_cliente;    
    $idade = $aux->idade;
    $email = $aux->email;
    $endCobranca = $aux->endCobranca;
    $endEntrega = $aux->endEntrega;
    $id_user = $aux->id_usuario;

    if($id && $nome && $idade && $email && $endCobranca && $endEntrega && $id_user){
        $usuario = new User();
       
        $usuario->editar($id,$nome,$idade,$email,$endCobranca,$endEntrega,$id_user);
   

   // header("Location: tela_inicial.php");
    //exit;
    // }else{
      //  header("Location: tela_inicial.php");
     //   exit;
    }

?>