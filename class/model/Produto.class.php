<?php
class Produto{
    private $idProduto;
    private $descricao;
    private $precoCompra;
    private $precoVenda;
    private $quantidade;
    private $dataCadastro;
            
    function __construct($descricao, $precoCompra, $precoVenda, $quantidade) {
        $this->descricao = $descricao;
        $this->precoCompra = $precoCompra;
        $this->precoVenda = $precoVenda;
        $this->quantidade = $quantidade;
    }

    function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }
    
    function getIdProduto() {
        return $this->idProduto;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    function getDescricao() {
        return $this->descricao;
    }

    function setPrecoCompra($precoCompra) {
        $this->precoCompra = $precoCompra;
    }
    
    function getPrecoCompra() {
        return $this->precoCompra;
    }

    function setPrecoVenda($precoVenda) {
        $this->precoVenda = $precoVenda;
    }
    
    function getPrecoVenda() {
        return $this->precoVenda;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
    
    function getQuantidade() {
        return $this->quantidade;
    }
    
}
?>