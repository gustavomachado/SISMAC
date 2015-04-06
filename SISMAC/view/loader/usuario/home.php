<?php

require_once $path . 'utils/Banco.php';
require_once $path . 'model/Bean/Mensalidade.php';
require_once $path . 'model/Bean/Contrato.php';
require_once $path . 'model/DAO/MensalidadeDAO.php';
require_once $path . 'model/DAO/ContratoDAO.php';

$mesExtenso = array(
    "Jan" => "Janeiro", "Feb" => "Fevereiro", "Mar" => "Mar&ccedil;o", "Apr" => "Abril", "May" => "Maio", "Jun" => "Junho",
    "Jul" => "Julho", "Aug" => "Agosto", "Sep" => "Setembro", "Oct" => "Outubro", "Nov" => "Novembro", "Dec" => "Dezembro");

$template->SELECTED1 = "selected";

$template->addFile("CONTENT", 'view/template-client/usuario/home.html');
require_once ('sidebar.php');
$dataExtenso = date("d") . " de " . $mesExtenso[date("M")] . " de " . date("Y");

$template->DATA_EXTENSO = $dataExtenso;


$cDAO = new ContratoDAO(new Banco());
$contratos = $cDAO->pesquisar(new Contrato(), " ativo = 1 ");

$cMensalidadeAberto=0;
$cMensalidadeBaixada=0;
$cMult = array();
 $mDAO = new MensalidadeDAO(new Banco());
foreach ($contratos as $contrato) {
    
    $mensalidades = $mDAO->pesquisar(new Mensalidade()," dataPagamento='0000-00-00' and ativo=0 and mesReferencia=".date("m")." and idContrato=".$contrato->getId());
    foreach ($mensalidades as $mensalidade) {
       # echo "setting ativo<br>";
        $mensalidade->setAtivo(1);
        $mDAO->editar($mensalidade);
    }    
    $mensalidades = $mDAO->pesquisar(new Mensalidade()," ativo=1 and idcontrato=".$contrato->getId());
    foreach ($mensalidades as $mensalidade) {
      // echo $mensalidade->getMesReferencia() . " contrato ". $mensalidade->getIdContrato()."<br>";
        $mes = $mesExtenso[date("M", mktime(0, 0, 0, $mensalidade->getMesReferencia(), 1,$mensalidade->getAnoReferencia()))];
        if(isset($cMult[$mes])){
            $cMult[$mes]++;
        }else{
            $cMult[$mes] = 1;
        }
    }
    $cMensalidadeAberto+= count($mensalidades);
}

$mensalidades = $mDAO->pesquisar(new Mensalidade()," dataPagamento like '" .date("Y-m")."%'" );
$cMensalidadeBaixada = count($mensalidades);
//showDetails($cMult);
foreach ($cMult as $mes => $quantidade){
    $template->MES          = $mes;
    $template->QUANTIDADE   = $quantidade;
    $template->block("DADOSMES");
    
}
 
$template->MES = $mesExtenso[date("M")];
$template->QUANTIDADE= $cMensalidadeBaixada;

$template->MENSALIDADEABERTO = $cMensalidadeAberto;

