<?php
require_once $path . 'generics/GenericBean.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Recibo
 *
 * @author gustavo
 */
class Recibo extends GenericBean{
   
    private $referente;
    private $importancia;
    private $recebido;
    private $valor;
    private $idmensalidade;
    
    public function getIdRecibo(){
        return $this->getId();
    }
     public function setIdRecibo($id){
         $this->setId($id);
     }
             function getReferente() {
        return $this->referente;
    }

    function getImportancia() {
        return $this->importancia;
    }

    function getRecebido() {
        return $this->recebido;
    }

    function getValor() {
        return $this->valor;
    }

    function getIdmensalidade() {
        return $this->idmensalidade;
    }

    function setReferente($referente) {
        $this->referente = $referente;
    }

    function setImportancia($importancia) {
        $this->importancia = $importancia;
    }

    function setRecebido($recebido) {
        $this->recebido = $recebido;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setIdmensalidade($idmensalidade) {
        $this->idmensalidade = $idmensalidade;
    }


 

    
}
