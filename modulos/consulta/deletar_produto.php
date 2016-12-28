<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/dao/ProdutoDAO.class.php");
//include_once '../../class/dao/ProdutoDAO.class.php';
session_start();

$idProduto = $_GET['id_produto'];

try{
    $produtoDAO = new ProdutoDAO();
    
    $deletarProduto = $produtoDAO->deletarProdutoPorId($idProduto);
    
    if ($deletarProduto === true){
        $_SESSION['msg'] = 'Produto deletado com sucesso!';
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de deletar produto!';
    }
    header("Location:consulta_produto.php");
    
}catch(Exception $erro){
    echo "Erro:".$erro;
}
?>
