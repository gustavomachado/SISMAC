<?php 

require_once ( $path . 'generics/GenericDAO.php');
require_once ( $path . 'utils/Banco.php');

/**
* 
*/
class EnderecoDAO extends GenericDAO{
	
	function __construct(Banco $banco){
		parent::__construct($banco);		
	}

	public function inserir(Bean $endereco){
		return parent::inserir($endereco);	
	}
	
	public function pesquisar(Bean $bean , $where_clause = 'true '){
		 
		$u = parent::pesquisar($bean,$where_clause);
		return $u;
		  
	}
 
	public function exists(Bean $endereco){
		 
		$resultado = $this->pesquisar($endereco);
		return count($resultado) > 0 ;
	}

}

?>