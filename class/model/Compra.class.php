<?php
class Compra {
    private $idCompra;
    private $valor;
    private $dataHora;
            
    function __construct($valor) {
        $this->valor = $valor;
    }

    function setIdCompra($idCompra) {
        $this->idCompra = $idCompra;
    }
    
    function getIdCompra() {
        return $this->idCompra;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }
    
    function getValor() {
        return $this->valor;
    }
    
    function setDataHora($dataHora) {
        $this->dataHora = $dataHora;
    }
    
    function getDataHora() {
        return $this->dataHora;
    }
    
}
