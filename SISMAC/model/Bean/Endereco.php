<?php 

require_once ('Contato.php');

/**
* 
*/
class Endereco extends Contato{
	
	private $rua;
	private $bairro;
	private $cidade;
	private $estado;
	private $numero;
	private $complemento;
	private $referencia;
	private $cep;

	function __construct()	{
		
	}

     

    /**
     * Gets the value of rua.
     *
     * @return mixed
     */
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * Sets the value of rua.
     *
     * @param mixed $rua the rua
     *
     * @return self
     */
    public function setRua($rua)
    {
        $this->rua = $rua;

        return $this;
    }

    /**
     * Gets the value of bairro.
     *
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Sets the value of bairro.
     *
     * @param mixed $bairro the bairro
     *
     * @return self
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Gets the value of cidade.
     *
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Sets the value of cidade.
     *
     * @param mixed $cidade the cidade
     *
     * @return self
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Gets the value of estado.
     *
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Sets the value of estado.
     *
     * @param mixed $estado the estado
     *
     * @return self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Gets the value of numero.
     *
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Sets the value of numero.
     *
     * @param mixed $numero the numero
     *
     * @return self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Gets the value of complemento.
     *
     * @return mixed
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Sets the value of complemento.
     *
     * @param mixed $complemento the complemento
     *
     * @return self
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Gets the value of referencia.
     *
     * @return mixed
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Sets the value of referencia.
     *
     * @param mixed $referencia the referencia
     *
     * @return self
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Gets the value of cep.
     *
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Sets the value of cep.
     *
     * @param mixed $cep the cep
     *
     * @return self
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    
}


 ?>