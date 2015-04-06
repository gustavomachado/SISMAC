<?php 

 

$operadoras = array("0" => "Vivo","1" => "Claro", "2" => "TIM" , "3" => "OI");

$template->SELECTED2 = "selected";

$template->addFile("CONTENT",'view/template-client/cliente/salvar.html');
$template->addFile("SIDEBAR","view/template-client/cliente/sidebar-salvar.html");

$template->TEL = 0;
$template->END = 0;
$template->EMAIL= 0;
$template->EMB=0;

foreach ($operadoras as $value) {
	$template->OPERADORA = $value;
	$template->block("OPERADORAS");
}
//echo date('d/m/Y');
$template->DATAINICIO = date('d/m/Y');


 ?>