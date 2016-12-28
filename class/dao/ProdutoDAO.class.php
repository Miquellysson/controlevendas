<?php
$caminho_base = $_SERVER["DOCUMENT_ROOT"];
include_once($caminho_base . "/class/persistencia/Conexao.class.php");
include_once($caminho_base . "/class/model/Produto.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/ControleVendas/';
//include_once $caminho_base.'class/persistencia/Conexao.class.php';
//include_once $caminho_base.'class/model/Produto.class.php';

class ProdutoDAO {
    private $tabela;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->conectar();
        $this->tabela = 'produtos';
    }
    
    public function cadastrarProduto(Produto $produto){
        try{
            $descricao = $produto->getDescricao();
            $precoCompra = $produto->getPrecoCompra();
            $precoVenda = $produto->getPrecoVenda();
            $quantidade = $produto->getQuantidade();
            $dataCadastro = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s'))-18000 );
            $id = NULL;
            
            $validaPrecoCompra = preg_match('/^[0-9]{1,}+([.,][0-9]{1,2})?$/', $precoCompra);
            $validaPrecoVenda = preg_match('/^[0-9]{1,}+([.,][0-9]{1,2})?$/', $precoVenda);
            //$validaQuantidade = preg_match("/^[0-9]+$/", $quantidade);
            //die;
            if ( $validaPrecoCompra && $validaPrecoVenda ){
                $query = "INSERT INTO $this->tabela VALUES(?, ?, ?, ?, ?, ?)";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
                $stmt->bindParam(1, $id, PDO::PARAM_NULL);
                $stmt->bindParam(2, $descricao);
                $stmt->bindParam(3, $precoCompra);
                $stmt->bindParam(4, $precoVenda);
                $stmt->bindParam(5, $quantidade);
                $stmt->bindParam(6, $dataCadastro);
                $inserir = $stmt->execute();
                if($inserir){
                    return 'Produto cadastrado com sucesso!';
                    //return true;
                }else{
                    return 'Erro na tentativa de cadastrar produto!';
                    //return false;
                }
            }else if ( $validaPrecoCompra == false ){
                return 'Preencha um preço de compra válido!';
            }else if ( $validaPrecoVenda == false ){
                return 'Preencha um preço de venda válido!';
            }//else if ( $validaQuantidade == false ){
            //    return 'Preencha uma quantidade válida!';
            //}
        }catch(Exception $erro){
            return 'Erro de banco!';
            //echo 'Erro = '.$erro.'<br />';
            //return false;
        }
    }
    
    public function deletarProdutoPorId($idProduto){
        try{
            $query = "DELETE FROM $this->tabela WHERE id_produto = {$idProduto}";
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
    
    public function buscaProdutos($descricao){
        //echo 'Nome = '.$nome.' e-mail = '.$email;
        try{
            $query = "SELECT * FROM $this->tabela WHERE descricao like ?";
            $parametro = array( "%$descricao%");
            $result = $this->conexao->prepare($query);
            
            $result->execute($parametro);
            $produtos = null;
            if($result){
                $i = 0;
                while($linha = $result->fetch(PDO::FETCH_ASSOC)){
                    $produtos[$i]['id_produto'] = $linha['id_produto'];
                    $produtos[$i]['descricao'] = $linha['descricao'];
                    $produtos[$i]['preco_compra'] = $linha['preco_compra'];
                    $produtos[$i]['preco_venda'] = $linha['preco_venda'];
                    $produtos[$i]['quantidade'] = $linha['quantidade'];
                    $produtos[$i]['data_cadastro'] = $linha['data_cadastro'];
                    $i++;
                }
            }
        return $produtos;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function buscaProdutoPorId($idProduto){
        try{
            $query = "SELECT * FROM $this->tabela WHERE id_produto = ?";
            
            $result = $this->conexao->prepare($query);
            $result->bindParam(1, $idProduto );
            $result->execute();
            $produto = null;
            if($result){
                $linha = $result->fetch(PDO::FETCH_ASSOC);
                
                $produto[0]['id_produto'] = $linha['id_produto'];
                $produto[0]['descricao'] = $linha['descricao'];
                $produto[0]['preco_compra'] = $linha['preco_compra'];
                $produto[0]['preco_venda'] = $linha['preco_venda'];
                $produto[0]['quantidade'] = $linha['quantidade'];
                $produto[0]['data_cadastro'] = $linha['data_cadastro'];
            }
        return $produto;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function alterarProduto(Produto $produto){
        try{
            $idProduto = $produto->getIdProduto();
            $descricao = $produto->getDescricao();
            $precoCompra = $produto->getPrecoCompra();
            $precoVenda = $produto->getPrecoVenda();
            $quantidade = $produto->getQuantidade();
         
            $validaPrecoCompra = preg_match('/^[0-9]{1,}+([.,][0-9]{1,2})?$/', $precoCompra);
            $validaPrecoVenda = preg_match('/^[0-9]{1,}+([.,][0-9]{1,2})?$/', $precoVenda);
            //$validaQuantidade = preg_match("/^[0-9]+$/", $quantidade);
            //die;
            if ( $validaPrecoCompra && $validaPrecoVenda ){
                $query = "UPDATE $this->tabela SET descricao = ?, preco_compra = ?, preco_venda = ?, quantidade = ? WHERE id_produto = ?";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
               //echo $query;
               //die;
                $stmt->bindParam(1, $descricao);
                $stmt->bindParam(2, $precoCompra);
                $stmt->bindParam(3, $precoVenda);
                $stmt->bindParam(4, $quantidade);
                $stmt->bindParam(5, $idProduto);

                $atualizar = $stmt->execute();
                if($atualizar){
                return 'Produto alterado com sucesso!';
                //return true;
                }else{
                    return 'Erro na tentativa de alterar produto!';
                    //return false;
                }
            }else if ( $validaPrecoCompra == false ){
                return 'Preencha um preço de compra válido!';
            }else if ( $validaPrecoVenda == false ){
                return 'Preencha um preço de venda válido!';
            }//else if ( $validaQuantidade == false ){
            //    return 'Preencha uma quantidade válida!';
            //}
        }catch(Exception $erro){
            return 'Erro de banco!';
            //echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
    public function compraEstoque($idProduto, $quantidade){
        try{
            $validaQuantidade = preg_match("/^[0-9]+$/", $quantidade);
            //die;
            if ( $validaQuantidade ){
                $query = "UPDATE $this->tabela SET quantidade = quantidade+? WHERE id_produto = ?";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
               //echo $query;
               //die;
                $stmt->bindParam(1, $quantidade);
                $stmt->bindParam(2, $idProduto);

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
    
    public function alterarEstoque($idProduto, $quantidade){
        try{
            $validaQuantidade = preg_match("/^[0-9]+$/", $quantidade);
            //die;
            if ( $validaQuantidade ){
                $query = "UPDATE $this->tabela SET quantidade = quantidade-? WHERE id_produto = ?";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
               //echo $query;
               //die;
                $stmt->bindParam(1, $quantidade);
                $stmt->bindParam(2, $idProduto);

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
    
}