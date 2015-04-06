<?php 
	require_once ( $path .  "model/Bean/Cliente.php");
	require_once ( $path .  "model/Bean/Embarcacao.php");
	require_once ( $path .  "model/Bean/Contrato.php");

	$template->SELECTED2 = "selected";

	if($template->exists("LISTARESULTADO"))
		$template->addFile("LISTARESULTADO",'view/template-client/cliente/listar-pesquisa.html');
	else
		$template->addFile("CONTENT",'view/template-client/cliente/listar-restaurar.html');
	
	if ( ! isset($remove) )
		$remove = false;

	if (isset($_SESSION['lista'])) {
		
		$listaClientes = get('lista',$remove);

		foreach ($listaClientes as $key => $cliente) {
			$cliente 			= unserialize($cliente);
		 
			$template->CODIGO 	= $cliente->getId();

			if( strcmp($cliente->getTipo(), "f") == 0){
				$template->CPF 		= mask($cliente->getCpf(),"###.###.###-##");
				$template->TIPO 	="Física";
				$template->REGISTRO = "cpf";
			}else{
				$template->CPF 		= mask($cliente->getCpf(),"##.###.###/####-##");
				$template->TIPO 	="Jurídica";
				$template->REGISTRO = "cnpj";
			}
			
			if ($cliente->getAtivo() > 0) {
				 
				$template->TITLECONTRATO 	= "Alterar Contrato";
			}else{
				$template->TITLECONTRATO 	= "Criar Contrato";
			}
			
			$embarcacoes 			= $cliente->getEmbarcacao();
			$template->NOME 		= $cliente->getNome();
			
			$template->block("LISTABODY");

			}
			
			
		
		
	}



 ?>