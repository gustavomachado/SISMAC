<?php 


	require_once ( $path . "model/DAO/ContratoDAO.php");
	require_once ( $path . "model/Bean/Contrato.php");
	require_once ( $path . "model/Bean/Cliente.php");
	require_once ( $path . "model/DAO/ClienteDAO.php");
	
	$template->addFile("CONTENT",$viewsPath . "cliente/restaurar.html");

	$template->SELECTED2 = "selected";

	if(strlen($_GET['id']) > 0){

		$clienteDAO = new ClienteDAO($banco);
		$cliente = $clienteDAO->pesquisar(new Cliente() , "id = " . $_GET['id']);

		$cliente = $cliente[0];
	 
		$template->NOMECLIENTE = $cliente->getNome();

		$contratoDAO = new ContratoDAO($banco);
		$contrato = $contratoDAO->pesquisar(new Contrato() , "idcliente = " . $_GET['id']  );
		
                showDetails($contrato);
	
		
	
		

	}



 ?>