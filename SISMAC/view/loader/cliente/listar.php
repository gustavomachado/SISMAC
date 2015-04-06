<?php 
	require_once ( $path .  "model/Bean/Cliente.php");
	require_once ( $path .  "model/Bean/Embarcacao.php");
	require_once ( $path .  "model/Bean/Contrato.php");

	$template->SELECTED2 = "selected";
 
	$template->addFile("CONTENT",'view/template-client/cliente/listar.html');
	
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
				$template->STATUS 			= "ATIVO";
				$template->CLASS 			= "info";
		#		$template->TITLECONTRATO 	= "Alterar Contrato";
			}else{
				$template->STATUS 			= "INATIVO";
				$template->CLASS 			= "warning";
		#		$template->TITLECONTRATO 	= "Criar Contrato";
			}
			
			$embarcacoes 			= $cliente->getEmbarcacao();
			

			if(count($embarcacoes) > 1 ){
				 $template->ROWSPAN = count($embarcacoes) + 1;
				for($i = 0 ; $i < count($embarcacoes); $i++){

			#		$template->IDEMB 		= "&id=".$embarcacoes[$i]->getId();
					$template->EMBARCACAO 	= $embarcacoes[$i]->getNome();

					$template->block("LISTAEMB");
				}
			}else{
				if(count($embarcacoes) > 0 ){
					$template->EMBARCACAO 	= $embarcacoes[0]->getNome();	
			#		$template->IDEMB 		= "&id=" . $embarcacoes[0]->getId();
					
				}else{
			#		$template->IDEMB 		= '';
					$template->EMBARCACAO 	= '';

				}
				$template->ROWSPAN = 2;

				$template->block("LISTAEMB");

			}
			$template->NOME 		= $cliente->getNome();
			$template->block("LISTABODY");
			
		}
		
	}



 ?>