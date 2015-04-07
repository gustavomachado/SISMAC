<?php

require_once $path . 'generics/GenericDAO.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReciboDAO
 *
 * @author gustavo
 */
class ReciboDAO extends GenericDAO {

    public function getParameters() {

        $parametros = array("nome-emitente-recibo", "endereco-emitente-recibo", 
                            "cpf-cnpj-emitente-recibo","multa-atraso","juros-mes","nome-representante","cnpj-empresa");

        $banco = $this->getBanco();
        foreach ($parametros as $key) {
            $resultado = $banco->executaSQL("select * from marina.parametros as param where param.chave='". $key ."'");
            $resultado = $banco->fetchArray($resultado);
            #showDetails($resultado);
            $parametrosReturn[$key] = $resultado['valor'];
        }
        return $parametrosReturn;        
    }

}
