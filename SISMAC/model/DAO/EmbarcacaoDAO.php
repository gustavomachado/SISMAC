<?php 

require_once ( $path . 'generics/GenericDAO.php');
require_once ( $path . 'utils/Banco.php');

/**
* 
*/
class EmbarcacaoDAO extends GenericDAO{
	
	function __construct(Banco $banco){
		parent::__construct($banco);		
	}

	public function inserir(Bean $Embarcacao){
		return parent::inserir($Embarcacao);	
	}
	
	 
 
	public function exists(Bean $Embarcacao){
		
		$resultado = $this->pesquisar($Embarcacao);
		return count($resultado) > 0 ;
	}
	public function excluir(Bean $embarcacao){

		$contratoDAO = new contratoDAO($this->getBanco());
		if($contratoDAO->excluir($embarcacao->getContrato())){
			return parent::excluir($embarcacao);
		}
		return false;
	}
        public function pesquisar(Bean $bean,$where_clause=''){
            
            return parent::pesquisar($bean, $where_clause);
        }

}

?>