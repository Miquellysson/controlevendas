<?php
$caminho_base = $_SERVER["DOCUMENT_ROOT"];
include_once($caminho_base . "/class/persistencia/Conexao.class.php");
include_once($caminho_base . "/class/model/Cliente.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/ControleVendas/';
//include_once $caminho_base.'class/persistencia/Conexao.class.php';
//include_once $caminho_base.'class/model/Cliente.class.php';

class ClienteDAO{
    private $tabela;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados

    public function __construct() {
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->conectar();
        $this->tabela = 'clientes';
    }

    public function cadastrarCliente(Cliente $cliente){
        try{
            $nome = $cliente->getNome();
            $email = $cliente->getEmail();
            $idTelefone = $cliente->getTelefone()->getIdTelefone();
            $idEndereco = $cliente->getEndereco()->getIdEndereco();
            //$validaNome = preg_match("/^[àáãâéêíóõôúüça-zA-Z\s]+$/",$nome);
            $validaEmail = true;
            if( $email != '' ){
                $validaEmail = preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/",$email);
            }
            if ( ($validaEmail) ){
                    $id = NULL;
                    //$dataCadastro = date('Y-m-d H:i:s');
                    $query = "INSERT INTO $this->tabela VALUES(?, ?, ?, ?, ?)";
                    $stmt = $this->conexao->prepare($query); //echo $query; die;
                    $stmt->bindParam(1, $id, PDO::PARAM_NULL);
                    $stmt->bindParam(2, $nome);
                    $stmt->bindParam(3, $email);
                    $stmt->bindParam(4, $idTelefone);
                    $stmt->bindParam(5, $idEndereco);
                    $inserir = $stmt->execute();
                    if($inserir){
                        return 'Cliente cadastrado com sucesso!';
                        //return true;
                    }else{
                        return 'Erro na tentativa de cadastrar cliente!';
                        //return false;
                    }
            //}else if ( $validaNome == false ){
            //        return 'Preencha um nome válido, somentes letras e espaço!';
            }else if ($validaEmail == false){
                    return 'Preencha um e-mail válido!';
            }
        }catch(Exception $erro){
            return 'Erro de banco!';
            //echo 'Erro = '.$erro.'<br />';
            //return false;
        }
    }
    
    public function buscaClientes($nome, $email){
        //echo 'Nome = '.$nome.' e-mail = '.$email;
        try{
            $query = "SELECT c.id_cliente, c.nome, c.email, c.id_telefone_fk, c.id_endereco_fk, t.telefone_residencial, t.telefone_celular,
                             e.logradouro, e.numero, e.bairro, e.complemento, e.estado, e.cidade  
                      FROM clientes AS c
                           INNER JOIN telefones AS t ON c.id_telefone_fk = t.id_telefone
                           INNER JOIN enderecos AS e ON c.id_endereco_fk = e.id_endereco 
                      WHERE c.nome like ? AND c.email like ?";
            $parametros = array( "%$nome%", "%$email%" );
            $result = $this->conexao->prepare($query);
            
            //$result->bindParam(1, "%$nome%" );
            //$result->bindParam(2, "%$email%" );
            $result->execute($parametros);
            $clientes = null;
            if($result){
                $i = 0;
                while($linha = $result->fetch(PDO::FETCH_ASSOC)){
                    //print_r($linha); die;
                    $clientes[$i]['id_cliente'] = $linha['id_cliente'];
                    $clientes[$i]['nome'] = $linha['nome'];
                    $clientes[$i]['email'] = $linha['email'];
                    $clientes[$i]['id_telefone_fk'] = $linha['id_telefone_fk'];
                    $clientes[$i]['id_endereco_fk'] = $linha['id_endereco_fk'];
                    $clientes[$i]['telefone_residencial'] = $linha['telefone_residencial'];
                    $clientes[$i]['telefone_celular'] = $linha['telefone_celular'];
                    $clientes[$i]['logradouro'] = $linha['logradouro'];
                    $clientes[$i]['numero'] = $linha['numero'];
                    $clientes[$i]['bairro'] = $linha['bairro'];
                    $clientes[$i]['complemento'] = $linha['complemento'];
                    //$clientes[$i]['estado'] = $linha['estado'];
                    //$clientes[$i]['cidade'] = $linha['cidade'];
                    $i++;
                }
            }
        return $clientes;
        }catch(Exception $erro){
            //echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function deletarClientePorId($idCliente){
        try{
            $query = "DELETE FROM $this->tabela WHERE id_cliente = {$idCliente}";
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
            //echo $e->getMessage();
            //echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
    public function buscaClientePorId($idCliente){
        try{
            $query = "SELECT c.id_cliente, c.nome, c.email, c.id_telefone_fk, c.id_endereco_fk, t.telefone_residencial, t.telefone_celular,
                             e.logradouro, e.numero, e.bairro, e.complemento, e.estado, e.cidade  
                      FROM clientes AS c
                           INNER JOIN telefones AS t ON c.id_telefone_fk = t.id_telefone
                           INNER JOIN enderecos AS e ON c.id_endereco_fk = e.id_endereco 
                      WHERE c.id_cliente = ?";
            
            $result = $this->conexao->prepare($query);
            $result->bindParam(1, $idCliente );
            $result->execute();
            $cliente = null;
            if($result){
                $linha = $result->fetch(PDO::FETCH_ASSOC);
                
                $cliente[0]['id_cliente'] = $linha['id_cliente'];
                $cliente[0]['nome'] = $linha['nome'];
                $cliente[0]['email'] = $linha['email'];
                $cliente[0]['id_telefone_fk'] = $linha['id_telefone_fk'];
                $cliente[0]['id_endereco_fk'] = $linha['id_endereco_fk'];
                $cliente[0]['telefone_residencial'] = $linha['telefone_residencial'];
                $cliente[0]['telefone_celular'] = $linha['telefone_celular'];
                $cliente[0]['logradouro'] = $linha['logradouro'];
                $cliente[0]['numero'] = $linha['numero'];
                $cliente[0]['bairro'] = $linha['bairro'];
                $cliente[0]['complemento'] = $linha['complemento'];
                //$cliente[0]['estado'] = $linha['estado'];
                //$cliente[0]['cidade'] = $linha['cidade'];
                    
            }
        return $cliente;
        }catch(Exception $erro){
            //echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function alterarCliente(Cliente $cliente){
        try{
            $idCliente = $cliente->getIdCliente();
            $nome = $cliente->getNome();
            $email = $cliente->getEmail();
            //$validaNome = preg_match("/^[àáãâéêíóõôúüça-zA-Z\s]+$/",$nome);
            $validaEmail = true;
            if( $email != '' ){
                $validaEmail = preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/",$email);
            }
            if ( ($validaEmail) ){
                    $nome = utf8_decode($nome);
                    //echo 'Ok<br><br>';
                    //$dataCadastro = date('Y-m-d H:i:s');
                    $query = "UPDATE $this->tabela SET nome = ?, email = ? WHERE id_cliente = ?";
                    $stmt = $this->conexao->prepare($query); //echo $query; die;
                   //echo $query;
                   //die;
                    $stmt->bindParam(1, $nome);
                    $stmt->bindParam(2, $email);
                    $stmt->bindParam(3, $idCliente);
                    
                    $atualizar = $stmt->execute();
                    if($atualizar){
                        return 'Cliente alterado com sucesso!';
                        //return true;
                    }else{
                        return 'Erro na tentativa de alterar cliente!';
                        //return false;
                    }
            //}else if ( $validaNome == false ){
            //        return 'Preencha um nome válido, somentes letras e espaço!';
            }else if ( $validaEmail == false ){
                    return 'Preencha um e-mail válido!';
            }
        }catch(Exception $erro){
            return 'Erro de banco!';
            //echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }

    public function getAllClientes(){
        try{
            $query = "SELECT c.id_cliente, c.nome, c.email, c.id_telefone_fk, c.id_endereco_fk, t.telefone_residencial, t.telefone_celular,
                             e.logradouro, e.numero, e.bairro, e.complemento, e.estado, e.cidade  
                      FROM clientes AS c
                           INNER JOIN telefones AS t ON c.id_telefone_fk = t.id_telefone
                           INNER JOIN enderecos AS e ON c.id_endereco_fk = e.id_endereco";
            $result = $this->conexao->prepare($query);
            $result->execute();
            $clientes = null;
            if($result){
                $i = 0;
                while($linha = $result->fetch(PDO::FETCH_OBJ)){
                    $telefone = new Telefone($linha->telefone_residencial, $linha->telefone_celular);
                    $endereco = new Endereco( utf8_encode( $linha->logradouro ), $linha->numero, utf8_encode( $linha->bairro), utf8_encode( $linha->complemento), $linha->estado, $linha->cidade);
                    $cliente = new Cliente( utf8_encode( $linha->nome), $linha->email, $telefone, $endereco);
                    $cliente->setIdCliente($linha->id_cliente);
                    $clientes[$i] = $cliente;
                    $i++;
                }
            }
        return $clientes;
        }catch(Exception $erro){
            //echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
}
?>
