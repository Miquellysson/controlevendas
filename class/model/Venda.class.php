<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/ControleVendas/';
//include_once $caminho_base.'class/model/Cliente.class.php';
//include_once $caminho_base.'class/model/Funcionario.class.php';
class Venda {
    private $idVenda;
    private $valor;
    private $idCliente;
    private $idFuncionario;
    private $dataHora;
            
    function __construct($valor, $idCliente, $idFuncionario) {
        $this->valor = $valor;
        $this->idCliente = $idCliente;
        $this->idFuncionario = $idFuncionario;
    }

    function setIdVenda($idVenda) {
        $this->idVenda = $idVenda;
    }
    
    function getIdVenda() {
        return $this->idVenda;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }
    
    function getValor() {
        return $this->valor;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }
    
    function getIdCliente() {
        return $this->idCliente;
    }

    function setIdFuncionario($idFuncionario) {
        $this->idFuncionario = $idFuncionario;
    }
    
    function getIdFuncionario() {
        return $this->idFuncionario;
    }
    
    function setDataHora($dataHora) {
        $this->dataHora = $dataHora;
    }
    
    function getDataHora() {
        return $this->dataHora;
    }
    
}
