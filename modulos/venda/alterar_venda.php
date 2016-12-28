<?php
//include_once '../../class/dao/VendaDAO.class.php';
session_start();
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/dao/VendaDAO.class.php");
$idVenda = $_POST['id_venda'];
$valor = str_replace(',', '.', $_POST['valor'] );
//print_r($_POST);
//die;
try{
    $venda = new Venda($valor, 0, 0);
    $venda->setIdVenda($idVenda);
    
    $vendaDAO = new VendaDAO();
    //print_r($produto); die;
    $alterarVenda = $vendaDAO->alterarVenda($venda);
   
    $_SESSION['msg'] = $alterarVenda;
    /*if ( $alterarVenda === true ){
        $_SESSION['msg'] = 'Venda alterada com sucesso!';
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de alterar venda!';
    }*/
    header("Location:consulta_venda.php");
    
}catch(Exception $erro){
    echo "Erro: ".$erro;
}
?>