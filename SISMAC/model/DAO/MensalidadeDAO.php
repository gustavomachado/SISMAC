<?php

require_once ( $path . "generics/GenericDAO.php");

/**
 * 
 */
class MensalidadeDAO extends GenericDAO {

    function __construct($banco) {
        parent::__construct($banco);
    }

    function excluir(Bean $bean) {
        $sql = "delete from marina.mensalidade where id=" . $bean->getId();

        echo "excluindo " . $this->getBanco()->executaSQL($sql);
    }

    /*  function pesquisar(Bean $bean, $where = 'true') {
      $result = parent::pesquisar($bean, $where);
      //  showDetails($result);
      return $result;
      } */

    function inserir(Bean $bean) {
        $sql = "INSERT INTO marina.mensalidade(acrescimo,desconto,idusuario,mesreferencia,idcontrato,ativo,anoreferencia)values("
                . $bean->getAcrescimo().","
                . $bean->getDesconto(). ","
                . $bean->getIdUsuario().","
                . $bean->getMesReferencia().","
                . $bean->getIdContrato().","
                . "'".$bean->getAtivo()."',"
                . $bean->getAnoReferencia()
                . ");";
        return $this->query($sql);        
    }
    
    function editar( Bean $bean){     
      /*   $mensalidade = $bean;
        if( $mensalidade->getFormaPagamento() > 0){
            return parent::editar($mensalidade);
        }
        
        $sql = "UPDATE marina.mensalidade SET "
                . " acrescimo=" . $mensalidade->getAcrescimo()." ,"
                . " desconto=" . $mensalidade->getDesconto() . " ,"
                . " "
                . "WHERE id = " . $mensalidade->getId();
        
       // echo $sql."<hr>";*/
      return  parent::editar($bean);
    }

}

?>