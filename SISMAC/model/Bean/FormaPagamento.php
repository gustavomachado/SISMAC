<?php
require_once ( $path . "generics/GenericBean.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormaPagamento
 *
 * @author gustavo
 */
class FormaPagamento extends GenericBean{
    //put your code here
    private $descricao;
    
    function getDescricao() {
        return $this->descricao;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }


}
