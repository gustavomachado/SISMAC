<?php

require_once ( $path . "generics/GenericBean.php");

/**
 * 
 */
class Embarcacao extends GenericBean {

    private $cor;
    private $marcamotor;
    private $contrato;
    private $casco;

     

    /**
     * Gets the value of cor.
     *
     * @return mixed
     */
    public function getCor() {
        return $this->cor;
    }

    /**
     * Sets the value of cor.
     *
     * @param mixed $cor the cor
     *
     * @return self
     */
    public function setCor($cor) {
        $this->cor = $cor;

        return $this;
    }

    /**
     * Gets the value of marcamotor.
     *
     * @return mixed
     */
    public function getMarcamotor() {
        return $this->marcamotor;
    }

    /**
     * Sets the value of marcamotor.
     *
     * @param mixed $marcamotor the marcamotor
     *
     * @return self
     */
    public function setMarcamotor($marcamotor) {
        $this->marcamotor = $marcamotor;

        return $this;
    }

    /**
     * Gets the value of contrato.
     *
     * @return mixed
     */
    public function getContrato() {
        return $this->contrato;
    }

    /**
     * Sets the value of contrato.
     *
     * @param mixed $contrato the contrato
     *
     * @return self
     */
    public function setContrato($contrato) {
        $this->contrato = $contrato;

        return $this;
    }

    /**
     * Gets the value of casco.
     *
     * @return mixed
     */
    public function getCasco() {
        return $this->casco;
    }

    /**
     * Sets the value of casco.
     *
     * @param mixed $casco the casco
     *
     * @return self
     */
    public function setCasco($casco) {
        $this->casco = $casco;

        return $this;
    }

}

?>