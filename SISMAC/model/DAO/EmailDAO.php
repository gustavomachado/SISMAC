<?php 

require_once ( $path . 'generics/GenericDAO.php');
require_once ( $path . 'utils/Banco.php');

/**
* 
*/
class EmailDAO extends GenericDAO{
	
	function __construct(Banco $banco){
		parent::__construct($banco);		
	}

	public function inserir(Bean $email){
	
		return parent::inserir($email);	
	}
	
	public function pesquisar(Bean $bean , $where_clause = 'true '){
		$u = parent::pesquisar($bean,$where_clause);
		return $u;
		  
	}
 
	public function exists(Bean $email){
		 
		$resultado = $this->pesquisar($email );
		return count($resultado) > 0 ;
	}

}

?>