<?php

class Banco {

	private $host;
	private $username;
	private $password;
	private $connection;
	private $squema;
	

	public function banco() {
		$this->host     = '127.0.0.1';
		$this->username = 'root';
		$this->password = '';
		$this->squema   = 'marina';		
	}

	public function conecta() {
		
		$this->connection = mysql_connect($this->host, $this->username,$this->password);
		mysql_select_db($this->squema,$this->connection);
		return $this->connection;
	}
	public function desconecta() {
		mysql_close($this->connection);
	}

	public function updateSQL($sql) {
		$r = mysql_query($sql,$this->connection);
		if($r == 0) {
			return false;
		} else {
			return true;
		}
	}

	public function executaSQL($sql) {
		$retorno = mysql_query($sql,$this->connection) ;
                if(! $retorno ){
                    echo mysql_error($this->connection);
                    
                }
               # echo $retorno;
              //  showDetails(mysql_fetch_assoc($retorno));
                 
		return $retorno;
	}

	public function fetchArray($res) {
		$retorno = mysql_fetch_assoc($res);
		return $retorno;
	}

	public function numRows($res) {
		return @mysql_num_rows($res);
	}

	public function erroNumero() {
		return @mysql_errno($this->connection);
	}

	public function insert_id() {
		return @mysql_insert_id();
	}

	public function mysql_error() {
		return @mysql_error();
	}

	public function iniciarTransacao() {
		$this->executaSQL("begin");
	}

	public function efetivarTransacao() {
		$this->executaSQL("commit");
	}

	public function desfazerTransacao() {
		$this->executaSQL("rollback");
	}

	public function getSchema(){
		return $this->squema;
	}
}
?>
