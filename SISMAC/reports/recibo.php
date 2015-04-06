<?php

session_start();
require_once $path . 'utils/Banco.php';
require_once $path . 'model/Bean/Recibo.php';
require_once $path . 'model/Bean/Mensalidade.php';
require_once $path . 'model/Bean/Contrato.php';
require_once $path . 'model/DAO/ReciboDAO.php';
require_once $path . 'model/DAO/MensalidadeDAO.php';
require_once $path . 'model/DAO/ContratoDAO.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//showDetails($_REQUEST);
$dao = new ReciboDAO(new Banco());
$recibo = new Recibo();
$dao->inserir($recibo);

$parametros = $dao->getParameters();

$mDao = new MensalidadeDAO(new Banco());

if (isset($_REQUEST['id'])) {

    $mensalidade = $mDao->pesquisar(new Mensalidade(), " id=" . $_REQUEST['id']);
    $mensalidade = $mensalidade[0];
    $cDao = new ContratoDAO(new Banco());
    $contrato = $cDao->pesquisar(new Contrato(), " id=" . $mensalidade->getIdContrato());
    $contrato = $contrato[0];
    /*  showDetails($contrato);
      showDetails($mensalidade);
      exit; */
    $valorRecibo = $contrato->getMensalidade() - $mensalidade->getDesconto() + $mensalidade->getAcrescimo();
    $template->VALORRECIBO = "R$ " . number_format($valorRecibo, 2, ',', '.');

    if (isset($_SESSION['referente'])) {
        $template->REFERENTE = $_SESSION['referente'];
    }
    if (isset($_SESSION['recebido'])) {
        $template->CLIENTE = $_SESSION['recebido'];
    }
}
/*
  showDetails($mensalidade);
  showDetails($contrato);
 */


$template->NUMRECIBO = $recibo->getIdRecibo();
$template->NOMEEMITENTE = $parametros['nome-emitente-recibo'];
$template->ENDEMITENTE = $parametros['endereco-emitente-recibo'];
$template->CPFCNPJEMITENTE = $parametros['cpf-cnpj-emitente-recibo'];

$template->CURDATE = date("d/m/Y");


/*
$i = 1;
for($i=1;$i<13;$i++){
    $var = 100/12;
    echo ".col-lg-$i{<br>width: ".$var*$i ."% !important ;<br>}<br>";
    
}*/