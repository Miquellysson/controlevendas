<?php
include_once("../../class/dao/CompraDAO.class.php");
//include_once '../../class/dao/CompraDAO.class.php';
session_start();

$idCompra = $_POST['id_compra'];
$valor = str_replace(',', '.', $_POST['valor'] );
//print_r($_POST); //die;
try{
    $compra = new Compra($valor);
    $compra->setIdCompra($idCompra);
    
    $compraDAO = new CompraDAO();
    $alterarCompra = $compraDAO->alterarCompra($compra);
    
    $_SESSION['msg'] = $alterarCompra;
    
    header("Location:consulta_compra.php");
    
}catch(Exception $erro){
    echo "Erro: ".$erro;
}
?>

