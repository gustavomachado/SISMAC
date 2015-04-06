<?php

require_once ( $path . "model/DAO/ClienteDAO.php");
require_once ( $path . "model/Bean/Cliente.php");
require_once ( $path . "model/DAO/MensalidadeDAO.php");
require_once ( $path . "model/Bean/Mensalidade.php");

$template->SELECTED2 = "selected";
$template->addFile("CONTENT", $viewsPath . "cliente/ficha.html");

$template->addFile("SIDEBAR", $viewsPath . "cliente/sidebar-excluir.html");

$dao = new ClienteDAO($banco);

$cliente = $dao->pesquisar(new Cliente(), "id = " . $_GET['id']);
$cliente = $cliente[0];


if ($cliente->getAtivo() == 0)
    $template->DISABLED = "disabled='disabled'";

$template->NOMECLIENTE = $cliente->getNome();

if (strcmp($cliente->getTipo(), "f") == 0) {
    $template->TIPOREPRESENTANTE = "CONJUGUE";
    $template->CPFCLIENTE = mask($cliente->getCpf(), "###.###.###-##");
} else {
    $template->TIPOREPRESENTANTE = "REPRESENTANTE";
    $template->CPFCLIENTE = mask($cliente->getCpf(), "##.###.###/####-##");
}

$template->DATANASC = parseDatePTBR($cliente->getDataNascimento());

$template->CONJUGUE = $cliente->getConjugue();

$daoContrato = new ContratoDAO($banco);

$contratos = $daoContrato->pesquisar(new Contrato(), "idcliente = " . $_GET['id']);
$daoMensalidade = new MensalidadeDAO($banco);
$ativos = 0;
$contMensalidades = 0;
$string = "(";
foreach ($contratos as $c) {
    if ($c->getAtivo()) {
        $ativos++;
    }
    $mensalidades = $daoMensalidade->pesquisar(new Mensalidade(), "ativo=1 and idcontrato=" . $c->getId());
    foreach ($mensalidades as $mensalidade) {
        $string .= $mensalidade->getId() . ",";
    }
    $contMensalidades += count($mensalidades);
}

$string = substr($string, 0, strlen($string) - 1) . ")";

if (strlen($string) > 1) {
    $template->FILTRO = "&ids=$string";
}
 

$template->NUMEROCONTRATOS = $ativos;

$telefones = $cliente->getTelefone();
$stringTelefones = '';
if (count($telefones) > 0) {
    foreach ($telefones as $telefone) {
        $telAux = $telefone->getTelefone();
        if (strlen($telAux) > 9)
            $telAux = mask($telAux, "(###)#####-####");
        else if (strlen($telAux) == 8)
            $telAux = mask($telAux, "####-####");
        $stringTelefones .= $telAux .= ' ';
    }
}
$template->TELEFONES = $stringTelefones;
$template->MENSALIDADESABERTO = $contMensalidades;

$emails = $cliente->getEmail();

if (count($emails) > 0) {
    $template->EMAIL = $emails[0]->getEmail();
}

$enderecos = $cliente->getEndereco();

if (count($enderecos) > 0) {
    $stringEnderecos = '';
    foreach ($enderecos as $endereco) {
        $stringEnderecos .= $endereco->getBairro() . " ";
    }
    $template->BAIRRO = $stringEnderecos;
}
if ($cliente->getAtivo() == 1)
    $template->STATUS = " CADASTRO ATIVO";
else
    $template->STATUS = " CADASTRO INATIVO";
$template->ID = $_GET['id'];
?>