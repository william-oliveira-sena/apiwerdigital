<?php
   
    require_once "vendor/autoload.php";
             
         
        $usuario = new User();

        $dados = [];
        // $json = file_get_contents('php://input');
        // $aux = json_decode($json);
         //$id_usuario = $aux->id_usuario;

         $id_usuario = $_GET['id_usuario'];  
                
           
            $conexao = $usuario->conecta();
            
                //enviando a variavel conexão por parametro da função pesquisar
                $dados = $usuario->pesquisar($id_usuario,$conexao);
        
             echo json_encode($dados);
            
             
?>
                       
                                                     

                     
                       




