<?php
include_once("../../class/dao/ProdutoDAO.class.php");
include_once("../../class/dao/VendaDAO.class.php");
include_once("../../class/dao/VendaDAO.class.php");
include_once("../../class/dao/ItemVendaDAO.class.php");
/*include_once '../../class/dao/ProdutoDAO.class.php';
include_once '../../class/dao/VendaDAO.class.php';
include_once '../../class/dao/ReciboDAO.class.php';
include_once '../../class/dao/ItemVendaDAO.class.php';*/
session_start();

//print_r($_POST); die;
$idCliente = $_POST['cliente'];
$idFuncionario = $_POST['funcionario'];
$produtos = $_POST['produtos']; // id_produto e quantidade separado por -,valor separado por ;

try{
    $vendaDAO = new VendaDAO();
    $produtoDAO = new ProdutoDAO();
    $itemVendaDAO = new ItemVendaDAO();
    $reciboDAO = new ReciboDAO();
    
    $valor = 0;
    foreach ($produtos as $produto){ //Para calcular o valor da venda
        $pos_pv = strpos($produto, ';');
        $pos_traco = strpos($produto, '-');

        $precoVenda = substr($produto, $pos_pv+1, $pos_traco-2 ); //.'<br/>';
        $quantidade = substr($produto, $pos_traco+1 ); //.'<br/><br/>';
        $valor += $precoVenda*$quantidade;
    }
    //echo $valor;
    //die;
    $venda = new Venda($valor, $idCliente, $idFuncionario);
    $cadastrarVenda = $vendaDAO->cadastrarVenda($venda);
    $idVenda = $vendaDAO->buscaIdUltimaVenda();
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

        $itemVenda = new ItemVenda($idVenda, $idProduto, $quantidade);
        $itemVendaDAO->cadastrarItemVenda($itemVenda);

        $produtoDAO->alterarEstoque($idProduto, $quantidade);
    }
    
    $recibo = new Recibo($idVenda);
    $reciboDAO->cadastrarRecibo($recibo);
    
    $_SESSION['msg'] = $cadastrarVenda;
    /*if ($cadastrarVenda === true){
        $_SESSION['msg'] = 'Venda cadastrada com sucesso!';
        //header("Location:cadastro_cliente.php");
    }else{
        $_SESSION['msg'] = 'Erro na tentativa de cadastrar venda!';
        //header("Location:cadastro_cliente.php");
        //echo 'Não cadastrou';
    }*/
    header("Location:cadastro_venda.php");

    //echo $valor;
    //die;
}catch(Exception $erro){
    echo "Erro: ".$erro;
}
?>
