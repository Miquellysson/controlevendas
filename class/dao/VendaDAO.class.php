<?php
$caminho_base = $_SERVER["DOCUMENT_ROOT"];
include_once($caminho_base . "/class/persistencia/Conexao.class.php");
include_once($caminho_base . "/class/model/Venda.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/ControleVendas/';
//include_once $caminho_base.'class/persistencia/Conexao.class.php';
//include_once $caminho_base.'class/model/Venda.class.php';

class VendaDAO {
    private $tabela;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->conectar();
        $this->tabela = 'vendas';
    }
    
    public function cadastrarVenda(Venda $venda){
        try{
            $valor = $venda->getValor();
            $idCliente = $venda->getIdCliente();
            $idFuncionario = $venda->getIdFuncionario();
            $id = NULL;
            
            $query = "INSERT INTO $this->tabela VALUES(?, ?, ?, ?, NOW() )";
            $stmt = $this->conexao->prepare($query); //echo $query; die;
            $stmt->bindParam(1, $id, PDO::PARAM_NULL);
            $stmt->bindParam(2, $valor);
            $stmt->bindParam(3, $idCliente);
            $stmt->bindParam(4, $idFuncionario);
            $inserir = $stmt->execute();
            if($inserir){
                return 'Venda cadastrada com sucesso!';
                //return true;
            }else{
                return 'Erro na tentativa de cadastrar venda!';
                //return false;
            }
        }catch(Exception $erro){
            return 'Erro de banco!';
            //echo 'Erro = '.$erro.'<br />';
            //return false;
        }
    }
    
    public function deletarVendaPorId($idVenda){
        try{
            $query = "DELETE FROM $this->tabela WHERE id_venda = {$idVenda}";
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
    //Pensar para buscar por outros parametros
    public function buscaVendas($idCliente, $idFuncionario, $dataInicio, $dataFim){
        //echo 'Nome = '.$nome.' e-mail = '.$email;
        try{
            $query = "SELECT v.id_venda, v.valor, v.data_hora, c.nome AS nome_cliente, f.nome AS nome_funcionario "
                    . "FROM vendas v INNER JOIN clientes c ON v.id_cliente_fk = c.id_cliente "
                    . "INNER JOIN funcionarios f ON v.id_funcionario_fk = f.id_funcionario WHERE c.id_cliente IS NOT NULL";
            if( $idCliente != '' ){
                $query .= " AND c.id_cliente = $idCliente";
            }
            if( $idFuncionario != '' ){
                $query .= " AND f.id_funcionario = $idFuncionario";
            }
            if( $dataInicio != '' && $dataFim != '' ){
                $query .= " AND v.data_hora BETWEEN '$dataInicio' AND '$dataFim'";
            }
            //echo $query; die;
            $result = $this->conexao->prepare($query);
            $result->execute();
            
            $vendas = null;
            if($result){
                $i = 0;
                while($linha = $result->fetch(PDO::FETCH_ASSOC)){
                    $vendas[$i]['id_venda'] = $linha['id_venda'];
                    $vendas[$i]['valor'] = $linha['valor'];
                    $vendas[$i]['data_hora'] = $linha['data_hora'];
                    $vendas[$i]['nome_cliente'] = $linha['nome_cliente'];
                    $vendas[$i]['nome_funcionario'] = $linha['nome_funcionario'];
                    $i++;
                }
            }
            return $vendas;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function buscaVendaPorId($idVenda){
        try{
            $query = "SELECT * FROM $this->tabela WHERE id_venda = ?";
            
            $result = $this->conexao->prepare($query);
            $result->bindParam(1, $idVenda );
            $result->execute();
            $venda = null;
            if($result){
                $linha = $result->fetch(PDO::FETCH_ASSOC);
                
                $venda[0]['id_venda'] = $linha['id_venda'];
                $venda[0]['valor'] = $linha['valor'];
                $venda[0]['id_cliente_fk'] = $linha['id_cliente_fk'];
                $venda[0]['id_funcionario_fk'] = $linha['id_funcionario_fk'];
                $venda[0]['data_hora'] = $linha['data_hora'];
            }
        return $venda;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function buscaIdUltimaVenda(){
        try{
            $query = "SELECT MAX(id_venda) AS id_venda FROM $this->tabela";
            
            $result = $this->conexao->prepare($query);
            $result->execute();
            $idVenda = null;
            if($result){
                $linha = $result->fetch(PDO::FETCH_ASSOC);
                
                $idVenda = $linha['id_venda'];
            }
        return $idVenda;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function alterarVenda(Venda $venda){
        try{
            $idVenda = $venda->getIdVenda();
            $valor = $venda->getValor();
         
            $validaValor = preg_match('/^[0-9]{1,}+([.,][0-9]{1,2})?$/', $valor);
            
            //die;
            if ( $validaValor ){
                $query = "UPDATE $this->tabela SET valor = ? WHERE id_venda = ?";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
               //echo $query;
               //die;
                $stmt->bindParam(1, $valor);
                $stmt->bindParam(2, $idVenda);

                $atualizar = $stmt->execute();
                if($atualizar){
                    return 'Venda alterada com sucesso!';
                    //return true;
                }else{
                    return 'Erro na tentativa de alterar venda!';
                    //return false;
                }
            }else if ( $validaValor == false ){
                return 'Preencha um valor de venda válido!';
            }
        }catch(Exception $erro){
            return 'Erro de banco!';
            //echo 'Erro = '.$erro.'<br />';
            //return false;
        }
    }
    
    /*
    //Exemplo de pdo trazendo objeto
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