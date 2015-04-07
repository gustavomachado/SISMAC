<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$template->SELECTED4 = "selected";
$i = 0;
$j = 0;
$uLogado = unserialize($_SESSION['usuario']);
if ($uLogado->getIdPerfil() == 1) {

    $template->addFile("CONTENT", "view/template-client/parametros/configurar.html");
    $banco = new Banco();
    $banco->conecta();

    $resultado = $banco->executaSQL("SELECT * FROM marina.formapagamento WHERE ativo=1");

    while ($linha = $banco->fetchArray($resultado)) {
        $template->FORMA_PAGAMENTO = $linha['descricao'];
        $template->block('FORMAS_PAGAMENTO');
        $i++;
    }

    $template->COUNT_ATIVAS = $i;
    $resultado = $banco->executaSQL("SELECT * FROM marina.formapagamento WHERE ativo=0");

    while ($linha = $banco->fetchArray($resultado)) {
        $template->FORMA_PAGAMENTO = $linha['descricao'];
        $template->block('FORMAS_PAGAMENTO_INATIVAS');
        $j++;
    }
  $template->COUNT_INATIVAS = $j;
    $resultado = $banco->executaSQL("SELECT * FROM marina.parametros ");

    while ($linha = $banco->fetchArray($resultado)) {
        $chave = strtoupper(str_replace("-", "_", $linha['chave']));
        $template->{"$chave"} = $linha['valor'];
    }
}
