<?php
/**
 * Description of Telefone
 *
 * @author roberto
 */
class Telefone {
    private $idTelefone;
    private $telefoneResidencial;
    private $telefoneCelular;
    
    function __construct($telefoneResidencial, $telefoneCelular) {
        $this->telefoneResidencial = $telefoneResidencial;
        $this->telefoneCelular = $telefoneCelular;
    }
    
    function setIdTelefone($idTelefone) {
        $this->idTelefone = $idTelefone;
    }
    
    function getIdTelefone() {
        return $this->idTelefone;
    }

    function setTelefoneResidencial($telefoneResidencial) {
        $this->telefoneResidencial = $telefoneResidencial;
    }
    
    function getTelefoneResidencial() {
        return $this->telefoneResidencial;
    }

    function setTelefoneCelular($telefoneCelular) {
        $this->telefoneCelular = $telefoneCelular;
    }
    
    function getTelefoneCelular() {
        return $this->telefoneCelular;
    }

}
