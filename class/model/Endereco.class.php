<?php
/**
 * Description of Endereco
 *
 * @author roberto
 */
class Endereco {
    private $idEndereco;
    private $logradouro;
    private $numero;
    private $bairro;
    private $complemento;
    private $estado;
    private $cidade;
    
    function __construct($logradouro, $numero, $bairro, $complemento, $estado, $cidade) {
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->complemento = $complemento;
        $this->estado = $estado;
        $this->cidade = $cidade;
    }

    function setIdEndereco($idEndereco) {
        $this->idEndereco = $idEndereco;
    }
    
    function getIdEndereco() {
        return $this->idEndereco;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }
    
    function getLogradouro() {
        return $this->logradouro;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }
    
    function getNumero() {
        return $this->numero;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }
    
    function getBairro() {
        return $this->bairro;
    }
    
    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }
    
    function getComplemento() {
        return $this->complemento;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    
    function getEstado() {
        return $this->estado;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }
    
    function getCidade() {
        return $this->cidade;
    }

}
