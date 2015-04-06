<?php

require_once( $path . "model/DAO/ClienteDAO.php");
require_once( $path . "model/Bean/Cliente.php");
require_once( $path . "model/DAO/ContratoDAO.php");
require_once( $path . "model/Bean/Contrato.php");

$template->SELECTED5 = "selected";

$template->addFile("CONTENT",'view/template-client/mensalidade/home.html');
//$template->addFile("SIDEBAR",'view/template-client/cliente/sidebar-home.html');
/*
$dao = new ClienteDAO($banco);

$clientesAtivos 			= $dao->pesquisar(new Cliente(),"ativo=1");
$clientesInativos 			= $dao->pesquisar(new Cliente(),"ativo=0");
$template->TOTALCLIENTES 	= count($clientesAtivos) + count($clientesInativos) ;
$template->ATIVOS 			= count($clientesAtivos);
$template->INATIVOS 		= count($clientesInativos);

$dao = new ContratoDAO($banco);

$contratos = $dao->pesquisar(new Contrato(), "ativo=1");

$pfAtivos 	= 0 ;
$pjAtivos 	= 0 ;
$pfInativos = 0 ;
$pjInativos = 0 ;
	foreach ($clientesAtivos as $key => $value) {
		if(strcmp($value->getTipo(), "f") == 0 )
			$pfAtivos++;
		else
			$pjAtivos++;
	}
	foreach ($clientesInativos as $key => $value) {
		if( strcmp($value->getTipo(), "f") == 0)
			$pfInativos++;
		else
			$pjInativos++;
	}

$template->TOTALPF 		= $pfAtivos + $pfInativos;
$template->ATIVOSPF 	= $pfAtivos;
$template->INATIVOSPF 	= $pfInativos;

$template->TOTALPJ 		= $pjAtivos + $pjInativos;
$template->ATIVOSPJ 	= $pjAtivos;
$template->INATIVOSPJ 	= $pjInativos;

*/