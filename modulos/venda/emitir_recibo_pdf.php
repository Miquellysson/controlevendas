<?php
//include_once("../../class/dao/VendaDAO.class.php");
include_once("../../class/dao/ReciboDAO.class.php");
include_once("../../class/util/FormataData.class.php");
include_once("../../class/util/ValoresNumericos.class.php");
//session_start();
/*$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/controlevendas/';
include_once $caminho_base.'class/dao/VendaDAO.class.php';
include_once $caminho_base.'class/dao/ReciboDAO.class.php';
include_once $caminho_base.'class/util/FormataData.class.php';
include_once $caminho_base.'class/util/ValoresNumericos.class.php';*/

$idVenda = $_GET['id_venda'];

$formataData = new FormataData();

$reciboDAO = new ReciboDAO();

$recibo = $reciboDAO->buscarDadosRecibo($idVenda);

$idRecibo = $recibo[0]['id_recibo'];
$valor = $recibo[0]['valor'];
$nomeCliente = $recibo[0]['nome_cliente'];
 
//require_once($caminho_base."class/fpdf/fpdf.php");
include_once("../../class/fpdf/fpdf.php");

$pdf= new FPDF("P","cm","A4");
 
$pdf->AddPage();

//$valor = 1487257.55;
$valor_recibo = number_format($valor, 2, ',', '.');
$recibo = utf8_decode("RECIBO                                Nº $idRecibo                         VALOR R$ $valor_recibo");

//$valorPorExtenso = ValoresNumericos::valorPorExtenso("R$ 1.487.257,55", true, false);
$valorPorExtenso = ValoresNumericos::valorPorExtenso("R$ $valor_recibo", true, false);

$mes = $formataData->mesPorExtenso( date('M') );

$data = date('d')." de $mes de ". date("Y");

$corpo = utf8_decode("Recebi ( emos) de: $nomeCliente\n
a quantia de: $valorPorExtenso\n
Correspondente a uma compra na minha loja.\n
e para clareza firmo (amos) o presente.\n
Fortaleza, $data.\n
Assinatura _____________________________________________________________________\n
Nome ________________________________________________ CNPJ ___________________\n
Endereço ______________________________________________________________________
");

$pdf->SetFont('arial','B',14);
$pdf->MultiCell(19,3,$recibo, 1, 'L', 0);
//$pdf->Ln(1);
$pdf->SetFont('arial','',12);
$pdf->MultiCell(19,0.5,$corpo, 1, 'L', 0);

$pdf->Output("vendas.pdf","D");
//Mudar para D //I imprime na própria página
//header("Location:relatorio_venda_periodo.php");
?>
