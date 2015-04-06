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
require_once ($path . 'resources/lib/raelgc/view/Template.php');
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
 

/* * ********   BEGIN Controle Mensalidades   ************* */
  $count = 0;
  $contratos = $cDAO->pesquisar(new Contrato(), "ativo = 1");
  foreach ($contratos as $contrato) {

  $mensalidades = $mDAO->pesquisar(new Mensalidade(), " idcontrato=" . $contrato->getId() . " and ativo=0 order by mesreferencia asc limit 1");
  $mensalidade = $mensalidades[0];
  $dataVencimento = $mensalidade->getDataVencimento($contrato);
  $diferenca = strtotime($dataVencimento) - strtotime(date("Y-m-d"));
  $diasParaVencer = floor($diferenca / (60 * 60 * 24));
  /*  echo date("Y-m-d") ." - ". ($dataVencimento). " - " . ( $diasVencido)." - " . $contrato->getTipo()
  . " - " . $contrato->getDataInicio().  "<br>"; */
  $mDAO->editar($mensalidade);
  if ($diasParaVencer <= 15) {

  $count += $mDAO->query("UPDATE marina.mensalidade SET ativo=1 WHERE ID = " . $mensalidade->getId());
  } else {
  //echo "fazendo nada";
  }
  }

  /* * ********   END Controle Mensalidades   **************/

 
?>