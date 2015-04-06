<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$template->SELECTED4 = "selected";

$template->addFile("CONTENT", "view/template-client/parametros/configurar.html");
$banco = new Banco();
$banco->conecta();

$resultado = $banco->executaSQL("SELECT * FROM marina.formapagamento WHERE ativo=1");
 
while($linha = $banco->fetchArray($resultado)){
   $template->FORMA_PAGAMENTO = $linha['descricao'];
   $template->block('FORMAS_PAGAMENTO');
}
 
$resultado = $banco->executaSQL("SELECT * FROM marina.formapagamento WHERE ativo=0");
 
while($linha = $banco->fetchArray($resultado)){
   $template->FORMA_PAGAMENTO = $linha['descricao'];
   $template->block('FORMAS_PAGAMENTO_INATIVAS');
}
 
