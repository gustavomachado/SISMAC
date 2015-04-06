<?php

session_start();
require_once '../../config.php';
require_once ( $path . 'resources/functions/functions.php');
require_once ( $path . 'utils/Banco.php');
require_once ( $path . 'model/Bean/Mensalidade.php');
require_once ( $path . 'model/Bean/Contrato.php');
require_once ( $path . 'model/Bean/Cliente.php');
require_once ( $path . 'model/DAO/MensalidadeDAO.php');
require_once ( $path . 'model/DAO/ContratoDAO.php');
require_once ( $path . 'model/DAO/ClienteDAO.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$method = $_REQUEST['m'];

switch ($method) {
    case 'baixar':
        baixar();
        break;
    case 'agrupar':
        agrupar();
        break;
}

function baixar() {

    $mes = date("m", strtotime(parseDateSQL($_REQUEST['data_vencimento'])));

    $idContrato = $_REQUEST['idContrato'];

    $cDAO = new ContratoDAO(new Banco());

    $contrato = $cDAO->pesquisar(new Contrato(), " id=$idContrato ");
    $contrato = $contrato[0];

    $clienteDAO = new ClienteDAO($cDAO->getBanco());
    $cliente = $clienteDAO->pesquisar(new Cliente(), "ativo=1 and id=" . $contrato->getIdCliente());
    $mDAO = new MensalidadeDAO(new Banco());
    if ($cliente) {
        if ($mes == 12) {
            $cDAO->renovarContrato($idContrato);
        }/* else {
          $mes++;
          $mensalidade = $mDAO->pesquisar(new Mensalidade(), "idcontrato=$idContrato and mesreferencia=$mes");
          $mensalidade = $mensalidade[0];
          $mensalidade->setAtivo(1);
          $mDAO->editar($mensalidade);
          } */
    }
    $acrescimo = (removeMascara($_REQUEST['multa'], 'R$,.') +
            removeMascara($_REQUEST['moradia'], 'R$,.') +
            removeMascara($_REQUEST['acrescimo'], 'R$,.')) / 100;
    $desconto = number_format((removeMascara($_REQUEST['desconto'], "R$,.") / 100), 2, ".", ",");

    $acrescimo = number_format($acrescimo, 2, ".", ",");

    /*

     * ((str_replace(",", ".", removeMascara( $_REQUEST['multa'], "R$."))  +
      str_replace(",", ".", removeMascara( $_REQUEST['moradia'], "R$."))  +
      str_replace(",", ".", removeMascara($_REQUEST['acrescimo'] , "R$."))) / 100);
     * 
     * 
     * echo $_REQUEST['datapagamento']."<br>";
      echo parseDateSQL($_REQUEST['datapagamento'])."<br>";
      echo strtotime($_REQUEST['datapagamento']) ."<br>";
      echo date("Y-m-d", strtotime($_REQUEST['datapagamento']));
     * 
      showDetails($_REQUEST);
      echo $acrescimo."<br>";
      echo $desconto."<br>";
      exit; */
    $dataPagamento = parseDateSQL($_REQUEST['datapagamento']);
    $formaPagamento = $_REQUEST['forma-pagamento'];

    $mensalidade = $mDAO->pesquisar(new Mensalidade(), " id = " . $_REQUEST['id']);
    $mensalidade = $mensalidade[0];
#showDetails($mensalidade);
    $mensalidade->setAcrescimo($acrescimo);
    $mensalidade->setDesconto($desconto);
    $mensalidade->setDataPagamento($dataPagamento);
    $mensalidade->setFormaPagamento($formaPagamento);
    $mensalidade->setAtivo(0);



        

    if (!$_REQUEST['r']) {
        if ($mDAO->editar($mensalidade)) {
            $_SESSION['title'] = "Sucesso";
            $_SESSION['msgbody'] = "Mensalidade baixada com sucesso";
            $_SESSION['msgclass'] = "msg-success";
            header("Location: /SISMAC/?c=mensalidade&v=buscar");
        } else {
            echo "here1";
        }
    } else if ($mDAO->editar($mensalidade)) {
        showDetails($cliente);
        set("recebido", $cliente[0]->getNome());
        set("referente", "Pagamento de mensalidade &agrave; marina &Aacute;guas Claras, relacionado ao servi&ccedil;o de hospedagem de embarca&ccedil;&otilde;es");
        header("Location: /SISMAC/reports/?v=recibo&id=" . $mensalidade->getId());
    } else {
        echo "here2";
    }
}

function agrupar() {

    $marcados = $_REQUEST['marcados'];
    $mensalidades = $_REQUEST['mensalidades'];
    $formaPagamento = $_REQUEST['forma_pagamento'];
    $dataPagamento = $_REQUEST['datapagamento'];

    $banco = new Banco();

    $banco->conecta();
    $cont_success = 0;
    $cont_fail = 0;
    foreach ($marcados as $chave => $totalParcial) {
        $dados = $mensalidades[$chave];

        $acrescimo = removeMascara($dados['acrescimo'], "R$.");
        $acrescimo += number_format($dados['multa-moradia'], 2, ".", ",");
        $sql = "update marina.mensalidade set "
                . " formapagamento='" . $formaPagamento . "', "
                . " dataPagamento='" . parseDateSQL($dataPagamento) . "',"
                . " desconto=" . str_replace(",", ".", removeMascara($dados['desconto'], "R$.")) . ","
                . " acrescimo=" . str_replace(",", ".", $acrescimo) . ","
                . " ativo=0 where id=" . $dados['idmensalidade'];
        if ($banco->executaSQL($sql))
            $cont_success++;
        else
            $cont_fail++;
    }

    set("title", "Sucesso");
    set("msgbody", "Baixa de mensalidades concluida com status:<br>Sucesso: $cont_success&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Falha: $cont_fail");
    set("msgclass", "msg-success");
    header("Location: /SISMAC/?c=cliente&v=ficha&id=" . $_REQUEST['id_cliente']);
}
