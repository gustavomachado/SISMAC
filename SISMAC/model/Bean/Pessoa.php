<?php

require_once ( $path . 'generics/GenericBean.php');

/**
 * 
 */
abstract class Pessoa extends GenericBean {

    private $rg = '';
    private $cpf = '';
    private $dataNascimento = '';
    private $tipo = '';

    function __construct($id = '', $nome = '', $rg = '', $cpf = '') {
        parent::__construct($id);
        $this->nome = $nome;
        $this->rg = $rg;
        $this->cpf = $cpf;
    }

    /**
     * Gets the value of rg.
     *
     * @return mixed
     */
    public function getRg() {
        return $this->rg;
    }

    /**
     * sets the value of rg.
     *
     * @param mixed $rg the rg 
     *
     * @return self
     */
    public function setRg($rg) {
        $this->rg = $rg;

        return $this;
    }

    /**
     * Gets the value of cpf.
     *
     * @return mixed
     */
    public function getCpf() {
        return $this->cpf;
    }

    /**
     * sets the value of cpf.
     *
     * @param mixed $cpf the cpf 
     *
     * @return self
     */
    public function setCpf($cpf) {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Gets the value of dataNascimento.
     *
     * @return mixed
     */
    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    /**
     * Sets the value of dataNascimento.
     *
     * @param mixed $dataNascimento the data nascimento
     *
     * @return self
     */
    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;

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
