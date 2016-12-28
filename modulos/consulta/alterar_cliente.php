<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/util/TrataTelefone.class.php");
include_once($caminho_base . "/class/dao/EnderecoDAO.class.php");
include_once($caminho_base . "/class/dao/TelefoneDAO.class.php");
include_once($caminho_base . "/class/dao/ClienteDAO.class.php");
//include_once '../../class/util/TrataTelefone.class.php';
//include_once '../../class/dao/EnderecoDAO.class.php';
//include_once '../../class/dao/TelefoneDAO.class.php';
//include_once '../../class/dao/ClienteDAO.class.php';
session_start();

$trataTelefone = new TrataTelefone();
$idCliente = $_POST['id_cliente'];
$idTelefone = $_POST['id_telefone'];
$idEndereco = $_POST['id_endereco'];
$telefoneResidencial = $trataTelefone->apenasNumeros( $_POST['telefone_residencial'] );
$telefoneCelular = $trataTelefone->apenasNumeros( $_POST['telefone_celular'] );
$logradouro = utf8_decode( $_POST['logradouro'] );
$numero = $_POST['numero'];
$bairro = utf8_decode( $_POST['bairro'] );
$complemento = utf8_decode( $_POST['complemento'] );
$estado = 'CE';
$cidade = 'Fortaleza';
$nome = $_POST['nome'];
$email = $_POST['email'];
//echo $telefoneResidencial.'   '.$telefoneCelular.'<br/><br/>';
//print_r($_POST);
//die;
try{
    $telefone = new Telefone($telefoneResidencial, $telefoneCelular);
    $telefone->setIdTelefone($idTelefone);
    $endereco = new Endereco($logradouro, $numero, $bairro, $complemento, $estado, $cidade);
    $endereco->setIdEndereco($idEndereco);
    $cliente = new Cliente($nome, $email, $telefone, $endereco);
    $cliente->setIdCliente($idCliente);
    
    $enderecoDAO = new EnderecoDAO();
    $telefoneDAO = new TelefoneDAO();
    $clienteDAO = new ClienteDAO();
    
    $alterarTelefone = $telefoneDAO->alterarTelefone($telefone);
    $alterarEndereco = $enderecoDAO->alterarEndereco($endereco);
    $alterarCliente = $clienteDAO->alterarCliente($cliente);
    
    if ( $alterarEndereco === true && $alterarTelefone === true ){
        $_SESSION['msg'] = $alterarCliente;
        //$_SESSION['msg'] = 'Cliente alterado com sucesso!';
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de alterar cliente!';
    }
    header("Location:consulta_cliente.php");
    
}catch(Exception $erro){
    echo "Erro: ".$erro;
}
?>
