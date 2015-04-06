<?php 

require_once ( $path . 'generics/GenericBean.php');

/**
* 
*/
class Contato extends GenericBean{
	
	private $idCliente;
    private $tipo;

	function __construct()	{
		
	}

    /**
     * Gets the value of idCliente.
     *
     * @return mixed
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Sets the value of idCliente.
     *
     * @param mixed $idCliente the id cliente
     *
     * @return self
     */
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;

        return $this;
    }

    /**
     * Gets the value of tipo.
     *
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Sets the value of tipo.
     *
     * @param mixed $tipo the tipo
     *
     * @return self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }
}


 ?>