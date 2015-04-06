<?php 



	$template->addFile("LISTARESULTADO",'view/template-client/cliente/listar.html');
	
	if (isset($_SESSION['lista'])) {
		$listaClientes = get('lista');
		foreach ($listaClientes as $key => $cliente) {
			$cliente 			= unserialize($cliente);
		 
			$template->CODIGO 	= $cliente->getId();

			if( strcmp($cliente->getTipo(), "f") == 0){
				$template->CPF 		= mask($cliente->getCpf(),"###.###.###-##");
				$template->TIPO 	="Física";
			}else{
				$template->CPF 		= mask($cliente->getCpf(),"##.###.###/####-##");
				$template->TIPO 	="Jurídica";
			}
			
			if ($cliente->getAtivo() > 0) {
				$template->STATUS 	= "ATIVO";
				$template->CLASS 	= "info";
				$template->TITLE 	= "Alterar Contrato";
			}else{
				$template->STATUS 	= "INATIVO";
				$template->CLASS 	= "warning";
				$template->TITLE 	= "Criar Contrato";
			}
			
			$embarcacoes 			= $cliente->getEmbarcacao();
			if(count($embarcacoes) > 0 )
				$template->IDEMB 		= $embarcacoes[0]->getId();
			else
				$template->IDEMB 		= '';
			$template->NOME 		= $cliente->getNome();
			$template->block("LISTABODY");
		}
		
	}



 ?>