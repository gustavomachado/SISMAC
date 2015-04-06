<?php

session_start();
require_once ('../../config.php');
require_once ( $path . 'utils/Banco.php');
require_once ( $path . 'resources/functions/functions.php');
require_once ( $path . 'model/Bean/Cliente.php');
require_once ( $path . 'model/Bean/Telefone.php');
require_once ( $path . 'model/Bean/Endereco.php');
require_once ( $path . 'model/Bean/Email.php');
require_once ( $path . 'model/Bean/Embarcacao.php');
require_once ( $path . 'model/Bean/Contrato.php');
require_once ( $path . 'model/Bean/Mensalidade.php');
require_once ( $path . 'model/Bean/Usuario.php');
require_once ( $path . 'model/DAO/ClienteDAO.php');
require_once ( $path . 'model/DAO/EmailDAO.php');
require_once ( $path . 'model/DAO/EnderecoDAO.php');
require_once ( $path . 'model/DAO/EmbarcacaoDAO.php');
require_once ( $path . 'model/DAO/TelefoneDAO.php');
require_once ( $path . 'model/DAO/ContratoDAO.php');


switch ($_GET['m']) {
    case 'alterar_contrato':
        alterarContrato();
        break;
    case 'excluir':
        excluir();
        break;
}

function alterarContrato() {

  
    $idContratoAtigo = $_POST['id_contrato_antigo'];
    $contratoDAO = new ContratoDAO(new Banco());
    $contrato = $contratoDAO->pesquisar(new Contrato(), " id=$idContratoAtigo");
    $contrato = $contrato[0];   
    $contrato->setAtivo(0); 
    $contratoDAO->excluir($contrato);

    $contratoNovo = new Contrato();
    $contratoNovo->setAtivo(1);
    $contratoNovo->setDataInicio(date("Y-m-d"));
    $contratoNovo->setIdCliente($_POST['id_cliente']);
    $contratoNovo->setIdEmbarcacao($_POST['id_embarcacao']);
    $contratoNovo->setMensalidade(str_replace(",", ".", removeMascara($_POST['valor'], "R$.")));
    $contratoNovo->setTipo($_POST['tipo']);
    $contratoNovo->setVencimento($_POST['vencimento']);
    
    $contratoDAO->inserir($contratoNovo);
    
 
    
    set("title", "sucesso");
    set("msgbody", "Contrato alterado com sucesso.");
    set("msgclass", "msg-success");
    
    header("Location: /SISMAC/?c=cliente&v=editar&id=" . $_POST['id_cliente'] );
}

function excluir() {

    $id = $_REQUEST['id_emb'];
    $embDAO = new EmbarcacaoDAO(new Banco());
    $embarcacao = $embDAO->pesquisar(new Embarcacao(), " id=$id");
    $embarcacao = $embarcacao[0];
    $embarcacao->setAtivo(0);
    $embDAO->editar($embarcacao);

    $cDAO = new ContratoDAO($embDAO->getBanco());
    $contrato = $cDAO->pesquisar(new Contrato(), " idembarcacao=$id");
    $contrato = $contrato[0];
    $contrato->setAtivo(0);
    $cDAO->excluir($contrato);


    set("title", "sucesso");
    set("msgbody", "Embarcação excluida com sucesso");
    set("msgclass", "msg-success");


    header("Location: /SISMAC/?c=cliente&v=editar&id=" . $contrato->getIdCliente());
}

?>