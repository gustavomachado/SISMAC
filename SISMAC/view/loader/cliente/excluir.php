<?php 

	require_once ( $path . "model/DAO/ClienteDAO.php");
	require_once ( $path . "model/Bean/Cliente.php");
	require_once ( $path . "model/DAO/MensalidadeDAO.php");
	require_once ( $path . "model/Bean/Mensalidade.php");


	$template->SELECTED2 = "selected";

	#include ('ficha.php');

#	$template->addFile("SIDEBAR",$viewsPath . "cliente/sibebar-excluir.html");

	$template->addFile("CONTENT",$viewsPath . "cliente/excluir.html");
	$template->addFile("FICHA", $viewsPath 	. "cliente/ficha.html");
	$template->addFile("SIDEBAR",$viewsPath . "cliente/sibebar-excluir.html");

	$dao = new ClienteDAO($banco);

	$cliente = $dao->pesquisar(new Cliente() , "id = " . $_GET['id']);
	$cliente = $cliente[0];

	if($cliente->getAtivo() == 0)
		$template->DISABLED = "disabled='disabled'";

	$template->NOMECLIENTE = $cliente->getNome();

	if(strcmp($cliente->getTipo(), "f") == 0){
		$template->TIPOREPRESENTANTE = "CONJUGUE";
		$template->CPFCLIENTE = mask($cliente->getCpf(),"###.###.###-##");
	}else{
		$template->TIPOREPRESENTANTE = "REPRESENTANTE";
		$template->CPFCLIENTE = mask($cliente->getCpf(),"##.###.###/####-##");
	}

	$template->DATANASC = parseDatePTBR($cliente->getDataNascimento());

	$template->CONJUGUE = $cliente->getConjugue();

	$daoContrato = new ContratoDAO($banco);

	$contratos = $daoContrato->pesquisar(new Contrato() , "idcliente = " . $_GET['id'] . " and ativo=1" );

	$template->NUMEROCONTRATOS = count($contratos);

	$daoMensalidade = new MensalidadeDAO($banco);

	$contMensalidades = 0;

	for ($i=0; $i < count($contratos); $i++) { 
		
		$mensalidades = $daoMensalidade->pesquisar(new Mensalidade(), "ativo=1 and idcontrato=" . $contratos[$i]->getId());

		$contMensalidades += count($mensalidades);

	}
	$telefones = $cliente->getTelefone();
	$stringTelefones = '';
	if( count($telefones) > 0 ){
		foreach ($telefones as $telefone) {
			$telAux = $telefone->getTelefone();
			if( strlen($telAux) > 9)
				$telAux = mask($telAux,"(###)#####-####");
			else if (strlen($telAux) == 8)
				$telAux = mask($telAux,"####-####");
			$stringTelefones .= $telAux .= ' ';
		}
	}
	$template->TELEFONES = $stringTelefones;
	$template->MENSALIDADESABERTO = $contMensalidades;

	$emails = $cliente->getEmail();

	if( count($emails) > 0){	
		$template->EMAIL = $emails[0]->getEmail();
	}

	$enderecos = $cliente->getEndereco();

	if( count($enderecos) > 0){
		$stringEnderecos = '';
		foreach ($enderecos as $endereco) {
			$stringEnderecos .= $endereco->getBairro() . " ";
		}
		$template->BAIRRO = $stringEnderecos;
	}
	if( $cliente->getAtivo() == 1)
		$template->STATUS = " CADASTRO ATIVO";
	else
		$template->STATUS = " CADASTRO INATIVO";
	$template->ID = $_GET['id'];


 ?>