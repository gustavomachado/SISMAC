<?php

require_once( $path . "model/DAO/MensalidadeDAO.php");
require_once( $path . "model/DAO/ContratoDAO.php");
require_once( $path . "model/DAO/ClienteDAO.php");
require_once( $path . "model/DAO/EmbarcacaoDAO.php");
require_once( $path . "model/Bean/Embarcacao.php");
require_once( $path . "model/Bean/Mensalidade.php");
require_once( $path . "model/Bean/Contrato.php");
require_once( $path . "model/Bean/Cliente.php");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$template->SELECTED5 = "selected";

$template->addFile("CONTENT", $viewsPath . "mensalidade/buscar.html");

$embarcacaoDAO = new EmbarcacaoDAO($banco);

$sql = ("select emb.*  from marina.embarcacao emb
            inner join marina.contrato as c on c.idembarcacao = emb.id
            inner join marina.mensalidade as mens on mens.idcontrato = c.id
            where mens.ativo=1 ");

if (isset($_GET['ids'])) {
    $sql .= " and mens.id in " . $_GET['ids'];
}

$sql .= "group by emb.nome order by emb.nome asc;";

#echo $sql;

$resultado = $embarcacaoDAO->query($sql);

$contratoDAO = new ContratoDAO($banco);
$clienteDAO = new ClienteDAO($banco);
$mensalidadeDAO = new MensalidadeDAO($banco);
$counter = 0;
while ($linha = $embarcacaoDAO->fetch($resultado)) {
    $contratos = $contratoDAO->pesquisar(new Contrato(), "idembarcacao=" . $linha['id']);
    //$listaMensalidades = $mensalidadeDAO->pesquisar(new Mensalidade(), " ativo=1 and mesreferencia<=" . date('m'));
    foreach ($contratos as $contrato) {
      #  showDetails($contrato);
        $listaMensalidades = $mensalidadeDAO->pesquisar(new Mensalidade(), " ativo=1 and idcontrato=" . $contrato->getId());
        $cliente = $clienteDAO->pesquisar(new Cliente(), "id = " . $contrato->getIdCliente());
        $cliente = $cliente[0];
        $counter += count($listaMensalidades);
        foreach ($listaMensalidades as $mensalidade) {
            if ($contrato->getAtivo()) {
                $template->STATUS = "Ativo";
            } else {
                $template->STATUS = "Inativo";
            }
            $diaVencimento = ($contrato->getVencimento());
            $template->MESMENSALIDADE = $mensalidade->getMesReferencia();
            $template->VENCIMENTO = $contrato->getVencimento();
            $template->VALOR = "R$ " . number_format($contrato->getMensalidade() - $mensalidade->getDesconto() + $mensalidade->getAcrescimo(), 2, ",", ".");
            $template->EMBARCACAO = $linha['nome'];
            $template->DONO = $cliente->getNome();
            $template->TIPO = $contrato->getTipo();
            $template->IDMENSALIDADE = $mensalidade->getId();

            $template->block("LISTAMENSALIDADES");
        }
    }
}
//echo $counter;
/*
foreach ($listaMensalidades as $mensalidade) {
    $contrato = $contratoDAO->pesquisar(new Contrato(), " id = " . $mensalidade->getIdContrato());
    $contrato = $contrato[0];

    # showDetails($contrato);
    $cliente = $clienteDAO->pesquisar(new Cliente(), "id = " . $contrato->getIdCliente());
    $cliente = $cliente[0];

    $embarcacao = $embarcacaoDAO->pesquisar(new Embarcacao(), "id = " . $contrato->getIdEmbarcacao());
    $embarcacao = $embarcacao[0];

    if ($contrato->getAtivo()) {
        $template->STATUS = "Ativo";
    } else {
        $template->STATUS = "Inativo";
    }

    $diaVencimento = ($contrato->getVencimento());

    $template->MESMENSALIDADE = $mensalidade->getMesReferencia();
    $template->VENCIMENTO = $contrato->getVencimento();
    $template->VALOR = "R$ " . number_format($contrato->getMensalidade() - $mensalidade->getDesconto() + $mensalidade->getAcrescimo(), 2, ",", ".");
    $template->EMBARCACAO = $embarcacao->getNome();
    $template->DONO = $cliente->getNome();
    $template->TIPO = $contrato->getTipo();
    $template->IDMENSALIDADE = $mensalidade->getId();

    $template->block("LISTAMENSALIDADES");
}*/




