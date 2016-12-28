<?php
$caminho_base = $_SERVER["DOCUMENT_ROOT"];
include_once($caminho_base . "/class/dao/ProdutoDAO.class.php");
//include_once '../../class/dao/ProdutoDAO.class.php';
session_start();

$descricao = utf8_decode( $_POST['descricao'] );
$precoCompra = str_replace( ',', '.', $_POST['preco_compra'] );
$precoVenda = str_replace( ',', '.', $_POST['preco_venda'] );
$quantidade = $_POST['quantidade'];

//print_r($_POST);
//die;
try{
    $produto = new Produto($descricao, $precoCompra, $precoVenda, $quantidade);
    $produtoDAO = new ProdutoDAO();
    $cadastrarProduto = $produtoDAO->cadastrarProduto($produto);
    $_SESSION['msg'] = $cadastrarProduto;
    /*if ($cadastrarProduto === true){
        $_SESSION['msg'] = 'Produto cadastrado com sucesso!';
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de cadastrar produto!';
    }*/
    header("Location:cadastro_produto.php");
    
}catch(Exception $erro){
    echo "Erro: ".$erro;
}
?>
