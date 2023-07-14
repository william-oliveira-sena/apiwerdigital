<?php

    class User {

        public function conecta(){            

            $server = "localhost";
            $base = "crud_werdigital";
            $usuario = "root";
            $senha = "";
           
            global $conexao;
              
            try{
           
                $conexao = new PDO("mysql:dbname=".$base."; host=".$server, $usuario, $senha);
               // session_start();
           
                //ativar o modo de erros
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
            }catch(PDOException $e){
                //erro na conexão
                $error = $e->getMessage();
                echo "erro: $error";  
            }
            return $conexao;
        }

        public function login($usuario, $senha){
            global $conexao;            
    
            $pesquisa = "SELECT * FROM usuarios WHERE login = :usuario  AND
            senha = :senha";
    
            $pesquisa= $conexao->prepare($pesquisa);
            $pesquisa->bindValue("usuario", $usuario);
            $pesquisa->bindValue("senha", $senha);
            $pesquisa->execute();
    
                if($pesquisa->rowCount() > 0){
                    $listaDados = $pesquisa->fetch();
                    session_start();
                    $_SESSION['id_usuario'] = $listaDados['id_usuario']; 
                    $_SESSION['nome_usuario']= $listaDados['nome'];
                    $_SESSION['login_usuario']= $listaDados['login'];
                    $_SESSION['senha']= $listaDados['senha'];
    
                    return true;
                }else{
                    return false;
                }                        
        }
        
        public function logoff(){
            session_destroy();
            header("Location: index.php");
        }

        public function pesquisar($id_usuario,$conexao){      

            $lista = [];

            $pesquisa= $conexao->prepare("SELECT cli.*, u.nome_usuario, u.id_usuario FROM clientes AS cli INNER JOIN usuarios AS u WHERE u.id_usuario = :id_usuario AND cli.id_usuario = :id_usuario;");
            $pesquisa->bindValue(':id_usuario',$id_usuario);
            $pesquisa->execute();

                if($pesquisa->rowCount() > 0){
                    $lista = $pesquisa->fetchALL(PDO::FETCH_ASSOC);
                    extract($lista);
                }

                return $lista;
        }
        public function cadastrarClientes($nome,$idade,$email,$endCobranca, $endEntrega,$id_usuario){

            $usuario= new User();
            $conexao = $usuario->conecta();
    
            $sql= $conexao->prepare("INSERT INTO clientes (nome_cliente, idade, email, end_cobranca,end_entrega, id_usuario) VALUES (:nome, :idade, :email,:endCobranca,:endEntrega,:id_usuario)");
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':idade', $idade);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':endCobranca', $endCobranca);
            $sql->bindValue(':endEntrega', $endEntrega);
            $sql->bindValue(':id_usuario',$id_usuario);
    
            $sql->execute();
        }
        public function cadastrarUsuario($login,$senha,$nome_usuario){

            $usuario= new User();
            $conexao= $usuario->conecta();
    
            $sql= $conexao->prepare("INSERT INTO usuarios (login, senha, nome_usuario) VALUES (:login, :senha, :nome_usuario)");
            $sql->bindValue(':login', $login);
            $sql->bindValue(':senha', $senha);
            $sql->bindValue(':nome_usuario', $nome_usuario);
              
            $sql->execute();
        }
        public function deletar($id){

            $usuario= new User();
            $conexao= $usuario->conecta();
    
            $sql= $conexao->prepare("DELETE FROM clientes WHERE id_clientes = :id");
            $sql->bindValue(':id',$id);
            $sql->execute();
        }

        public function editar($id,$nome,$idade,$email,$endEntrega,$endCobranca,$id_user){
           
            $usuario= new User();
            $conexao = $usuario->conecta();
    
            $sql = $conexao->prepare("UPDATE clientes SET id_clientes = :id, nome_cliente = :nome, idade = :idade, email = :email, end_cobranca = :endCobranca, 
            end_entrega = :endEntrega, id_usuario = :id_user WHERE id_clientes = :id");
            $sql->bindValue(':id',$id);
            $sql->bindValue(':nome',$nome);
            $sql->bindValue(':idade',$idade);
            $sql->bindValue(':email',$email);
            $sql->bindValue(':endCobranca',$endCobranca);
            $sql->bindValue(':endEntrega',$endEntrega);          
            $sql->bindValue(':id_user',$id_user);
            $sql->execute();
    
    
        }
        public function pesquisa_edita($id_clientes,$conexao){

               $clientes = [];

            $sql = $conexao->prepare("SELECT * FROM clientes WHERE id_clientes = :id_clientes");
            $sql->bindValue(':id_clientes',$id_clientes);
            $sql->execute();

                if($sql->rowCount() > 0){
                     $clientes = $sql->fetch(PDO::FETCH_ASSOC);
                }else{
                     header("Location: tela_inicial.php");
                exit;
            }

            return $clientes;

        
        }

    

    }



?>