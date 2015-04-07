<?php

require ( $path . 'interfaces/DAO.php');

abstract class GenericDAO implements DAO {

    private $banco;

    function __construct(Banco $banco) {
        $this->banco = $banco;
        $this->banco->conecta();
    }

    public function getBanco() {
        return $this->banco;
    }

    public function inserir(Bean $bean) {

        $tabela = $this->getTableName($bean);
        $listaAtributos = $this->getFieldsFrom($tabela);
        $sql = $this->makeInsertSentence($listaAtributos, $bean);
   //   echo "$sql<hr>";
     #   exit;
        $resultado = $this->query($sql);
        $bean->setId($this->banco->insert_id());
        #  showDetails($bean);
        return $this->finaliza($resultado, $bean);
    }

    public function editar(Bean $bean) {

        $tabela = $this->getTableName($bean);
        $listaAtributos = $this->getFieldsFrom($tabela);
        $sql = $this->makeUpdateSentence($listaAtributos, $bean);
        /* echo $sql;
          exit; */
        $resultado = $this->query($sql);

        return $this->finaliza($resultado);
    }

    public function excluir(Bean $bean) {

        $bean->setAtivo(0);

        return $this->editar($bean);
    }

    public function pesquisar(Bean $bean, $where = 'true') {

        $sql = "select * from " . $this->banco->getSchema() . ".";
        $sql .= $this->getTableName($bean);
        $sql .= " where " . $where; 
        $resultSet = $this->query($sql);
      # echo $sql."<br>";
        $resultadoPesquisa = array();
        $listaAtributos = $this->getFieldsFrom($this->getTableName($bean));
        while ($linha = $this->fetch($resultSet)) {
            $beanRetorno;
            eval("\$beanRetorno = new " . get_class($bean) . "();");
            foreach ($listaAtributos as $value) {
                $beanRetorno->{"set$value"}($linha[$value]);
            }
            $resultadoPesquisa[] = $beanRetorno;
        }
        return $resultadoPesquisa;
    }

    public function listar(Bean $bean) {
        return $this->pesquisar($bean);
    }

    protected function getFieldsFrom($table) {

        $sql = "show fields from " . $this->banco->getSchema() . "." . $table;

        $resultado = $this->query($sql);

        if ($resultado) {
            $fields = array();
            while ($linha = $this->banco->fetchArray($resultado)) {
                $fields[] = $linha['Field'];
            }
            return $fields;
        }
        return null;
    }

    private function addBean($bean) {
        require_once ('model/Bean/' . $bean . '.php');
    }

    private function makeInsertSentence($fieldsList, $bean) {

        $sql = $this->getDefaultInsertion() . strtolower(get_class($bean));

        $sql .= $this->keyValueStr($fieldsList, $bean);

        return $sql;
    }

    private function makeUpdateSentence($fieldsList, $bean) {

        $sql = "update " . $this->banco->getSchema() . "." . $this->getTableName($bean) . " set";
        foreach ($fieldsList as $value) {
            $sql .= " $value = '" . $bean->{"get$value"}() . "',";
        }
        $sql = substr($sql, 0, ( strlen($sql) - 1));

        $sql .= " where id = " . $bean->getId();

        return $sql;
    }

    private function keyValueStr($listKey, Bean $bean) {

        $string = "(";
        $string .= implode(",", $listKey);
        $string .= ")values('";
        $listaValores = array();

        foreach ($listKey as $value) {
            if (method_exists($bean, "get$value")) {
                $listaValores[] = $bean->{"get$value"}();
            } else {
                 echo "nao encontrou o metodo get$value<hr>";
            }
        }
        $string .= implode("','", $listaValores);
        $string .= "');";
        # echo "keylist <br>$string <br>for <br>" . get_class($bean). "<br><hr>";
        # showDetails($listKey);
        return $string;
    }

    private function getDefaultInsertion() {
        return 'insert into ' . $this->banco->getSchema() . ".";
    }

    public function finaliza($resultado) {
        // showDetails($resultado);
        if ($resultado) {
            $this->banco->efetivarTransacao();
        } else {
            $this->banco->desfazerTransacao();
        }
        return $resultado;
    }

    private function getTableName(Bean $bean) {
        return strtolower(get_class($bean));
    }

    public function query($sql) {
       # echo get_class($this). " $sql<hr>";
        return $this->banco->executaSQL($sql);
    }

    public function fetch($resultSet) {
        return $this->banco->fetchArray($resultSet);
    }

}

?>