<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/persistencia/Conexao.class.php");
include_once($caminho_base . "/class/model/ItemCompra.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/controlevendas/';
//include_once $caminho_base.'class/persistencia/Conexao.class.php';
//include_once $caminho_base.'class/model/ItemCompra.class.php';

class ItemCompraDAO {
    private $tabela;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->conectar();
        $this->tabela = 'itens_compras';
    }
    
    public function cadastrarItemCompra(ItemCompra $itemCompra){
        try{
            $idCompra = $itemCompra->getIdCompra();
            $idProduto = $itemCompra->getIdProduto();
            $quantidade = $itemCompra->getQuantidade();
            $id = NULL;
            
            $query = "INSERT INTO $this->tabela VALUES(?, ?, ?, ?)";
            $stmt = $this->conexao->prepare($query); //echo $query; die;
            $stmt->bindParam(1, $id, PDO::PARAM_NULL);
            $stmt->bindParam(2, $idCompra);
            $stmt->bindParam(3, $idProduto);
            $stmt->bindParam(4, $quantidade);
            $inserir = $stmt->execute();
            if($inserir){
                return true;
            }else{
                return false;
            }
            
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
    public function deletarItemCompraPorId($idItemCompra){
        try{
            $query = "DELETE FROM $this->tabela WHERE id_item_compra = {$idItemCompra}";
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
            echo 'Erro = '.$e.'<br />';
            return false;
        }
    }
    
    public function deletarItensCompraPorIdCompra($idCompra){
        try{
            $query = "DELETE FROM $this->tabela WHERE id_compra_fk = {$idCompra}";
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
            echo 'Erro = '.$e.'<br />';
            return false;
        }
    }
    
    public function buscaItensCompra($idCompra){
        //echo 'Nome = '.$nome.' e-mail = '.$email;
        try{
            $query = "SELECT * FROM $this->tabela WHERE id_compra_fk = ?";
            
            $stmt->bindParam(1, $idCompra);
            $result = $stmt->execute();
            
            $itensCompras = null;
            if($result){
                $i = 0;
                while($linha = $result->fetch(PDO::FETCH_ASSOC)){
                    $itensCompras[$i]['id_item_compra'] = $linha['id_item_compra'];
                    $itensCompras[$i]['id_compra_fk'] = $linha['id_compra_fk'];
                    $itensCompras[$i]['id_produto_fk'] = $linha['id_produto_fk'];
                    $itensCompras[$i]['quantidade'] = $linha['quantidade'];
                    $i++;
                }
            }
        return $itensCompras;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function buscaItemCompraPorId($idItemCompra){
        try{
            $query = "SELECT * FROM $this->tabela WHERE id_item_compra = ?";
            
            $result = $this->conexao->prepare($query);
            $result->bindParam(1, $idItemCompra );
            $result->execute();
            $itemCompra = null;
            if($result){
                $linha = $result->fetch(PDO::FETCH_ASSOC);
                
                $itemCompra[$i]['id_item_compra'] = $linha['id_item_compra'];
                $itemCompra[$i]['id_compra_fk'] = $linha['id_compra_fk'];
                $itemCompra[$i]['id_produto_fk'] = $linha['id_produto_fk'];
                $itemCompra[$i]['quantidade'] = $linha['quantidade'];
            }
        return $itemCompra;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function alterarItemCompra(ItemCompra $itemCompra){
        try{
            $idItemCompra = $itemCompra->getIdItemCompra();
            $idProduto = $itemCompra->getIdProduto();
            $quantidade = $itemCompra->getQuantidade();
         
            $validaQuantidade = preg_match("/^[0-9]+$/", $quantidade);
            //die;
            if ( $validaQuantidade ){
                $query = "UPDATE $this->tabela SET id_produto_fk = ?, quantidade = ? WHERE id_item_compra = ?";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
               //echo $query;
               //die;
                $stmt->bindParam(1, $idProduto);
                $stmt->bindParam(2, $quantidade);
                $stmt->bindParam(3, $idItemCompra);

                $atualizar = $stmt->execute();
                if($atualizar){
                    return true;
                }else{
                    return false;
                }
            }else if ( $validaQuantidade == false ){
                return 'Preencha uma quantidade válida!';
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
}
