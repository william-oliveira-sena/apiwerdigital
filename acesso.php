<?php

    //testa se o campo usuario e senha estão preenchidos e se contém valor caso não contenha, não deixa usuario passar direto para tela principal do sistema.
    if(isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['senha']) && !empty($_POST['senha']))
       { 
           //inclui o arquivo autoloader para carregar as classes com o composer.
            require_once "vendor/autoload.php";

              //cria o objeto
            $novoUsuario = new User();
              //chama classe de conexão ao banco
            $novoUsuario->conecta();

             $usuario = $_POST['user'];
             $senha = md5($_POST['senha']);

              //adiciona os valores ao novo objeto
             $novoUsuario->login($usuario,$senha);            
            
            
             if($novoUsuario->login($usuario,$senha) == true){
                //testa se a sessão existe
                if(isset($_SESSION['id_usuario'])){
                //coloca o usuario dentro do sistema
                 header("Location:tela_inicial.php");
             }else{
               header("location: index.php");
          }

         }else{

            header("location: index.php");
          }
           
        }           