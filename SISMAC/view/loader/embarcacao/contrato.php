<?php 

	require_once ( $path . "model/DAO/ContratoDAO.php");
	require_once ( $path . "model/Bean/Contrato.php");
	require_once ( $path . "model/Bean/Cliente.php");
	require_once ( $path . "model/DAO/ClienteDAO.php");
	
	$template->addFile("CONTENT",$viewsPath . "embarcacao/contrato.html");

	$template->SELECTED3 = "selected";

	if(strlen($_GET['id']) > 0){
		$contratoDAO = new ContratoDAO($banco);
		$contrato = $contratoDAO->pesquisar(new Contrato() , "idembarcacao = " . $_GET['id'] . " and ativo = 1" );
		$contrato = $contrato[0];
		$clienteDAO = new ClienteDAO($banco);
		$cliente = $clienteDAO->pesquisar(new Cliente() , "id = " . $contrato->getIdCLiente());
		$cliente = $cliente[0];
                $embarcacaoDAO  = new EmbarcacaoDAO($contratoDAO->getBanco());
                $embarcacao = $embarcacaoDAO->pesquisar(new Embarcacao(), "id=".$_GET['id']);
                $embarcacao = $embarcacao[0];
                // showDetails($embarcacao);
                if(strcasecmp($contrato->getTipo(), "pre") == 0){
                    $template->TIPO = "Pré-Pago";
                }else{
                    $template->TIPO = "Pós-Pago";
                }
                $template->VENCIMENTO = $contrato->getVencimento();
                $template->VALOR = number_format($contrato->getMensalidade(),2,",",".");
                $template->IDCADASTROANTIGO = $contrato->getId();
                $template->NOMECLIENTE = $cliente->getNome();
                $template->IDCLIENTE = $cliente->getId();
                $template->NOMEEMB = $embarcacao->getNome();
                $template->IDEMB = $embarcacao->getId();
                $template->DATA = date("d/m/Y");
	}

 ?>