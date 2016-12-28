<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/persistencia/Conexao.class.php");
include_once($caminho_base . "/class/model/Compra.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/controlevendas/';
//include_once $caminho_base.'class/persistencia/Conexao.class.php';
//include_once $caminho_base.'class/model/Compra.class.php';

class CompraDAO {
    private $tabela;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->conectar();
        $this->tabela = 'compras';
    }
    
    public function cadastrarCompra(Compra $compra){
        try{
            $valor = $compra->getValor();
            $id = NULL;
            
            $query = "INSERT INTO $this->tabela VALUES(?, ?, NOW() )";
            $stmt = $this->conexao->prepare($query); //echo $query; die;
            $stmt->bindParam(1, $id, PDO::PARAM_NULL);
            $stmt->bindParam(2, $valor);
            $inserir = $stmt->execute();
            if($inserir){
                return 'Compra cadastrada com sucesso!';
                //return true;
            }else{
                return 'Erro na tentativa de cadastrar compra!';
                //return false;
            }
        }catch(Exception $erro){
            return 'Erro de banco!';
            //echo 'Erro = '.$erro.'<br />';
            //return false;
        }
    }
    
    public function deletarCompraPorId($idCompra){
        try{
            $query = "DELETE FROM $this->tabela WHERE id_compra = {$idCompra}";
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
    //Pensar para buscar por outros parametros
    public function buscaCompras($dataInicio, $dataFim){
        //echo 'Nome = '.$nome.' e-mail = '.$email;
        try{
            $query = "SELECT * FROM $this->tabela";
            if( $dataInicio != '' && $dataFim != '' ){
                $query .= " WHERE data_hora BETWEEN '$dataInicio' AND '$dataFim'";
            }
            //echo $query; die;
            $result = $this->conexao->prepare($query);
            $result->execute();
            
            $compras = null;
            if($result){
                $i = 0;
                while($linha = $result->fetch(PDO::FETCH_ASSOC)){
                    $compras[$i]['id_compra'] = $linha['id_compra'];
                    $compras[$i]['valor'] = $linha['valor'];
                    $compras[$i]['data_hora'] = $linha['data_hora'];
                    $i++;
                }
            }
            return $compras;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function buscaCompraPorId($idCompra){
        try{
            $query = "SELECT * FROM $this->tabela WHERE id_compra = ?";
            
            $result = $this->conexao->prepare($query);
            $result->bindParam(1, $idCompra );
            $result->execute();
            $compra = null;
            if($result){
                $linha = $result->fetch(PDO::FETCH_ASSOC);
                
                $compra[0]['id_compra'] = $linha['id_compra'];
                $compra[0]['valor'] = $linha['valor'];
                $compra[0]['data_hora'] = $linha['data_hora'];
            }
        return $compra;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function buscaIdUltimaCompra(){
        try{
            $query = "SELECT MAX(id_compra) AS id_compra FROM $this->tabela";
            
            $result = $this->conexao->prepare($query);
            $result->execute();
            $idCompra = null;
            if($result){
                $linha = $result->fetch(PDO::FETCH_ASSOC);
                
                $idCompra = $linha['id_compra'];
            }
        return $idCompra;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function alterarCompra(Compra $compra){
        try{
            $idCompra = $compra->getIdCompra();
            $valor = $compra->getValor();
         
            $validaValor = preg_match('/^[0-9]{1,}+([.,][0-9]{1,2})?$/', $valor);
            //die;
            if ( $validaValor ){
                $query = "UPDATE $this->tabela SET valor = ? WHERE id_compra = ?";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
               //echo $query;
               //die;
                $stmt->bindParam(1, $valor);
                $stmt->bindParam(2, $idCompra);

                $atualizar = $stmt->execute();
                if($atualizar){
                    return 'Compra alterada com sucesso!';
                    //return true;
                }else{
                    return 'Erro na tentativa de alterar compra!';
                    //return false;
                }
            }else if ( $validaValor == false ){
                return 'Preencha um valor de compra válido!';
            }
        }catch(Exception $erro){
            return 'Erro de banco!';
            //echo 'Erro = '.$erro.'<br />';
            //return false;
        }
    }
    
}
