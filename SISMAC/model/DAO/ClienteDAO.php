<?php

require_once ( $path . 'generics/GenericDAO.php');
require_once ( $path . 'model/DAO/TelefoneDAO.php');
require_once ( $path . 'model/DAO/EnderecoDAO.php');
require_once ( $path . 'model/DAO/EmbarcacaoDAO.php');
require_once ( $path . 'model/DAO/EmailDAO.php');
require_once ( $path . 'model/DAO/ContratoDAO.php');

require_once ( $path . 'model/Bean/Telefone.php');
require_once ( $path . 'model/Bean/Endereco.php');
require_once ( $path . 'model/Bean/Embarcacao.php');
require_once ( $path . 'model/Bean/Email.php');
require_once ( $path . 'model/Bean/Contrato.php');

/**
 * 
 */
class ClienteDAO extends GenericDAO {

    function __construct(Banco $banco) {
        parent::__construct($banco);
    }

    public function pesquisar(Bean $cliente, $where_clause = true) {

        $clientes = parent::pesquisar($cliente, $where_clause);
        $banco = $this->getBanco();
        $daoTEL = new TelefoneDAO($banco);
        $daoEND = new EnderecoDAO($banco);
        $daoEmail = new EmailDAO($banco);
        $daoEmb = new EmbarcacaoDAO($banco);
        $daoContrato = new ContratoDAO($banco);

        foreach ($clientes as $cliente) {
            $id = $cliente->getId();
            $where_clause = "idcliente = " . $id . " and ativo = 1";
            $telefones = $daoTEL->pesquisar(new Telefone(), $where_clause);
            $cliente->setTelefone($telefones);
            $enderecos = $daoEND->pesquisar(new Endereco(), $where_clause);
            $cliente->setEndereco($enderecos);
            $emails = $daoEmail->pesquisar(new Email(), $where_clause);
            $cliente->setEmail($emails);
            $contratos = $daoContrato->pesquisar(new Contrato(), $where_clause);
            foreach ($contratos as $contratoAtivo) {
                $embarcacao = $daoEmb->pesquisar(new Embarcacao(), "ativo=1 and id = " . $contratoAtivo->getIdEmbarcacao());
                if (count($embarcacao) > 0) {
                    $embarcacao = $embarcacao[0];
                    $embarcacao->setContrato($contratoAtivo);
                    $cliente->addEmbarcacao($embarcacao);
                }
            }
        }
        return $clientes;
    }
    
    public function pesquisarAlone(Cliente $cliente , $whereClause){
        return parent::pesquisar($cliente,$whereClause);
    }

    public function exists(Bean $cliente) {
        $where_clause = " cpf = '" . $cliente->getCpf() . "'";
        $resultado = parent::pesquisar($cliente, $where_clause);
        if (count($resultado) > 0)
            return $resultado;
        return false;
    }

    public function inserir(Bean $cliente) {


        // showDetails($cliente);

        return parent::inserir($cliente);
    }

}

?>