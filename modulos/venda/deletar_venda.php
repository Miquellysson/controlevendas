<?php
session_start();
include_once("../../class/dao/ItemVendaDAO.class.php");
include_once("../../class/dao/VendaDAO.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'];
//include_once($caminho_base . "/class/dao/ItemVendaDAO.class.php");
//include_once($caminho_base . "/class/dao/VendaDAO.class.php");
//include_once '../../class/dao/ItemVendaDAO.class.php';
//include_once '../../class/dao/VendaDAO.class.php';

$idVenda = $_GET['id_venda'];

try{
    $itemVendaDAO = new ItemVendaDAO();
    $vendaDAO = new VendaDAO();
    
    $deletarItensVenda = $itemVendaDAO->deletarItensVendaPorIdVenda($idVenda);
    $deletarVenda = $vendaDAO->deletarVendaPorId($idVenda);
    
    if ($deletarItensVenda === true && $deletarVenda === true){
        $_SESSION['msg'] = 'Venda deletada com sucesso!';
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de deletar venda!';
    }
    header("Location:consulta_venda.php");
    
}catch(Exception $erro){
    echo "Erro:".$erro;
}
?>
