<?php

require_once $path . 'model/Bean/Cliente.php';
require_once $path . 'model/Bean/Contrato.php';
require_once $path . 'model/Bean/Embarcacao.php';
require_once $path . 'model/Bean/Mensalidade.php';
require_once $path . 'model/Bean/FormaPagamento.php';
require_once $path . 'model/DAO/ClienteDAO.php';
require_once $path . 'model/DAO/ContratoDAO.php';
require_once $path . 'model/DAO/EmbarcacaoDAO.php';
require_once $path . 'model/DAO/MensalidadeDAO.php';
require_once $path . 'model/DAO/ReciboDAO.php';
require_once $path . 'model/DAO/FormaPagamentoDAO.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open t$diaMaxhe template in the editor.
 */
$template->SELECTED5 = "selected";

$mesExtenso = array(
    "Jan" => "Janeiro", "Feb" => "Fevereiro", "Mar" => "Mar&ccedil;o", "Apr" => "Abril", "May" => "Maio", "Jun" => "Junho",
    "Jul" => "Julho", "Aug" => "Agosto", "Sep" => "Setembro", "Oct" => "Outubro", "Nov" => "Novembro", "Dec" => "Dezembro");

$id = $_GET['idmensalidade'];

$daoRecibo = new ReciboDAO($banco);
$parametros = $daoRecibo->getParameters();

$daoMensalidade = new MensalidadeDAO($banco);
$mensalidade = $daoMensalidade->pesquisar(new Mensalidade(), "id = " . $id);
$mensalidade = $mensalidade[0];

$daoContrato = new ContratoDAO($banco);
$contrato = $daoContrato->pesquisar(new Contrato(), "id = " . $mensalidade->getIdContrato());
$contrato = $contrato[0];

$daoCliente = new ClienteDAO($banco);
$cliente = $daoCliente->pesquisar(new Cliente(), "id = " . $contrato->getIdCliente());
$cliente = $cliente[0];

$daoEmbarcacao = new EmbarcacaoDAO($banco);
$embarcacao = $daoEmbarcacao->pesquisar(new Embarcacao(), "id = " . $contrato->getIdEmbarcacao());
$embarcacao = $embarcacao[0];

$valorContrato = $contrato->getMensalidade();
$valorMulta = 0;
$diasVencido = 0;

$dataVencimento = $mensalidade->getDataVencimento($contrato);
//echo $dataVencimento . "<br>" . date("Y-m-d");
$moraDia = $parametros['juros-mes'] / date("t", strtotime($dataVencimento));
//echo "$dataVencimento<br>";
if (date("Y-m-d") > $dataVencimento) {
    $valorMulta = $valorContrato * $parametros['multa-atraso'] / 100;
    $diferenca = strtotime(date("Y-m-d")) - strtotime($dataVencimento);
    $diasVencido = floor($diferenca / (60 * 60 * 24));
}
$valorMensalidade = $valorContrato + $mensalidade->getAcrescimo() - $mensalidade->getDesconto();
$valorMensalidade += $valorMulta + ( $valorContrato * ($diasVencido * $moraDia) / 100 );

$template->addFile("CONTENT", $viewsPath . "mensalidade/baixar.html");


$fpDAO = new FormaPagamentoDAO(new Banco());
$listaFormaPagamento = $fpDAO->pesquisar(new FormaPagamento(), " true order by descricao");
//showDetails($listaFormaPagamento);
foreach ($listaFormaPagamento as $forma) {
  //  showDetails($forma);
    $template->DESCRICAO_FP = $forma->getDescricao();
    $template->ID_FP = $forma->getId();
    $template->block("LISTA_FP");
}

$template->CLIENTE = $cliente->getNome();
$template->EMBARCACAO = $embarcacao->getNome();
$template->VALORCONTRATO = "R$ " . number_format($contrato->getMensalidade(), 2, ',', '.');
$template->ACRESCIMO = "R$ " . number_format($mensalidade->getAcrescimo(), 2, ',', '.');
$template->DESCONTO = "R$ " . number_format($mensalidade->getDesconto(), 2, ',', '.');
$template->VALORMENSALIDADE = "R$ " . number_format($valorMensalidade, 2, ',', '.');
$template->MULTA = number_format($valorMulta, 2, ',', '.');
$template->JUROSMES = number_format($moraDia, 2, ',', '.');
$template->VALORMULTA = "R$ " . number_format($valorMulta, 2, ',', '.');
$template->MORADIA = "R$ " . number_format($valorContrato * ( $moraDia) / 100, 2, ',', '.');
$template->MORADIACAL = number_format(($diasVencido * ($valorContrato * $moraDia / 100)), 2, ',', '.');
$template->DIASATRASO = $diasVencido;
$template->HOJE = date("d/m/Y");
$template->DATAVENCIMENTO = date("d/m/Y", strtotime($dataVencimento));
$template->REFERENCIA = $mesExtenso[date("M", strtotime($dataVencimento))] . "/" . $mensalidade->getAnoReferencia();
$template->IDMENSALIDADE = $id;
$template->IDCONTRATO = $contrato->getId();
