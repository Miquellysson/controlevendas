<?php
include_once("../../class/dao/ProdutoDAO.class.php");
include_once("../../class/dao/CompraDAO.class.php");
include_once("../../class/dao/ItemCompraDAO.class.php");
//include_once '../../class/dao/ProdutoDAO.class.php';
//include_once '../../class/dao/CompraDAO.class.php';
//include_once '../../class/dao/ItemCompraDAO.class.php';
session_start();

//print_r($_POST); //die;
//echo '<br/><br/><br/><br/>';
$produtos = $_POST['produtos']; // id_produto e quantidade separado por -,valor separado por ;

try{
    $compraDAO = new CompraDAO();
    $produtoDAO = new ProdutoDAO();
    $itemCompraDAO = new ItemCompraDAO();

    $valor = 0;
    foreach ($produtos as $produto){ //Para calcular o valor da venda
        $pos_pv = strpos($produto, ';');
        $pos_traco = strpos($produto, '-');

        $precoCompra = substr($produto, $pos_pv+1, $pos_traco-2 ); //.'<br/>';
        $quantidade = substr($produto, $pos_traco+1 ); //.'<br/><br/>';
        $valor += $precoCompra*$quantidade;
    }
    //echo $valor;
    //die;
    $compra = new Compra($valor);
    $cadastrarCompra = $compraDAO->cadastrarCompra($compra);
    $idCompra = $compraDAO->buscaIdUltimaCompra();
    //var_dump( $idVenda );
    //die;
    //$idVenda = (int)'2';
    foreach ($produtos as $produto){
        //print_r($produto);
        //echo '<br/><br/>';
        //echo $produto.'<br/>';
        $pos_pv = strpos($produto, ';').'<br/>';
        $pos_traco = strpos($produto, '-').'<br/>';
        //die;
        $idProduto = substr($produto, 0, $pos_pv );
        //$precoVenda = substr($produto, $pos_pv+1, $pos_traco-2 );
        $quantidade = substr($produto, $pos_traco+1 );
        //echo $idProduto.'<br/><br/>';
        //echo $quantidade.'<br/><br/>';
        //$valor += $precoVenda*$quantidade;

        $itemCompra = new ItemCompra($idCompra, $idProduto, $quantidade);
        $itemCompraDAO->cadastrarItemCompra($itemCompra);

        $produtoDAO->compraEstoque($idProduto, $quantidade);
    }
    
    $_SESSION['msg'] = $cadastrarCompra;
    /*if ($cadastrarVenda === true){
        $_SESSION['msg'] = 'Venda cadastrada com sucesso!';
        //header("Location:cadastro_cliente.php");
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de cadastrar venda!';
        //header("Location:cadastro_cliente.php");
        //echo 'Não cadastrou';
    }*/
    header("Location:cadastro_compra.php");

    //echo $valor;
    //die;
}catch(Exception $erro){
    echo "Erro: ".$erro;
}
?>
