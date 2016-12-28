<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/model/Telefone.class.php");
include_once($caminho_base . "/class/model/Endereco.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/ControleVendas/';
//include_once $caminho_base.'class/model/Telefone.class.php';
//include_once $caminho_base.'class/model/Endereco.class.php';
class Cliente{
    private $idCliente;
    private $nome;
    private $email;
    private $telefone;
    private $endereco;
    
    function __construct($nome, $email, Telefone $telefone, Endereco $endereco) {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
    }

    
    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }
    
    function getIdCliente() {
        return $this->idCliente;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
    
    function getNome() {
        return $this->nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }
    
    function getEmail() {
        return $this->email;
    }

    function setTelefone(Telefone $telefone) {
        $this->telefone = $telefone;
    }
    
    function getTelefone() {
        return $this->telefone;
    }

    function setEndereco(Endereco $endereco) {
        $this->endereco = $endereco;
    }
    
    function getEndereco() {
        return $this->endereco;
    }
	
}
?>
