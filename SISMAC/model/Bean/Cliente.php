<?php

require_once ('Pessoa.php');
require_once ('Contato.php');

class Cliente extends Pessoa {

    private $conjugue;
    private $foto;
    private $email = array();
    private $telefone = array();
    private $endereco = array();
    private $embarcacao = array();
    private $dataInicio = '';
    private $dataFim = '';

    function __construct() {
        
    }

    /**
     * Gets the value of conjugue.
     *
     * @return mixed
     */
    public function getConjugue() {
        return $this->conjugue;
    }

    /**
     * Sets the value of conjugue.
     *
     * @param mixed $conjugue the conjugue
     *
     * @return self
     */
    public function setConjugue($conjugue) {
        $this->conjugue = $conjugue;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of telefone.
     *
     * @return mixed
     */
    public function getTelefone() {
        return $this->telefone;
    }

    /**
     * Sets the value of telefone.
     *
     * @param mixed $telefone the telefone
     *
     * @return self
     */
    public function setTelefone($telefone) {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Gets the value of endereco.
     *
     * @return mixed
     */
    public function getEndereco() {
        return $this->endereco;
    }

    /**
     * Sets the value of endereco.
     *
     * @param mixed $endereco the endereco
     *
     * @return self
     */
    public function setEndereco($endereco) {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Gets the value of embarcacao.
     *
     * @return mixed
     */
    public function getEmbarcacao() {
        return $this->embarcacao;
    }

    /**
     * Sets the value of embarcacao.
     *
     * @param mixed $embarcacao the embarcacao
     *
     * @return self
     */
    public function setEmbarcacao($embarcacao) {
        $this->embarcacao = $embarcacao;

        return $this;
    }

    /**
     * Gets the value of foto.
     *
     * @return mixed
     */
    public function getFoto() {
        return $this->foto;
    }

    /**
     * Sets the value of foto.
     *
     * @param mixed $foto the foto
     *
     * @return self
     */
    public function setFoto($foto) {
        $this->foto = $foto;

        return $this;
    }

    public function addEmbarcacao($embarcacao) {
        $this->embarcacao[] = $embarcacao;
    }
    function getDataInicio() {
        return $this->dataInicio;
    }

    function getDataFim() {
        return $this->dataFim;
    }

    function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }



}

?>