<?php
//session_start();
/*
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/dao/VendaDAO.class.php");
include_once($caminho_base . "/class/util/FormataData.class.php");
*/

include_once("../../class/dao/VendaDAO.class.php");
include_once("../../class/util/FormataData.class.php");

$formataData = new FormataData();
$vendaDAO = new VendaDAO();

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
$vendas = $vendaDAO->buscaVendas($_POST['cliente'], $_POST['funcionario'], $dataInicio, $dataFim);
    
//require_once($caminho_base."class/fpdf/fpdf.php");
//include_once($caminho_base . "/class/fpdf/fpdf.php");
include_once("../../class/fpdf/fpdf.php"); 

$pdf= new FPDF("P","cm","A4");
 
$pdf->AddPage();
 
$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,3,"Vendas",0,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(6,1,"Cliente",1,0,'C');
$pdf->Cell(6,1,utf8_decode("Funcionário"),1,0,'C');
$pdf->Cell(4,1,"Data",1,0,'C');
$pdf->Cell(3,1,"Valor venda",1,0,'C');
$pdf->Ln();

if( $vendas != NULL ){
    foreach ($vendas as $venda){
        //$idVenda = $venda['id_venda'];
        $valor = $venda['valor'];
        $dataHora = $formataData->formataDataHoraBrasileira( $venda['data_hora'] );
        $nomeCliente = $venda['nome_cliente'];
        $nomeFuncionario = $venda['nome_funcionario'];
        $pdf->setFont('Arial','',12);
        $pdf->Cell(6,1,$nomeCliente,1,0,'C');
        $pdf->Cell(6,1,$nomeFuncionario,1,0,'C');
        $pdf->Cell(4,1,$dataHora,1,0,'C');
        $pdf->Cell(3,1,str_replace('.',',',$valor),1,0,'C');
        $pdf->Ln();
    }
}else{
    $pdf->Cell(19,1,utf8_decode('Não há nenhum registro encontrado com os parâmetros informados.'),1,0,'C');
}

$pdf->Output("vendas.pdf","D");
//Mudar para D
//header("Location:relatorio_venda_periodo.php");
?>
