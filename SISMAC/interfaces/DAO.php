<?php 

	interface DAO{
		
		public function inserir(Bean $bean);
		public function editar(Bean $bean);
		public function excluir(Bean $bean);
		public function listar(Bean $bean);
		public function pesquisar(Bean $bean , $whereClause = '');
		
	}


?>