<?php 

require_once ( $path . 'generics/GenericDAO.php');
require_once ( $path . 'utils/Banco.php');

/**
* 
*/
class UsuarioDAO extends GenericDAO{
	
	function __construct(Banco $banco){
		parent::__construct($banco);		
	}

	public function inserir(Bean $usuario){
		$usuario->setSenha(md5($usuario->getSenha()));
		parent::inserir($usuario);	
	}
	
	public function pesquisar(Bean $bean , $where_clause = 'true '){
		$where_clause .= " order by login";
	//	echo "executando pesquisa <hr>";
		$u = parent::pesquisar($bean,$where_clause);
		return $u;
		  
	}
 
	public function exists(Bean $usuario){
		$where_clause = "login = '". $usuario->getLogin();
		$where_clause .= "' and senha = '".($usuario->getSenhaMD5())."'";
		$where_clause .= " and ativo = 1 ";
		$resultado = $this->pesquisar($usuario, $where_clause);
		return count($resultado) > 0 ;
	}

}

?>