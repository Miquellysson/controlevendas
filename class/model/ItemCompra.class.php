<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/model/Compra.class.php");
include_once($caminho_base . "/class/model/Produto.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/controlevendas/';
//include_once $caminho_base.'class/model/Compra.class.php';
//include_once $caminho_base.'class/model/Produto.class.php';
class ItemCompra {
    private $idItemCompra;
    private $idCompra;
    private $idProduto;
    private $quantidade;
    
    function __construct($idCompra, $idProduto, $quantidade) {
        $this->idCompra = $idCompra;
        $this->idProduto = $idProduto;
        $this->quantidade = $quantidade;
    }

    function setIdItemCompra($idItemCompra) {
        $this->idItemCompra = $idItemCompra;
    }

    function getIdItemCompra() {
        return $this->idItemCompra;
    }
    
    function setIdCompra($idCompra) {
        $this->idCompra = $idCompra;
    }
    
    function getIdCompra() {
        return $this->idCompra;
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
