<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/dao/ProdutoDAO.class.php");

//include_once '../../class/dao/ProdutoDAO.class.php';
session_start();

$idProduto = $_POST['id_produto'];
$descricao = utf8_decode( $_POST['descricao'] );
$precoCompra = str_replace(',', '.', $_POST['preco_compra'] );
$precoVenda = str_replace(',', '.', $_POST['preco_venda'] );
$quantidade = utf8_decode( $_POST['quantidade'] );
//echo $telefoneResidencial.'   '.$telefoneCelular.'<br/><br/>';
//print_r($_POST);
//die;
try{
    $produto = new Produto($descricao, $precoCompra, $precoVenda, $quantidade);
    $produto->setIdProduto($idProduto);
    
    $produtoDAO = new ProdutoDAO();
    //print_r($produto); die;
    $alterarProduto = $produtoDAO->alterarProduto($produto);
    
    $_SESSION['msg'] = $alterarProduto;
    /*if ( $alterarProduto === true ){
        $_SESSION['msg'] = 'Produto alterado com sucesso!';
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de alterar produto!';
    }*/
    header("Location:consulta_produto.php");
    
}catch(Exception $erro){
    echo "Erro: ".$erro;
}
?>
