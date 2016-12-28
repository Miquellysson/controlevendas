<?php

class Recibo {
    private $idRecibo;
    private $idVenda;
    
    function __construct($idVenda) {
        $this->idVenda = $idVenda;
    }
    
    function setIdRecibo($idRecibo) {
        $this->idRecibo = $idRecibo;
    }
    
    function getIdRecibo() {
        return $this->idRecibo;
    }

    function setIdVenda($idVenda) {
        $this->idVenda = $idVenda;
    }
    
    function getIdVenda() {
        return $this->idVenda;
    }

}
