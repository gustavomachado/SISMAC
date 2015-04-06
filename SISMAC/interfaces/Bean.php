<?php 
	
	interface Bean{
		
		public function getId();
		public function setId($id);
		public function getNome();
		public function setNome($nome);
		public function equals(Bean $bean);
	}

?>