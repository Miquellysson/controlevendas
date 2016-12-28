<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/dao/EnderecoDAO.class.php");
include_once($caminho_base . "/class/dao/TelefoneDAO.class.php");
include_once($caminho_base . "/class/dao/ClienteDAO.class.php");
//include_once '../../class/dao/EnderecoDAO.class.php';
//include_once '../../class/dao/TelefoneDAO.class.php';
//include_once '../../class/dao/ClienteDAO.class.php';
session_start();

$idCliente = $_GET['id_cliente'];
$idTelefone = $_GET['id_telefone'];
$idEndereco = $_GET['id_endereco'];

try{
    $clienteDAO = new ClienteDAO();
    $telefoneDAO = new TelefoneDAO();
    $enderecoDAO = new EnderecoDAO();
    
    $deletarCliente = $clienteDAO->deletarClientePorId($idCliente);
    $deletarTelefone = $telefoneDAO->deletarTelefonePorId($idTelefone);
    $deletarEndereco = $enderecoDAO->deletarEnderecoPorId($idEndereco);
    
    if ($deletarCliente === true && $deletarTelefone === true && $deletarEndereco === true ){
        $_SESSION['msg'] = 'Cliente deletado com sucesso!';
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de deletar cliente!';
    }
    header("Location:consulta_cliente.php");
    
}catch(Exception $erro){
    echo "Erro:".$erro;
}
?>
