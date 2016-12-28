<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
//include_once '../../class/model/Cliente.class.php';
//include_once '../../class/util/TrataTelefone.class.php';
//include_once '../../class/dao/EnderecoDAO.class.php';
//include_once '../../class/dao/TelefoneDAO.class.php';
//include_once '../../class/dao/ClienteDAO.class.php';

include_once($caminho_base . "/class/util/TrataTelefone.class.php");
include_once($caminho_base . "/class/dao/EnderecoDAO.class.php");
include_once($caminho_base . "/class/dao/TelefoneDAO.class.php");
include_once($caminho_base . "/class/dao/ClienteDAO.class.php");

session_start();

$trataTelefone = new TrataTelefone();

$telefoneResidencial = $trataTelefone->apenasNumeros( $_POST['telefone_residencial'] );
$telefoneCelular = $trataTelefone->apenasNumeros( $_POST['telefone_celular'] );
$logradouro = utf8_decode( $_POST['logradouro'] );
$numero = $_POST['numero'];
$bairro = utf8_decode( $_POST['bairro'] );
$complemento = utf8_decode( $_POST['complemento'] );
$estado = 'CE';
$cidade = 'Fortaleza';
$nome = utf8_decode( $_POST['nome'] );
$email = $_POST['email'];
//echo $telefoneResidencial.'   '.$telefoneCelular.'<br/><br/>';
//print_r($_POST);
//die;
try{
    
    $telefone = new Telefone($telefoneResidencial, $telefoneCelular);
    $telefoneDAO = new TelefoneDAO();
    $endereco = new Endereco($logradouro, $numero, $bairro, $complemento, $estado, $cidade);
    $enderecoDAO = new EnderecoDAO();
    
    $cadastrarTelefone = $telefoneDAO->cadastrarTelefone($telefone);
    $idTelefone = $telefoneDAO->buscarMaximoIdTelefone();
    $telefone->setIdTelefone( $idTelefone );
    
    $cadastrarEndereco = $enderecoDAO->cadastrarEndereco($endereco);
    $idEndereco = $enderecoDAO->buscarMaximoIdEndereco();
    $endereco->setIdEndereco( $idEndereco );
    
    $cliente = new Cliente($nome, $email, $telefone, $endereco);
    $clienteDAO = new ClienteDAO();
    $cadastrarCliente = $clienteDAO->cadastrarCliente($cliente);
    
    //$cliente = new Cliente($nome, $telefoneResidencial, $telefoneCelular, $email, $endereco);
    //$clienteDAO = new ClienteDAO();
    //$cadastrarCliente = $clienteDAO->cadastroCliente($cliente);
    $_SESSION['msg'] = $cadastrarCliente;
    /*if ($cadastrarCliente === true){
        $_SESSION['msg'] = 'Cliente cadastrado com sucesso!';
        //header("Location:cadastro_cliente.php");
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de cadastrar cliente!';
        //header("Location:cadastro_cliente.php");
        //echo 'Não cadastrou';
    }*/
    header("Location:cadastro_cliente.php");
    
}catch(Exception $erro){
    echo "Erro:".$erro;
}
?>