<?php
$caminho_base = $_SERVER["DOCUMENT_ROOT"];
include_once($caminho_base . "/class/persistencia/Conexao.class.php");
include_once($caminho_base . "/class/model/Telefone.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/ControleVendas/';
//include_once $caminho_base.'class/persistencia/Conexao.class.php';
//include_once $caminho_base.'class/model/Telefone.class.php';
class TelefoneDAO {
    private $tabela;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->conectar();
        $this->tabela = 'telefones';
    }
    
    public function cadastrarTelefone(Telefone $telefone){
        try{
            $telefoneResidencial = $telefone->getTelefoneResidencial();
            $telefoneCelular = $telefone->getTelefoneCelular();
            
            //if ( ($validaUsuario) && ($validaEmail) && ($email !='') && (!empty($empresa)) ){
                    //$query="INSERT INTO $this->tabela VALUES(NULL,'".$usuario."', '".$senha."',
                    //    '".$email."','".$vinculo."','".$privilegio."','".$empresa."','S','".date('Y-m-d H:i:s')."')";
                    $id = NULL;
                    //$dataCadastro = date('Y-m-d H:i:s');
                    $query = "INSERT INTO $this->tabela VALUES(?, ?, ?)";
                    $stmt = $this->conexao->prepare($query); //echo $query; die;
                    $stmt->bindParam(1, $id, PDO::PARAM_NULL);
                    $stmt->bindParam(2, $telefoneResidencial);
                    $stmt->bindParam(3, $telefoneCelular);
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
    
    public function buscarMaximoIdTelefone(){
        try{
            $query = "SELECT MAX(id_telefone) AS id_telefone FROM $this->tabela";
            $result = $this->conexao->prepare($query);            
            //$result->bindParam(1, $usuario);
            $result->execute();
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            $idTelefone = $linha['id_telefone'];
            if( $idTelefone > 0 ){
                return $idTelefone;
            }    
            return false;
                    
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function deletarTelefonePorId($idTelefone){
        try{
            $query = "DELETE FROM $this->tabela WHERE id_telefone = {$idTelefone}";
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
   
    public function alterarTelefone(Telefone $telefone){
        try{
            $idTelefone = $telefone->getIdTelefone();
            $telefoneResidencial = $telefone->getTelefoneResidencial();
            $telefoneCelular = $telefone->getTelefoneCelular();
            $validarTelRes = true;
            $validarTelCel = true;
            if( $telefoneResidencial != '' ){
                $validarTelRes = preg_match( "/^[0-9]{10}+$/", $telefoneResidencial );
            }
            if( $telefoneCelular != '' ){
                $validarTelCel = preg_match( "/^[0-9]{11}+$/", $telefoneCelular );
            }
            //print_r($endereco); die;
            if ( ($validarTelRes) && ($validarTelCel) ){
                $query = "UPDATE $this->tabela SET telefone_residencial = ?, telefone_celular = ? WHERE id_telefone = ?";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
                
                $stmt->bindParam(1, $telefoneResidencial);
                $stmt->bindParam(2, $telefoneCelular);
                $stmt->bindParam(3, $idTelefone);
                
                $atualizar = $stmt->execute();
                if($atualizar){
                    return true;
                }else{
                    return false;
                }
            }else if ( $validarTelRes == false ){
                return 'Preencha um telefone residencial válido!';
            }else if ( ($validarTelCel) ){
                return 'Preencha um telefone celular válido!';
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
}
