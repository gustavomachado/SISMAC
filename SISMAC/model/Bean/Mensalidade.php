<?php

require_once ( $path . "generics/GenericBean.php");

/**
 * 
 */
class Mensalidade extends GenericBean {

    private $acrescimo=0;
    private $desconto=0;
    private $mesReferencia;
    private $formaPagamento=1;
    private $idContrato;
    private $idusuario;
    private $dataPagamento;
    private $anoReferencia;
    

    function __construct() {
        $this->mesReferencia = date("m");
        $this->anoReferencia = date("Y");
    }
    
    function getIdFormaPagamento() {
        return $this->idFormaPagamento;
    }

    function setIdFormaPagamento($idFormaPagamento) {
        $this->idFormaPagamento = $idFormaPagamento;
    }

    
    public function getDesconto() {
        return $this->desconto;
    }

    public function setDesconto($desconto) {
        $this->desconto = $desconto;
    }

    /**
     * Gets the value of acrescimo.
     *
     * @return mixed
     */
    public function getAcrescimo() {
        return $this->acrescimo;
    }

    /**
     * Sets the value of acrescimo.
     *
     * @param mixed $acrescimo the acrescimo
     *
     * @return self
     */
    public function setAcrescimo($acrescimo) {
        $this->acrescimo = $acrescimo;

        return $this;
    }

    /**
     * Gets the value of referencia.
     *
     * @return mixed
     */
    public function getMesReferencia() {
        return $this->mesReferencia;
    }

    /**
     * Sets the value of referencia.
     *
     * @param mixed $referencia the referencia
     *
     * @return self
     */
    public function setMesReferencia($referencia) {
        $this->mesReferencia = $referencia;

        return $this;
    }

    /**
     * Gets the value of formaPagamento.
     *
     * @return mixed
     */
    public function getFormaPagamento() {
        return $this->formaPagamento;
    }

    /**
     * Sets the value of formaPagamento.
     *
     * @param mixed $formaPagamento the forma pagamento
     *
     * @return self
     */
    public function setFormaPagamento($formaPagamento) {
        $this->formaPagamento = $formaPagamento;

        return $this;
    }

    /**
     * Gets the value of idContrato.
     *
     * @return mixed
     */
    public function getIdContrato() {
        return $this->idContrato;
    }

    /**
     * Sets the value of idContrato.
     *
     * @param mixed $idContrato the id contrato
     *
     * @return self
     */
    public function setIdContrato($idContrato) {
        $this->idContrato = $idContrato;

        return $this;
    }

    /**
     * Gets the value of idusuario.
     *
     * @return mixed
     */
    public function getIdusuario() {
        return $this->idusuario;
    }

    /**
     * Sets the value of idusuario.
     *
     * @param mixed $idusuario the idusuario
     *
     * @return self
     */
    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Gets the value of dataPagamento.
     *
     * @return mixed
     */
    public function getDataPagamento() {
        return $this->dataPagamento;
    }

    /**
     * Sets the value of dataPagamento.
     *
     * @param mixed $dataPagamento the data pagamento
     *
     * @return self
     */
    public function setDataPagamento($dataPagamento) {
        $this->dataPagamento = $dataPagamento;

        return $this;
    }

    public function getAnoReferencia() {
        return $this->anoReferencia;
    }

    public function setAnoReferencia($anoReferencia) {
        $this->anoReferencia = $anoReferencia;
    }

    function getStatusMensalidade(Contrato $contrato) {

        if ($this->ativo) {
            return calculaDiasAtraso();
        }
    }

    private function calculaDiasAtraso() {
        
    }

    private function calculaDiasPago() {
        
    }
    /*
      public function getDataVencimento(Contrato $contrato) {
        $mes = $this->getMesReferencia();
        $ano = $this->getAnoReferencia();
        $dia = $contrato->getVencimento();
        if (strcasecmp(date("Y-m", strtotime($contrato->getDataInicio())), date("Y-m")) == 0) {
            if (strcmp("pre", $contrato->getTipo()) == 0) {
                $dia = date('d', strtotime($contrato->getDataInicio()));
            } else if ($contrato->getVencimento() < date('d', strtotime($contrato->getDataInicio()))) {
                $mes++;
            }
        } else if (strcmp("pos", $contrato->getTipo()) == 0) {
            $mes++;
        }
//echo $contrato->getDataInicio();exit;
        if ($mes > 12) {
            $ano++;
            $mes = 01;
        }
        $diaMax = date('t', mktime(0, 0, 0, $mes, 1, $ano));
//echo "$ano-$mes-$dia<br>diamax = $diaMax<br>dia=$dia<br>";
        if ($dia > $diaMax) {
            $dia = $diaMax;
        }
       return date("Y-m-d", strtotime("$ano-$mes-$dia"));
    }
    
*/
    public function getDataVencimento(Contrato $contrato) {
        $mes = $this->getMesReferencia();
        $ano = $this->getAnoReferencia();
        $dia = $contrato->getVencimento();
        if (strcasecmp(date("Y-m", strtotime($contrato->getDataInicio())), date("Y-m")) == 0) {
          //  echo "if 1<br>";
            if (strcmp("pre", $contrato->getTipo()) == 0) {
          //      echo "if 1 1<br>";
                $dia = date('d', strtotime($contrato->getDataInicio()));
            } else if ($contrato->getVencimento() < date('d', strtotime($contrato->getDataInicio()))) {
          //      echo "else if 1<br>";
                $mes++;
            }
        } else if (strcmp("pos", $contrato->getTipo()) == 0) {
            if($dia > date('d')){
                $mes--;
            }
         //   echo "else if 2<br>";
            $mes++;
        }
        if ($mes > 12) {
            $ano++;
            $mes = 01;
        }
        $diaMax = date('t', mktime(0, 0, 0, $mes, 1, $ano));
        if ($dia > $diaMax) {
            $dia = $diaMax;
        }
       return date("Y-m-d", strtotime("$ano-$mes-$dia"));
    }

}

?>