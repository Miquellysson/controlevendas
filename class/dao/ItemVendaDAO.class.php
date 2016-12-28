<?php
$caminho_base = $_SERVER["DOCUMENT_ROOT"];
include_once($caminho_base . "/class/persistencia/Conexao.class.php");
include_once($caminho_base . "/class/model/ItemVenda.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/ControleVendas/';
//include_once $caminho_base.'class/persistencia/Conexao.class.php';
//include_once $caminho_base.'class/model/ItemVenda.class.php';

class ItemVendaDAO {
    private $tabela;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->conectar();
        $this->tabela = 'itens_vendas';
    }
    
    public function cadastrarItemVenda(ItemVenda $itemVenda){
        try{
            $idVenda = $itemVenda->getIdVenda();
            $idProduto = $itemVenda->getIdProduto();
            $quantidade = $itemVenda->getQuantidade();
            $id = NULL;
            
            $query = "INSERT INTO $this->tabela VALUES(?, ?, ?, ?)";
            $stmt = $this->conexao->prepare($query); //echo $query; die;
            $stmt->bindParam(1, $id, PDO::PARAM_NULL);
            $stmt->bindParam(2, $idVenda);
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
    
    public function deletarItemVendaPorId($idItemVenda){
        try{
            $query = "DELETE FROM $this->tabela WHERE id_item_venda = {$idItemVenda}";
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
    
    public function deletarItensVendaPorIdVenda($idVenda){
        try{
            $query = "DELETE FROM $this->tabela WHERE id_venda_fk = {$idVenda}";
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
    
    public function buscaItensVenda($idVenda){
        //echo 'Nome = '.$nome.' e-mail = '.$email;
        try{
            $query = "SELECT * FROM $this->tabela WHERE id_venda_fk = ?";
            
            $stmt->bindParam(1, $idVenda);
            $result = $stmt->execute();
            
            $itensVendas = null;
            if($result){
                $i = 0;
                while($linha = $result->fetch(PDO::FETCH_ASSOC)){
                    $itensVendas[$i]['id_item_venda'] = $linha['id_item_venda'];
                    $itensVendas[$i]['id_venda_fk'] = $linha['id_venda_fk'];
                    $itensVendas[$i]['id_produto_fk'] = $linha['id_produto_fk'];
                    $itensVendas[$i]['quantidade'] = $linha['quantidade'];
                    $i++;
                }
            }
        return $itensVendas;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function buscaItemVendaPorId($idItemVenda){
        try{
            $query = "SELECT * FROM $this->tabela WHERE id_item_venda = ?";
            
            $result = $this->conexao->prepare($query);
            $result->bindParam(1, $idItemVenda );
            $result->execute();
            $itemVenda = null;
            if($result){
                $linha = $result->fetch(PDO::FETCH_ASSOC);
                
                $itemVenda[$i]['id_item_venda'] = $linha['id_item_venda'];
                $itemVenda[$i]['id_venda_fk'] = $linha['id_venda_fk'];
                $itemVenda[$i]['id_produto_fk'] = $linha['id_produto_fk'];
                $itemVenda[$i]['quantidade'] = $linha['quantidade'];
            }
        return $produto;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function alterarItemVenda(ItemVenda $itemVenda){
        try{
            $idItemVenda = $itemVenda->getIdItemVenda();
            $idProduto = $itemVenda->getIdProduto();
            $quantidade = $itemVenda->getQuantidade();
         
            $validaQuantidade = preg_match("/^[0-9]+$/", $quantidade);
            //die;
            if ( $validaQuantidade ){
                $query = "UPDATE $this->tabela SET id_produto_fk = ?, quantidade = ? WHERE id_item_venda = ?";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
               //echo $query;
               //die;
                $stmt->bindParam(1, $idProduto);
                $stmt->bindParam(2, $quantidade);
                $stmt->bindParam(3, $idItemVenda);

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
    
    /*
    //Exemplo de pdo retornando objeto
    public function getAllProdutos(){
        try{
            $query = "SELECT id_produto, descricao, preco_compra, preco_venda, quantidade FROM $this->tabela";
            $result = $this->conexao->prepare($query);
            $result->execute();
            $produtos = null;
            if($result){
                $i = 0;
                while($linha = $result->fetch(PDO::FETCH_OBJ)){
                    $produto = new Produto( utf8_encode($linha->descricao), $linha->preco_compra, $linha->preco_venda, $linha->quantidade);
                    $produto->setIdProduto($linha->id_produto);
                    $produtos[$i] = $produto;
                    $i++;
                }
            }
        return $produtos;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    */
}
