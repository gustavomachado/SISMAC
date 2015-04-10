<?php

require_once('config.php');
require_once ($path . 'resources/functions/functions.php');
require_once ( $path . 'model/DAO/EmbarcacaoDAO.php');
require_once ( $path . 'model/bean/Embarcacao.php');
require_once ($path . 'utils/Banco.php');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$embarcacao = $_REQUEST['embarcacao'];

$embDAO = new EmbarcacaoDAO(new Banco());

$embarcacoes = $embDAO->pesquisar(new Embarcacao()," nome like '%$embarcacao%' and ativo=1");

$embarcacoesArray = array();

foreach ($embarcacoes as $embObj){
    $embarcacoesArray[] = objectToArray($embObj);
}

echo json_encode($embarcacoesArray);


