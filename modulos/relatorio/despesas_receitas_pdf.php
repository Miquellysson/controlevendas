<?php
//session_start();
include_once("../../class/dao/VendaDAO.class.php");
include_once("../../class/dao/CompraDAO.class.php");
include_once("../../class/util/FormataData.class.php");
/*$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/dao/VendaDAO.class.php");
include_once($caminho_base . "/class/dao/CompraDAO.class.php");
include_once($caminho_base . "/class/util/FormataData.class.php");*/
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/controlevendas/';
//include_once $caminho_base.'class/dao/VendaDAO.class.php';
//include_once $caminho_base.'class/dao/CompraDAO.class.php';
//include_once $caminho_base.'class/util/FormataData.class.php';

$formataData = new FormataData();
$vendaDAO = new VendaDAO();
$compraDAO = new CompraDAO();

$dataInicio = '';
$dataFim = '';
$pos = strpos($_POST['periodo'], '-');
if( $pos != -1 ){
    $periodo = $_POST['periodo'];
    $dataInicio = substr($periodo, 0, $pos-1);
    $dataFim = substr($periodo, $pos+2);
}
if( $dataInicio != '' && $dataFim != '' ){
    $dataInicio = $formataData->formataDataBancoInicio($dataInicio);
    $dataFim = $formataData->formataDataBancoFim($dataFim);
}
$vendas = $vendaDAO->buscaVendas('', '', $dataInicio, $dataFim);
$compras = $compraDAO->buscaCompras($dataInicio, $dataFim);

//require_once($caminho_base."class/fpdf/fpdf.php");
include_once("../../class/fpdf/fpdf.php"); 

$pdf= new FPDF("P","cm","A4");
 
$pdf->AddPage();
 
$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,3,"Despesas/Receitas",0,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(13,1,"Valor total de vendas",1,0,'C');

$valorVendas = 0;
if( $vendas != NULL ){
    foreach ($vendas as $venda){
        //$idVenda = $venda['id_venda'];
        $valorVendas += $venda['valor'];
    }
}//else{
//    $pdf->Cell(19,1,utf8_decode('Não há nenhum registro encontrado com os parâmetros informados.'),1,0,'C');
//}
$pdf->setFont('Arial','',12);
$pdf->Cell(6,1,str_replace('.', ',', $valorVendas),1,0,'C');
$pdf->Ln();

$pdf->SetFont('Arial','',12);
$pdf->Cell(13,1,"Valor total de compras",1,0,'C');
$valorCompras = 0;
if( $compras != NULL ){
    foreach ($compras as $compra){
        //$idVenda = $venda['id_venda'];
        $valorCompras += $compra['valor'];
    }
}//else{
//    $pdf->Cell(19,1,utf8_decode('Não há nenhum registro encontrado com os parâmetros informados.'),1,0,'C');
//}
$pdf->setFont('Arial','',12);
$pdf->Cell(6,1,  str_replace('.', ',', $valorCompras),1,0,'C');
$pdf->Ln();

$pdf->setFont('Arial','',12);
$pdf->Cell(13,1,"Lucro",1,0,'C');
$pdf->Cell(6,1,str_replace('.', ',', $valorVendas-$valorCompras),1,0,'C');
$pdf->Ln();

$pdf->Output("despesas_receitas.pdf","D");
//Mudar para D
//header("Location:relatorio_venda_periodo.php");
?>
