<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/dao/EnderecoDAO.class.php");
include_once($caminho_base . "/class/dao/TelefoneDAO.class.php");
include_once($caminho_base . "/class/dao/FuncionarioDAO.class.php");
//include_once '../../class/dao/EnderecoDAO.class.php';
//include_once '../../class/dao/TelefoneDAO.class.php';
//include_once '../../class/dao/FuncionarioDAO.class.php';
session_start();

$idFuncionario = $_GET['id_funcionario'];
$idTelefone = $_GET['id_telefone'];
$idEndereco = $_GET['id_endereco'];

try{
    $funcionarioDAO = new FuncionarioDAO();
    $telefoneDAO = new TelefoneDAO();
    $enderecoDAO = new EnderecoDAO();
    
    $deletarFuncionario = $funcionarioDAO->deletarFuncionarioPorId($idFuncionario);
    $deletarTelefone = $telefoneDAO->deletarTelefonePorId($idTelefone);
    $deletarEndereco = $enderecoDAO->deletarEnderecoPorId($idEndereco);
    
    if ($deletarFuncionario === true && $deletarTelefone === true && $deletarEndereco === true ){
        $_SESSION['msg'] = 'Funcionario deletado com sucesso!';
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de deletar funcionario!';
    }
    header("Location:consulta_funcionario.php");
    
}catch(Exception $erro){
    echo "Erro:".$erro;
}
?>
