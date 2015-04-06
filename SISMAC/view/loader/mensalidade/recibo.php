<?php

require_once $path . 'model/Bean/Recibo.php';
require_once $path . 'model/DAO/ReciboDAO.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$dao = new ReciboDAO($banco);
$recibo = new Recibo();
$dao->inserir($recibo);
//showDetails($recibo);

$parametros = $dao->getParameters();

#dshowDetails($parametros);

$template->SELECTED5 = "selected";

$template->addFile("CONTENT", $viewsPath . "mensalidade/recibo.html");

$template->NUMRECIBO = $recibo->getIdRecibo();
$template->NOMEEMITENTE = $parametros['nome-emitente-recibo'];
$template->ENDEMITENTE = $parametros['endereco-emitente-recibo'];
$template->CPFCNPJEMITENTE = $parametros['cpf-cnpj-emitente-recibo'];
$template->CURDATE = date("d/m/Y");