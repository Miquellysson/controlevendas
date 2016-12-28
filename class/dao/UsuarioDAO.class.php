<?php
$caminho_base = $_SERVER["DOCUMENT_ROOT"];
include_once($caminho_base . "/class/persistencia/Conexao.class.php");
include_once($caminho_base . "/class/model/Usuario.class.php");
class UsuarioDAO {
    private $tabela;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados
    
    public function __construct() {
        $this->conexao = new Conexao();
//print_r( $this->conexao->conectar() ); die;
        $this->conexao = $this->conexao->conectar();
        $this->tabela = 'usuarios';
    }
    
    public function cadastrarUsuario(Usuario $usuario){
        try{
            $login = $usuario->getLogin();
            $senha = sha1( $usuario->getSenha() );
            $id = NULL;
            
            $query = "INSERT INTO $this->tabela VALUES(?, ?, ?)";
            $stmt = $this->conexao->prepare($query); //echo $query; die;
            $stmt->bindParam(1, $id, PDO::PARAM_NULL);
            $stmt->bindParam(2, $login);
            $stmt->bindParam(3, $senha);
            $inserir = $stmt->execute();
            if($inserir){
                return true;
            }else{
                return false;
            }
        }catch(Exception $erro){
            //echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
    public function existeUsuario($login){
        try{
            $query = "SELECT login FROM $this->tabela WHERE login = ?";
            
            $result = $this->conexao->prepare($query);
            $result->bindParam(1, $login );
            $result->execute();
            //$usuario = null;
            //if($result){
                $linha = $result->fetch(PDO::FETCH_ASSOC);
                
            //    $usuario = $linha['login'];
            //}
            if( $linha ){
                return true;
            }    
            return false;
        }catch(Exception $erro){
            //echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function autenticar($login, $senha){
        try{
            $query = "SELECT id_usuario, login, senha FROM $this->tabela WHERE login = ? AND senha = ?";
            
            $result = $this->conexao->prepare($query);
            $result->bindParam(1, $login );
            $result->bindParam(2, $senha );
            $result->execute();
            $usuario = null;
            $linha = $result->fetch(PDO::FETCH_OBJ);
            if($linha){
                $usuario = new Usuario($linha->login, $linha->senha);
                $usuario->setIdUsuario($linha->id_usuario);
            }
            return $usuario;
        }catch(Exception $erro){
            //echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
}
