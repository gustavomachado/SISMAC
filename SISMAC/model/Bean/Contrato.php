<?php

require_once ( $path . "generics/GenericBean.php");

/**
 * 
 */
class Contrato extends GenericBean {

    private $dataInicio;
    private $datafim;
    private $recisao;
    private $vencimento;
    private $mensalidade;
    private $idEmbarcacao;
    private $idCliente;
    private $tipo;

    

    /**
     * Gets the value of dataInicio.
     *
     * @return mixed
     */
    public function getDataInicio() {
        return $this->dataInicio;
    }

    /**
     * Sets the value of dataInicio.
     *
     * @param mixed $dataInicio the data inicio
     *
     * @return self
     */
    public function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    /**
     * Gets the value of recisao.
     *
     * @return mixed
     */
    public function getRecisao() {
        return $this->recisao;
    }

    /**
     * Sets the value of recisao.
     *
     * @param mixed $recisao the recisao
     *
     * @return self
     */
    public function setRecisao($recisao) {
        $this->recisao = $recisao;

        return $this;
    }

    /**
     * Gets the value of vencimento.
     *
     * @return mixed
     */
    public function getVencimento() {
        return $this->vencimento;
    }

    /**
     * Sets the value of vencimento.
     *
     * @param mixed $vencimento the vencimento
     *
     * @return self
     */
    public function setVencimento($vencimento) {
        $this->vencimento = $vencimento;

        return $this;
    }

    /**
     * Gets the value of mensalidade.
     *
     * @return mixed
     */
    public function getMensalidade() {
        return $this->mensalidade;
    }

    /**
     * Sets the value of mensalidade.
     *
     * @param mixed $mensalidade the mensalidade
     *
     * @return self
     */
    public function setMensalidade($mensalidade) {
        $this->mensalidade = $mensalidade;
        
        return $this;
    }

    /**
     * Gets the value of idEmbarcacao.
     *
     * @return mixed
     */
    public function getIdEmbarcacao() {
        return $this->idEmbarcacao;
    }

    /**
     * Sets the value of idEmbarcacao.
     *
     * @param mixed $idEmbarcacao the id embarcacao
     *
     * @return self
     */
    public function setIdEmbarcacao($idEmbarcacao) {
        $this->idEmbarcacao = $idEmbarcacao;

        return $this;
    }

    /**
     * Gets the value of idCliente.
     *
     * @return mixed
     */
    public function getIdCliente() {
        return $this->idCliente;
    }

    /**
     * Sets the value of idCliente.
     *
     * @param mixed $idCliente the id cliente
     *
     * @return self
     */
    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;

        return $this;
    }

    /**
     * Gets the value of datafim.
     *
     * @return mixed
     */
    public function getDatafim() {
        return $this->datafim;
    }

    /**
     * Sets the value of datafim.
     *
     * @param mixed $datafim the datafim
     *
     * @return self
     */
    public function setDatafim($datafim) {
        $this->datafim = $datafim;

        return $this;
    }

    /**
     * Gets the value of tipo.
     *
     * @return mixed
     */
    public function getTipo() {
        return $this->tipo;
    }

    /**
     * Sets the value of tipo.
     *
     * @param mixed $tipo the tipo
     *
     * @return self
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;

        return $this;
    }

}

?>