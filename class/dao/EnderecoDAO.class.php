<?php
$caminho_base = $_SERVER["DOCUMENT_ROOT"];
include_once($caminho_base . "/class/persistencia/Conexao.class.php");
include_once($caminho_base . "/class/model/Endereco.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/ControleVendas/';
//include_once $caminho_base.'class/persistencia/Conexao.class.php';
//include_once $caminho_base.'class/model/Endereco.class.php';
class EnderecoDAO {
    private $tabela;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->conectar();
        $this->tabela = 'enderecos';
    }
    
    public function cadastrarEndereco(Endereco $endereco){
        try{
            $logradouro = $endereco->getLogradouro();
            $numero = $endereco->getNumero();
            $bairro = $endereco->getBairro();
            $complemento = $endereco->getComplemento();
            $estado = $endereco->getEstado();
            $cidade = $endereco->getCidade();
            //$validaUsuario = preg_match("/^[a-zA-Z\s]+$/",$usuario);
            //$validaEmail = preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/",$email);

            //if ( ($validaUsuario) && ($validaEmail) && ($email !='') && (!empty($empresa)) ){
                    //$query="INSERT INTO $this->tabela VALUES(NULL,'".$usuario."', '".$senha."',
                    //    '".$email."','".$vinculo."','".$privilegio."','".$empresa."','S','".date('Y-m-d H:i:s')."')";
                    $id = NULL;
                    //$dataCadastro = date('Y-m-d H:i:s');
                    $query = "INSERT INTO $this->tabela VALUES(?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $this->conexao->prepare($query); //echo $query; die;
                    $stmt->bindParam(1, $id, PDO::PARAM_NULL);
                    $stmt->bindParam(2, $logradouro);
                    $stmt->bindParam(3, $numero);
                    $stmt->bindParam(4, $bairro);
                    $stmt->bindParam(5, $complemento);
                    $stmt->bindParam(6, $estado);
                    $stmt->bindParam(7, $cidade);
                    $inserir = $stmt->execute();
                    if($inserir){
                        return true;
                    }else{
                        return false;
                    }
            /*}else if ( $validaUsuario == false ){
                    return 'Preencha um usuário válido, somentes letras e espaço';
            }else if ( ($validaEmail == false) || empty($email) ){
                    return 'Preencha um e-mail válido';
            }else if ( empty($empresa) ){
                    return 'Preencha a empresa';
            }*/
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
    public function buscarMaximoIdEndereco(){
        try{
            $query = "SELECT MAX(id_endereco) AS id_endereco FROM $this->tabela";
            $result = $this->conexao->prepare($query);            
            //$result->bindParam(1, $usuario);
            $result->execute();
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            $idEndereco = $linha['id_endereco'];
            if( $idEndereco > 0 ){
                return $idEndereco;
            }     
            return false;
                    
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function deletarEnderecoPorId($idEndereco){
        try{
            $query = "DELETE FROM $this->tabela WHERE id_endereco = {$idEndereco}";
            //$result = mysql_query($query, parent::getCon()) or die(mysql_error());
            $result = $this->conexao->exec($query); 
            
            if ($result){
                $this->conexao = null;
                return true;
            }else{
                $this->conexao = null;
                return false;
            }
        //}catch(Exception $erro){
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
    public function alterarEndereco(Endereco $endereco){
        try{
            $idEndereco = $endereco->getIdEndereco();
            $logradouro = $endereco->getLogradouro();
            $numero = $endereco->getNumero();
            $bairro = $endereco->getBairro();
            $complemento = $endereco->getComplemento();
            //print_r($endereco); die;
            if ( ($logradouro != '') && ($numero != '') && ($bairro !='') ){
                $query = "UPDATE $this->tabela SET logradouro = ?, numero = ?, bairro = ?, complemento = ? WHERE id_endereco = ?";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
                
                $stmt->bindParam(1, $logradouro);
                $stmt->bindParam(2, $numero);
                $stmt->bindParam(3, $bairro);
                $stmt->bindParam(4, $complemento);
                $stmt->bindParam(5, $idEndereco);
                $atualizar = $stmt->execute();
                if($atualizar){
                    return true;
                }else{
                    return false;
                }
            }else if ( $logradouro == false ){
                return 'Preencha o logradouro!';
            }else if ( ($numero) ){
                return 'Preencha o número!';
            }else if ( ($bairro) ){
                return 'Preencha o bairro!';
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
}
