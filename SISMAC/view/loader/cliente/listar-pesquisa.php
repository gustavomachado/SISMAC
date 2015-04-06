<?php 
	require_once ( $path .  "model/Bean/Cliente.php");
	require_once ( $path .  "model/Bean/Embarcacao.php");
	require_once ( $path .  "model/Bean/Contrato.php");
  
        $template->addFile("LISTARESULTADO",'view/template-client/cliente/listar-pesquisa.html');
	if ( ! isset($remove) )
		$remove = false;

	if (isset($_SESSION['lista'])) {
		
		$listaClientes = get('lista',$remove);

		foreach ($listaClientes as $key => $cliente) {
			$cliente 			= unserialize($cliente);
			$template->NOME 		= $cliente->getNome();
                        $template->CODIGO               = $cliente->getId();
			$template->block("LISTABODY");
		}
		
	} 
        
       



 ?>