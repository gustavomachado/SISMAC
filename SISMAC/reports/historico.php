<?php

session_start();
require_once $path . 'utils/Banco.php';
require_once $path . 'model/Bean/Mensalidade.php';
require_once $path . 'model/Bean/Contrato.php';
require_once $path . 'model/Bean/Embarcacao.php';
require_once $path . 'model/Bean/Cliente.php';
require_once $path . 'model/Bean/FormaPagamento.php';
require_once $path . 'model/DAO/ReciboDAO.php';
require_once $path . 'model/DAO/FormaPagamentoDAO.php';
require_once $path . 'model/DAO/MensalidadeDAO.php';
require_once $path . 'model/DAO/ContratoDAO.php';
require_once $path . 'model/DAO/EmbarcacaoDAO.php';
require_once $path . 'model/DAO/ClienteDAO.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (isset($_REQUEST['id'])) {

    $idCliente = $_REQUEST['id'];

    $clienteDAO = new ClienteDAO((new Banco()));
    $cliente = $clienteDAO->pesquisarAlone(new Cliente(), " id = $idCliente");
    if (!$cliente) {
        throw new Exception("Cliente não encontrado");
    }
    $cliente = $cliente[0];
    //showDetails($cliente);exit;
    if (strcasecmp($cliente->getTipo(), "f") == 0) {
        $_CPF_CNPJ = mask($cliente->getCpf(), "###.###.###-##");
    } else {
        $_CPF_CNPJ = mask($cliente->getCpf(), "##.###.###/####-##");
    }
    $template->NOME_CLIENTE = $cliente->getNome();
    $template->NOME_CONJUGUE = $cliente->getConjugue();
    $template->RG = $cliente->getRg();
    $template->DATA_INICIO_CLIENTE = parseDatePTBR($cliente->getDataInicio());
    $template->DATA_NASCIMENTO = parseDatePTBR($cliente->getDataNascimento());
    $template->CPF_CNPJ = $_CPF_CNPJ;

    $resultado = $clienteDAO->query(""
            . " select distinct "
            . " e.* "
            . " from "
            . " marina.embarcacao as e"
            . " inner join marina.contrato as c on c.idembarcacao = e.id"
            . " where c.idcliente=" . $cliente->getId());


    //   $listaEmbarcacao = array();
    $contratoDAO = new ContratoDAO($clienteDAO->getBanco());

    while ($linha = $clienteDAO->fetch($resultado)) {
        //$listaEmbarcacao[] = new Embarcacao($linha);
        $embarcacao = new Embarcacao($linha);

        $template->NOME_EMBARCACAO = $embarcacao->getNome();
        $template->COR_EMBARCACAO = $embarcacao->getCor();
        $template->CASCO_EMBARCACAO = $embarcacao->getCasco();
        $template->MOTOR_EMBARCACAO = $embarcacao->getMarcamotor();

        $contratos = $contratoDAO->pesquisar(new Contrato(), "idembarcacao=" . $embarcacao->getId() . " order by ativo desc ,datainicio desc");
        $mensalidadeDAO = new MensalidadeDAO($clienteDAO->getBanco());

        foreach ($contratos as $contrato) {
            $template->ID_CONTRATO = $contrato->getId();
            if (strcasecmp($contrato->getTipo(), "pre") == 0) {
                $template->TIPO_CONTRATO = "PR&Eacute;-PAGO";
            } else {
                $template->TIPO_CONTRATO = "P&Oacute;S-PAGO";
            }
            $template->DIA_VENCIMENTO = $contrato->getVencimento();
            $template->VALOR_CONTRATO = number_format($contrato->getMensalidade(), "2", ",", ".");
            $template->VALOR_CONTRATO = number_format($contrato->getMensalidade(), "2", ",", ".");
            $template->DATA_INICIO_CONTRATO = parseDatePTBR($contrato->getDataInicio());
            if ($contrato->getAtivo()) {
                $template->DATA_FIM_CONTRATO = "Data Atual.";
            } else {
                $template->DATA_FIM_CONTRATO = parseDatePTBR($contrato->getDataFim());
            }
            $sql = "SELECT anoreferencia FROM mensalidade WHERE idcontrato=" . $contrato->getId() . " GROUP BY anoreferencia ORDER BY anoreferencia desc ";

            $mensResult = $mensalidadeDAO->query($sql);

            while ($linhaMens = $mensalidadeDAO->fetch($mensResult)) {
                $mensalidades = $mensalidadeDAO->pesquisar(new Mensalidade(), " idcontrato=" . $contrato->getId() .
                        " and anoreferencia=" . $linhaMens['anoreferencia'] . " order by id asc");
                $template->ANO_REFERENCIA = $linhaMens['anoreferencia'];
                foreach ($mensalidades as $mensalidade) {
                    $template->MES_REFERENCIA = getMesExtenso($mensalidade->getMesReferencia());
                    $template->DATA_VENCIMENTO_MENSALIDADE = parseDatePTBR($mensalidade->getDataVencimento($contrato));
                    $dataPagamento = parseDatePTBR($mensalidade->getDataPagamento());
                    if ($mensalidade->getFormaPagamento() > 0) {
                        $formaPagamentoDAO = new FormaPagamentoDAO($mensalidadeDAO->getBanco());
                        $forma = $formaPagamentoDAO->pesquisar(new FormaPagamento(), " id = " . $mensalidade->getFormaPagamento());
                        $forma = $forma[0];
                        $status = "Quitada";
                        $template->DATA_PAGAMENTO_MENSALIDADE = $dataPagamento;
                        $template->FORMA_PAGAMENTO = $forma->getDescricao();
                    } else {
                        $template->DATA_PAGAMENTO_MENSALIDADE = "xx/xx/xxxx";
                        $template->FORMA_PAGAMENTO = "N&atilde;o paga";
                        $status = "Em aberto";
                    }
                    $template->STATUS = $status;
                    $template->block("MENSALIDADES_MES");
                }
                $template->block("MENSALIDADES_ANO");
            }
            $template->block("CONTRATOS");
        }
    }
    //showDetails($listaEmbarcacao);
    //exit;
    //$embarcacaoDAO = new EmbarcacaoDAO($clienteDAO->getBanco());
    //$embarcacoes = $embarcacaoDAO->pesquisar(new Embarcacao(), "id=");
    //$contratoDAO = new ContratoDAO(new Contrato(), " id=" . $cliente->getId() . " order by datainicio desc");
} else {
    
}
?>
