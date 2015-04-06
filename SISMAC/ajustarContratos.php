<?php

require_once('config.php');

require_once ($path . 'resources/functions/functions.php');
require_once ($path . 'utils/Banco.php');
require_once ($path . 'model/DAO/MensalidadeDAO.php' );
require_once ($path . 'model/DAO/ContratoDAO.php' );
require_once ($path . 'model/DAO/ClienteDAO.php' );
require_once ($path . 'model/DAO/EmbarcacaoDAO.php' );
require_once ($path . 'model/bean/Mensalidade.php' );
require_once ($path . 'model/bean/Contrato.php' );
require_once ($path . 'model/bean/Cliente.php' );
require_once ($path . 'model/bean/Embarcacao.php' );
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$banco = new Banco();
$mDAO = new MensalidadeDAO($banco);
$cDAO = new ContratoDAO($banco);
$eDAO = new EmbarcacaoDAO($banco);
$clienteDAO = new ClienteDAO($banco);
$clientes = $clienteDAO->pesquisarAlone(new Cliente(), " ativo = 1");
//   showDetails($clientes);
$i = 0;
foreach ($clientes as $cliente) {

    $contratos = $cDAO->pesquisar(new Contrato(), "idcliente=" . $cliente->getId());
    //    showDetails($contratos);
    foreach ($contratos as $contrato) {
        $embarcacoes = $eDAO->pesquisar(new Embarcacao(), "id = " . $contrato->getIdEmbarcacao());
        $embarcacao = $embarcacoes[0];
        $sql = "delete from marina.contrato where id=" . $contrato->getId();
        $cDAO->query($sql);
        $contratoAux = new Contrato();
        $contratoAux->setIdCliente($cliente->getId());
        $contratoAux->setIdEmbarcacao($embarcacao->getId());
        $contratoAux->setDataInicio(date("Y-m-d"));
        $contratoAux->setVencimento($contrato->getVencimento());
        $contratoAux->setMensalidade($contrato->getMensalidade());
        $contratoAux->setTipo($contrato->getTipo());
        $contratoAux->setAtivo(1);
        // showDetails($contrato);
        // showDetails($contratoAux);
        $cDAO->inserir($contratoAux, false);
        $i++;
    }
}

echo $i . " novos Contratos foram criados";
