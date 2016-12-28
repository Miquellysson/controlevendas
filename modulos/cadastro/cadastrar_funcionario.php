<?php
$caminho_base = $_SERVER["DOCUMENT_ROOT"];
include_once($caminho_base . "/class/util/TrataTelefone.class.php");
include_once($caminho_base . "/class/dao/EnderecoDAO.class.php");
include_once($caminho_base . "/class/dao/TelefoneDAO.class.php");
include_once($caminho_base . "/class/dao/FuncionarioDAO.class.php");
//include_once '../../class/util/TrataTelefone.class.php';
//include_once '../../class/dao/EnderecoDAO.class.php';
//include_once '../../class/dao/TelefoneDAO.class.php';
//include_once '../../class/dao/FuncionarioDAO.class.php';
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
$salario = str_replace(',', '.', $_POST['salario']);
//echo $telefoneResidencial.'   '.$telefoneCelular.'<br/><br/>';
//print_r($_POST);
//echo '<br><br>';
//echo $nome.' - '.$email.' - '.$salario;
//echo $telefoneResidencial.' - '.$telefoneCelular;
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
    
    $funcionario = new Funcionario($nome, $email, $salario, $telefone, $endereco);
    $funcionarioDAO = new FuncionarioDAO();
    $cadastrarFuncionario = $funcionarioDAO->cadastrarFuncionario($funcionario);
    
    $_SESSION['msg'] = $cadastrarFuncionario;
    /*if ($cadastrarFuncionario === true){
        $_SESSION['msg'] = 'Funcionário cadastrado com sucesso!';
        //header("Location:cadastro_cliente.php");
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de cadastrar funcionário!';
        //header("Location:cadastro_cliente.php");
        //echo 'Não cadastrou';
    }*/
    header("Location:cadastro_funcionario.php");
    
}catch(Exception $erro){
    echo "Erro:".$erro;
}
?>
