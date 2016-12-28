<?php
$caminho_base = $_SERVER["DOCUMENT_ROOT"];
include_once($caminho_base . "/class/persistencia/Conexao.class.php");
include_once($caminho_base . "/class/model/Recibo.class.php");
/*$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/controlevendas/';
include_once $caminho_base.'class/persistencia/Conexao.class.php';
include_once $caminho_base.'class/model/Recibo.class.php';*/
class ReciboDAO {
    
    private $tabela;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->conectar();
        $this->tabela = 'recibos';
    }
    
    
    public function cadastrarRecibo(Recibo $recibo){
        try{
            $idVenda = $recibo->getIdVenda();
            
            $id = NULL;
            $query = "INSERT INTO $this->tabela VALUES(?, ?)";
            $stmt = $this->conexao->prepare($query); //echo $query; die;
            $stmt->bindParam(1, $id, PDO::PARAM_NULL);
            $stmt->bindParam(2, $idVenda);
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
    
    public function buscarDadosRecibo($idVenda){
        try{
            $query = "SELECT r.id_recibo, v.valor, c.nome 
                      FROM recibos r INNER JOIN vendas v ON r.id_venda_fk = v.id_venda 
                           INNER JOIN clientes c ON v.id_cliente_fk = c.id_cliente
                      WHERE v.id_venda = ?";
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $idVenda);
            $result->execute();
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            
            $recibo = null;
            
            $recibo[0]['id_recibo'] = $linha['id_recibo'];
            $recibo[0]['valor'] = $linha['valor'];
            $recibo[0]['nome_cliente'] = $linha['nome'];
                    
          
            return $recibo;
                    
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
}
