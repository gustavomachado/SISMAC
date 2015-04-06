<?php 

require_once ('Contato.php');

/**
* 
*/
class Telefone extends Contato{
	

	private $telefone;
	private $operadora;


	function __construct(){
		
	}

    /**
     * Gets the value of telefone.
     *
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Sets the value of telefone.
     *
     * @param mixed $telefone the telefone
     *
     * @return self
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Gets the value of operadora.
     *
     * @return mixed
     */
    public function getOperadora()
    {
        return $this->operadora;
    }

    /**
     * Sets the value of operadora.
     *
     * @param mixed $operadora the operadora
     *
     * @return self
     */
    public function setOperadora($operadora)
    {
        $this->operadora = $operadora;

        return $this;
    }
}


 ?>