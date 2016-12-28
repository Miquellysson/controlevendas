<?php
class Usuario{
    private $idUsuario;
    private $login;
    private $senha;
    
    function __construct($login, $senha) {
        $this->login = $login;
        $this->senha = $senha;
    }
    
    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function setLogin($login) {
        $this->login = $login;
    }
    
    function getLogin() {
        return $this->login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }
    
    function getSenha() {
        return $this->senha;
    }

}
?>

