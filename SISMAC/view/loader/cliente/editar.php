<?php

require_once ( $path . "model/DAO/ClienteDAO.php");
require_once ( $path . "model/DAO/TelefoneDAO.php");
require_once ( $path . "model/Bean/Cliente.php");
require_once ( $path . "utils/Banco.php");


$dao = new ClienteDAO(new Banco());

$daoTel = new TelefoneDAO($dao->getBanco());

$operadoras = array("0" => "Vivo", "1" => "Claro", "2" => "TIM", "3" => "OI");

$template->SELECTED2 = "selected";

$template->addFile("CONTENT", 'view/template-client/cliente/editar.html');
$template->addFile("SIDEBAR", "view/template-client/cliente/sidebar-editar.html");

$cliente = new cliente();

$cliente = $dao->pesquisar($cliente, " id = " . $_GET['id']);

$cliente = $cliente[0];

if (strcmp($cliente->getTipo(), "f") == 0)
    $template->block("FORMPF");
else
    $template->block("FORMPJ");

$telefones = $cliente->getTelefone();

if (count($telefones) < 1) {
    $template->TELCOUNTERV = 0;
} else {
    for ($i = 0; $i < count($telefones); $i++) {
        $template->TELCOUNTER = $i;
        $template->TELCOUNTERV = $i + 1;
        $template->TELCLIENTE = mask($telefones[$i]->getTelefone(), "(###)#####-####");
        $template->TELTIPO = $telefones[$i]->getTipo();
        $template->TELOPERADORA = $telefones[$i]->getOperadora();
        $template->ATIVOTEL = $telefones[$i]->getAtivo();
        $template->IDTEL = $telefones[$i]->getId();
        $template->block("TELEFONES");
        $template->block("LISTATELEFONES");
    }
}

$enderecos = $cliente->getEndereco();

if (count($enderecos) < 1) {
    $template->ENDCOUNTERV = 0;
} else {
    for ($i = 0; $i < count($enderecos); $i++) {
        $template->ENDCOUNTER = $i;
        $template->ENDCOUNTERV = $i + 1;
        $template->RUA = $enderecos[$i]->getRua();
        $template->BAIRRO = $enderecos[$i]->getBairro();
        $template->CIDADE = $enderecos[$i]->getCidade();
        $template->ESTADO = $enderecos[$i]->getEstado();
        $template->NUMERO = $enderecos[$i]->getNumero();
        $template->COMPLEMENTO = $enderecos[$i]->getComplemento();
        $template->REFERENCIA = $enderecos[$i]->getReferencia();
        $template->TIPOEND = $enderecos[$i]->getTipo();
        $template->CEP = mask($enderecos[$i]->getCep(), "#####-###");
        $template->ATIVOEND = $enderecos[$i]->getAtivo();
        $template->IDEND = $enderecos[$i]->getId();
        $template->block("ENDERECOS");
        $template->block("LISTAENDERECOS");
    }
}

$emails = $cliente->getEmail();

if (count($emails) < 1) {
    $template->EMAILCOUNTERV = 0;
} else {
    for ($i = 0; $i < count($emails); $i++) {
        $template->EMAILCOUNTER = $i;
        $template->EMAILCOUNTERV = $i + 1;
        $template->EMAIL = $emails[$i]->getEmail();
        $template->ATIVOEMAIL = $emails[$i]->getAtivo();
        $template->IDEMAIL = $emails[$i]->getId();
        $template->block("EMAILS");
        $template->block("LISTAEMAILS");
    }
}

$embarcacoes = $cliente->getEmbarcacao();

if (count($embarcacoes) < 1) {
    $template->EMBCOUNTERV = 0;
} else {
    for ($i = 0; $i < count($embarcacoes); $i++) {
        $template->EMBCOUNTER = $i;
        $template->EMBCOUNTERV = $i + 1;
        $template->EMBARCACAO = $embarcacoes[$i]->getNome();
        $template->MARCA = $embarcacoes[$i]->getMarcaMotor();
        $template->COR = $embarcacoes[$i]->getCor();
        $template->NUMEROCASCO = $embarcacoes[$i]->getCasco();
        $template->VENCIMENTO = $embarcacoes[$i]->getContrato()->getVencimento();
        $template->DATAINICIOCONTRATO = parseDatePTBR($embarcacoes[$i]->getContrato()->getDataInicio());
        $template->MENSALIDADE = mask($embarcacoes[$i]->getContrato()->getMensalidade(), "R$  ###############,00", true);
        $template->ATIVOCONTRATO = $embarcacoes[$i]->getContrato()->getAtivo();
        $template->IDEMB = $embarcacoes[$i]->getId();
        $template->TIPOCONTRATO = $embarcacoes[$i]->getContrato()->getTipo();
        //$template->DISABLED 		= "disabled='disabled'";
        $template->block("EMBARCACOES");
        $template->block("LISTAEMBARCACOES");
    }
}

$template->ID = $cliente->getId();
$template->NOMECLIENTE = $cliente->getNome();
$template->NOMECONJUGUE = $cliente->getConjugue();
$template->DATANASCIMENTO = parseDatePTBR($cliente->getDataNascimento());
$template->DATAINICIO   = parseDatePTBR($cliente->getDataInicio());
$template->CPFCLIENTE = $cliente->getCpf();
$template->RGCLIENTE = $cliente->getRg();
$template->CLIENTEATIVO = $cliente->getAtivo();

foreach ($operadoras as $value) {
    $template->OPERADORA = $value;
    $template->block("OPERADORAS");
}
?>