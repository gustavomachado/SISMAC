<?php

require ( $path . 'interfaces/Bean.php');

abstract class GenericBean implements Bean {

    private $id;
    private $nome;
    private $ativo;

    function __construct($array=NULL) {
        if ($array) {
            foreach ($array as $key => $value) {
                if (method_exists($this, "set$key")) {
                    //echo "metodo existe<br>";
                    $this->{"set$key"}($value);
                } else {
                    //echo "metodo nao existe<br>";
                }
            }
        }
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id) {
        $this->id = $id;
        //  echo "setando id " . get_class($this) . "<br>";
        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    public function setNome($nome) {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the value of ativo.
     *
     * @return mixed
     */
    public function getAtivo() {

        #  echo "Getting ativo = " . $this->ativo . " from " . get_class($this) . "<hr>";
        return $this->ativo;
    }

    /**
     * Sets the value of ativo.
     *
     * @param mixed $ativo the ativo
     *
     * @return self
     */
    public function setAtivo($ativo) {
        //   echo "setando ativo<br>";
        $this->ativo = $ativo;

        return $this;
    }

    public function equals(Bean $bean) {
        if ($bean == null)
            return false;
        if ($this === $bean)
            return true;
        if (strcmp(get_class($this), get_class($bean)) !== 0)
            return false;
    }

}

?>