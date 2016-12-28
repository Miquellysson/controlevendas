<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/model/Telefone.class.php");
include_once($caminho_base . "/class/model/Endereco.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/ControleVendas/';
//include_once $caminho_base.'class/model/Telefone.class.php';
//include_once $caminho_base.'class/model/Endereco.class.php';
class Funcionario{
    private $idFuncionario;
    private $nome;
    private $email;
    private $salario;
    private $telefone;
    private $endereco;
            
    function __construct($nome, $email, $salario, Telefone $telefone, Endereco $endereco) {
        $this->nome = $nome;
        $this->email = $email;
        $this->salario = $salario;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
    }
    
    function setIdFuncionario($idFuncionario) {
        $this->idFuncionario = $idFuncionario;
    }
    
    function getIdFuncionario() {
        return $this->idFuncionario;
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

    function setSalario($salario) {
        $this->salario = $salario;
    }
    
    function getSalario() {
        return $this->salario;
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
