<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/model/Venda.class.php");
include_once($caminho_base . "/class/model/Produto.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/ControleVendas/';
//include_once $caminho_base.'class/model/Venda.class.php';
//include_once $caminho_base.'class/model/Produto.class.php';
class ItemVenda {
    private $idItemVenda;
    private $idVenda;
    private $idProduto;
    private $quantidade;
    
    function __construct($idVenda, $idProduto, $quantidade) {
        $this->idVenda = $idVenda;
        $this->idProduto = $idProduto;
        $this->quantidade = $quantidade;
    }

 
    function setIdItemVenda($idItemVenda) {
        $this->idItemVenda = $idItemVenda;
    }

    function getIdItemVenda() {
        return $this->idItemVenda;
    }
    
    function setIdVenda($idVenda) {
        $this->idVenda = $idVenda;
    }
    
    function getIdVenda() {
        return $this->idVenda;
    }
     
    public function setIdProduto($idProduto){
        $this->idProduto = $idProduto;
    }
    
    public function getIdProduto(){
        return $this->idProduto;
    }
    
    public function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
    }
    
    public function getQuantidade(){
        return $this->quantidade;
    }
    
}
