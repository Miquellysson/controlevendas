<?php
session_start();
include_once("../../class/dao/ItemCompraDAO.class.php");
include_once("../../class/dao/CompraDAO.class.php");
//include_once '../../class/dao/ItemCompraDAO.class.php';
//include_once '../../class/dao/CompraDAO.class.php';

$idCompra = $_GET['id_compra'];

try{
    $itemCompraDAO = new ItemCompraDAO();
    $compraDAO = new CompraDAO();
    
    $deletarItensCompra = $itemCompraDAO->deletarItensCompraPorIdCompra($idCompra);
    $deletarCompra = $compraDAO->deletarCompraPorId($idCompra);
    
    if ($deletarItensCompra === true && $deletarCompra === true){
        $_SESSION['msg'] = 'Compra deletada com sucesso!';
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de deletar compra!';
    }
    header("Location:consulta_compra.php");
    
}catch(Exception $erro){
    echo "Erro:".$erro;
}
?>
