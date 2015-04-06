<?php 

require_once ( $path . 'generics/GenericDAO.php');
require_once ( $path . 'utils/Banco.php');

/**
* 
*/
class TelefoneDAO extends GenericDAO{
	
	function __construct(Banco $banco){
		parent::__construct($banco);		
	}

	public function inserir(Bean $telefone){
		return parent::inserir($telefone);	
	}
	
	public function pesquisar(Bean $bean , $where_clause = 'true '){
		 
		$u = parent::pesquisar($bean,$where_clause);
		return $u;
		  
	}
 
	public function exists(Bean $telefone){
		 
		$resultado = $this->pesquisar($telefone);
		return count($resultado) > 0 ;
	}

}

?>