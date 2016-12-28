<?php
$caminho_base = $_SERVER["DOCUMENT_ROOT"];
include_once($caminho_base . "/class/persistencia/Conexao.class.php");
include_once($caminho_base . "/class/model/Funcionario.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/ControleVendas/';
//include_once $caminho_base.'class/persistencia/Conexao.class.php';
//include_once $caminho_base.'class/model/Funcionario.class.php';

class FuncionarioDAO{
    private $tabela;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados

    public function __construct() {
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->conectar();
        $this->tabela = 'funcionarios';
    }

    public function cadastrarFuncionario(Funcionario $funcionario){
        try{
            $nome = $funcionario->getNome();
            $email = $funcionario->getEmail();
            $salario = $funcionario->getSalario();
            $idTelefone = $funcionario->getTelefone()->getIdTelefone();
            $idEndereco = $funcionario->getEndereco()->getIdEndereco();
            //$validaNome = preg_match("/^[àáãâéêíóõôúüça-zA-Z\s]+$/",$nome);
            //$validaNome = preg_match("/^[a-zA-ZãÃáÁàÀêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇºª ]+$/",$nome);
            $validaEmail = true;
            if( $email != '' ){
                $validaEmail = preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/",$email);
            }
            
            if ( ($validaEmail) ){
                $id = NULL;
                //$dataCadastro = date('Y-m-d H:i:s');
                $query = "INSERT INTO $this->tabela VALUES(?, ?, ?, ?, ?, ?)";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
                $stmt->bindParam(1, $id, PDO::PARAM_NULL);
                $stmt->bindParam(2, $nome);
                $stmt->bindParam(3, $email);
                $stmt->bindParam(4, $salario);
                $stmt->bindParam(5, $idTelefone);
                $stmt->bindParam(6, $idEndereco);
                $inserir = $stmt->execute();
                if($inserir){
                    return 'Funcionário cadastrado com sucesso!';
                    //return true;
                }else{
                    return 'Erro na tentativa de cadastrar funcionário!';
                    //return false;
                }
            //}else if ( $validaNome == false ){
            //        return 'Preencha um nome válido, somentes letras e espaço!';
            }else if ($validaEmail == false){
                    return 'Preencha um e-mail válido!';
            }
        }catch(Exception $erro){
            //echo 'Erro = '.$erro.'<br />';
            return 'Erro de banco!';
            //return false;
        }
    }

    public function deletarFuncionarioPorId($idFuncionario){
        try{
            $query = "DELETE FROM $this->tabela WHERE id_funcionario = {$idFuncionario}";
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
    
    public function buscaFuncionarios($nome, $email){
        //echo 'Nome = '.$nome.' e-mail = '.$email;
        try{
            $query = "SELECT f.id_funcionario, f.nome, f.email, f.salario, f.id_telefone_fk, f.id_endereco_fk, t.telefone_residencial, t.telefone_celular,
                             e.logradouro, e.numero, e.bairro, e.complemento, e.estado, e.cidade  
                      FROM funcionarios AS f
                           INNER JOIN telefones AS t ON f.id_telefone_fk = t.id_telefone
                           INNER JOIN enderecos AS e ON f.id_endereco_fk = e.id_endereco 
                      WHERE f.nome like ? AND f.email like ?";
            $parametros = array( "%$nome%", "%$email%" );
            $result = $this->conexao->prepare($query);
            
            $result->execute($parametros);
            $funcionarios = null;
            if($result){
                $i = 0;
                while($linha = $result->fetch(PDO::FETCH_ASSOC)){
                    //print_r($linha); die;
                    $funcionarios[$i]['id_funcionario'] = $linha['id_funcionario'];
                    $funcionarios[$i]['nome'] = $linha['nome'];
                    $funcionarios[$i]['email'] = $linha['email'];
                    $funcionarios[$i]['salario'] = $linha['salario'];
                    $funcionarios[$i]['id_telefone_fk'] = $linha['id_telefone_fk'];
                    $funcionarios[$i]['id_endereco_fk'] = $linha['id_endereco_fk'];
                    $funcionarios[$i]['telefone_residencial'] = $linha['telefone_residencial'];
                    $funcionarios[$i]['telefone_celular'] = $linha['telefone_celular'];
                    $funcionarios[$i]['logradouro'] = $linha['logradouro'];
                    $funcionarios[$i]['numero'] = $linha['numero'];
                    $funcionarios[$i]['bairro'] = $linha['bairro'];
                    $funcionarios[$i]['complemento'] = $linha['complemento'];
                    //$clientes[$i]['estado'] = $linha['estado'];
                    //$clientes[$i]['cidade'] = $linha['cidade'];
                    $i++;
                }
            }
        return $funcionarios;
        }catch(Exception $erro){
            //echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function buscaFuncionarioPorId($idFuncionario){
        try{
            $query = "SELECT f.id_funcionario, f.nome, f.email, f.salario, f.id_telefone_fk, f.id_endereco_fk, t.telefone_residencial, t.telefone_celular,
                             e.logradouro, e.numero, e.bairro, e.complemento, e.estado, e.cidade  
                      FROM funcionarios AS f
                           INNER JOIN telefones AS t ON f.id_telefone_fk = t.id_telefone
                           INNER JOIN enderecos AS e ON f.id_endereco_fk = e.id_endereco 
                      WHERE f.id_funcionario = ?";
            
            $result = $this->conexao->prepare($query);
            $result->bindParam(1, $idFuncionario );
            $result->execute();
            $funcionario = null;
            if($result){
                $linha = $result->fetch(PDO::FETCH_ASSOC);
                
                $funcionario[0]['id_funcionario'] = $linha['id_funcionario'];
                $funcionario[0]['nome'] = $linha['nome'];
                $funcionario[0]['email'] = $linha['email'];
                $funcionario[0]['salario'] = $linha['salario'];
                $funcionario[0]['id_telefone_fk'] = $linha['id_telefone_fk'];
                $funcionario[0]['id_endereco_fk'] = $linha['id_endereco_fk'];
                $funcionario[0]['telefone_residencial'] = $linha['telefone_residencial'];
                $funcionario[0]['telefone_celular'] = $linha['telefone_celular'];
                $funcionario[0]['logradouro'] = $linha['logradouro'];
                $funcionario[0]['numero'] = $linha['numero'];
                $funcionario[0]['bairro'] = $linha['bairro'];
                $funcionario[0]['complemento'] = $linha['complemento'];
                //$funcionario[0]['estado'] = $linha['estado'];
                //$funcionario[0]['cidade'] = $linha['cidade'];
            }
        return $funcionario;
        }catch(Exception $erro){
            //echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function alterarFuncionario(Funcionario $funcionario){
        try{
            $idFuncionario = $funcionario->getIdFuncionario();
            $nome = $funcionario->getNome();
            $email = $funcionario->getEmail();
            $salario = str_replace(',', '.', $funcionario->getSalario() );
            //$validaNome = preg_match("/^[àáãâéêíóõôúüça-zA-Z\s]+$/",$nome);
            $validaEmail = true;
            if( $email != '' ){
                $validaEmail = preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/",$email);
            }
            
            if ( ($validaEmail) ){
                $nome = utf8_decode($nome);
                //echo 'Ok<br><br>';
                //$dataCadastro = date('Y-m-d H:i:s');
                $query = "UPDATE $this->tabela SET nome = ?, email = ?, salario = ? WHERE id_funcionario = ?";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
               //echo $query;
               //die;
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $email);
                $stmt->bindParam(3, $salario);
                $stmt->bindParam(4, $idFuncionario);

                $atualizar = $stmt->execute();
                if($atualizar){
                    return 'Funcionário alterado com sucesso!';
                    //return true;
                }else{
                    return 'Erro na tentativa de alterar funcionário!';
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
    
    public function getAllFuncionarios(){
        try{
            $query = "SELECT f.id_funcionario, f.nome, f.email, f.salario, f.id_telefone_fk, f.id_endereco_fk, t.telefone_residencial, t.telefone_celular,
                             e.logradouro, e.numero, e.bairro, e.complemento, e.estado, e.cidade  
                      FROM funcionarios AS f
                           INNER JOIN telefones AS t ON f.id_telefone_fk = t.id_telefone
                           INNER JOIN enderecos AS e ON f.id_endereco_fk = e.id_endereco";
            $result = $this->conexao->prepare($query);
            $result->execute();
            $funcionarios = null;
            if($result){
                $i = 0;
                while($linha = $result->fetch(PDO::FETCH_OBJ)){
                    $telefone = new Telefone($linha->telefone_residencial, $linha->telefone_celular);
                    $endereco = new Endereco( utf8_encode( $linha->logradouro ), $linha->numero, utf8_encode( $linha->bairro), utf8_encode( $linha->complemento), $linha->estado, $linha->cidade);
                    $funcionario = new Funcionario(utf8_encode( $linha->nome), $linha->email, $linha->salario, $telefone, $endereco);
                    $funcionario->setIdFuncionario($linha->id_funcionario);
                    $funcionarios[$i] = $funcionario;
                    $i++;
                }
            }
        return $funcionarios;
        }catch(Exception $erro){
            //echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
}
?>