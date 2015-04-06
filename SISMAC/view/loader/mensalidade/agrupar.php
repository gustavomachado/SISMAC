<?php

require_once $path . 'model/Bean/Cliente.php';
require_once $path . 'model/Bean/Recibo.php';
require_once $path . 'model/Bean/Contrato.php';
require_once $path . 'model/Bean/Embarcacao.php';
require_once $path . 'model/Bean/Mensalidade.php';
require_once $path . 'model/Bean/FormaPagamento.php';
require_once $path . 'model/DAO/ReciboDAO.php';
require_once $path . 'model/DAO/ClienteDAO.php';
require_once $path . 'model/DAO/ContratoDAO.php';
require_once $path . 'model/DAO/EmbarcacaoDAO.php';
require_once $path . 'model/DAO/MensalidadeDAO.php';
require_once $path . 'model/DAO/FormaPagamentoDAO.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$template->SELECTED5 = "selected";
$template->addFile("CONTENT", $viewsPath . "/mensalidade/agrupar.html");

$id = $_GET['id'];

$dao = new ClienteDAO(new Banco());

$cliente = $dao->pesquisar(new Cliente(), " id=$id");
$cliente = $cliente[0];

$embarcacoes = $cliente->getEmbarcacao();
$mDAO = new MensalidadeDAO($dao->getBanco());
$countMensalidade = 0;
$mensalidade = array();

foreach ($embarcacoes as $emb) {
    $mensalidade[$emb->getNome()] = $mDAO->pesquisar(new Mensalidade(), "ativo=1 and idcontrato=" . $emb->getContrato()->getId());
    $mensalidade[$emb->getNome()]['contrato'][$emb->getNome()] = $emb->getContrato();
    $countMensalidade+= count($mensalidade[$emb->getNome()]) - 1;
}

//showDetails($mensalidade);
if ($countMensalidade > 0) {

    $banco = $dao->getBanco();
    $result = $banco->executaSQL("select * from marina.parametros where chave in ('multa-atraso','juros-mes')");
    $parametros = array();
    while ($linha = $banco->fetchArray($result)) {
        $parametros[$linha['chave']] = $linha['valor'];
    }

    foreach ($mensalidade as $emb => $m) {
        $template->EMBARCACAO = $emb;
        $total = 0;
        $valor = 0;
        foreach ($m as $mens) {
            if (!is_array($mens)) {
                
                $dataVencimento = $mens->getDataVencimento($mensalidade[$emb]['contrato'][$emb]);
                
                $valor = ($mensalidade[$emb]['contrato'][$emb]->getMensalidade() );
                $desconto = ($mens->getDesconto() );
                $acrescimo = ($mens->getAcrescimo() );
                $totalParcial = $valor;
                $totalParcial += $acrescimo;
                $totalParcial -= $desconto;                
                $multaMoraDia = 0;
                if (date("Y-m-d") > $dataVencimento) {
                    $moraDia = $parametros['juros-mes'] / date("t", strtotime($dataVencimento));
                    $valorMulta = $valor * $parametros['multa-atraso'] / 100;
               #     echo $valorMulta."<br>";
                    $diferenca = strtotime(date("Y-m-d")) - strtotime($dataVencimento);
                #    echo $diferenca."<br>";
                    $diasVencido = floor($diferenca / (60 * 60 * 24));
                    #  echo $diasVencido."<br>";
                    $multaMoraDia += $valorMulta + ( $valor * ($diasVencido * $moraDia) / 100 );
                }
#echo $multaMoraDia."<br>";
#echo $totalParcial."<br>";
                $totalParcial+= $multaMoraDia;
               
                
                $template->MENSALIDADE = $mens->getMesReferencia();
                $template->MENSALIDADE_EXT = getMesExtenso($mens->getMesReferencia());
                $template->DATAVENCIMENTO = parseDatePTBR($mens->getDataVencimento($mensalidade[$emb]['contrato'][$emb]));
                $template->VALOR = number_format($valor, 2, ",", ".");
                $template->MULTA_MORADIA = $multaMoraDia;
                $template->ACRESCIMO = number_format($acrescimo, 2, ",", ".");
                $template->DESCONTO = number_format($desconto, 2, ",", ".");
                $template->TOTALPARCIAL = number_format($totalParcial, 2, ",", ".");
                $template->ID = $mens->getId();
                $template->ID_EMB = $mensalidade[$emb]['contrato'][$emb]->getIdEmbarcacao();
                $total += $totalParcial;
                $template->block("MENSALIDADES");
            }
        }
        $template->TOTAL = number_format($total, 2, ",", ".");
        $template->block("LISTA");
    }

    $fpDAO = new FormaPagamentoDAO(new Banco());
    $listaFormaPagamento = $fpDAO->pesquisar(new FormaPagamento(), " true order by descricao");

    foreach ($listaFormaPagamento as $forma) {
        $template->DESCRICAO_FP = $forma->getDescricao();
        $template->ID_FP = $forma->getId();
        $template->block("LISTA_FP");
    }
    $template->block("SUBMIT");
}
$template->HOJE = date("d/m/Y");
$template->COUNT_MENSALIDADE = $countMensalidade;
$template->COUNT_EMB = count($embarcacoes);
$template->CLIENTE = $cliente->getNome();
$template->ID_CLIENTE = $id;
