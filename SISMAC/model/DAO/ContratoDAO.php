<?php

require_once ( $path . 'generics/GenericDAO.php');
require_once ( $path . 'utils/Banco.php');
require_once ( $path . 'model/DAO/MensalidadeDAO.php');
/*
 * 
 */

class ContratoDAO extends GenericDAO {

    function __construct(Banco $banco) {
        parent::__construct($banco);
    }

    public function inserir(Bean $contrato, $first = TRUE) {

        if (!parent::inserir($contrato)) {
            echo "erro ao registrar novo contrato";
            exit;
        }
       
        $mes = date("m", strtotime($contrato->getDataInicio()));
        if ($first) {
            $mensalidade = getPrimmeiraMensalidade($contrato);
           
        } else {
            $mensalidade = new Mensalidade();
            $mensalidade->setMesReferencia($mes);
            $mensalidade->setIdContrato($contrato->getId());
            $mensalidade->setIdusuario(1);
            $mensalidade->setAtivo(1);
        }
        $dao = new MensalidadeDAO($this->getBanco());
        if ($dao->inserir($mensalidade)) {
            for ($i = $mes + 1; $i < 13; $i++) {
                $mensalidade = new Mensalidade();
                $mensalidade->setMesReferencia($i);
                $mensalidade->setIdContrato($contrato->getId());
                $mensalidade->setIdusuario(1);
                if (!$dao->inserir($mensalidade)) {
                    showDetails($mensalidade);
                    echo "falha ao criar mensalidades";
                    exit;
                }
                #        showDetails($mensalidade);
            }
        } else {
            showDetails($mensalidade);
            echo "falha ao criar mensalidades";
            exit;
        }
    }

    public function pesquisar(Bean $bean, $where_clause = 'true ') {
        $u = parent::pesquisar($bean, $where_clause);
        return $u;
    }

    public function exists(Bean $contrato) {
        $resultado = $this->pesquisar($contrato);
        return count($resultado) > 0;
    }

    public function createMensalidade(Mensalidade $mensalidade) {
        $dao = new MensalidadeDAO($this->getBanco());

        return $dao->inserir($mensalidade);
    }

    public function excluir(Bean $contrato) {

        $contrato->setDataFim(date("Y-m-d"));

        $mensalidadeDAO = new MensalidadeDAO($this->getBanco());
        //$mensalidades =  $mensalidadeDAO->pesquisar(new Mensalidade(),"mesreferencia > ".date('m')." and anoreferencia >= ".date("Y")." "
        //                                                          . "ativo=1 and idcontrato=".$contrato->getId());

        $mensalidades = $mensalidadeDAO->pesquisar(new Mensalidade(), "mesreferencia > " . date('m') . " and ativo=0 and  idcontrato=" . $contrato->getId());
        //  showDetails($mensalidades);
        $dataAtual = date("Y-m-d");
        //  echo $dataAtual . "<hr>";
        foreach ($mensalidades as $mensalidade) {
            //  $dataVencimento = $mensalidade->getDataVencimento($contrato);
            // echo $dataVencimento . "<hr>";
            $mensalidadeDAO->excluir($mensalidade);
        }
        /*
          $mensalidadeRestante = $mensalidadeDAO->pesquisar(new Mensalidade(), " ativo=1 and idcontrato=" . $contrato->getId()
          . " order by mesreferencia desc limit 1");
          if (count($mensalidadeRestante) > 0) {

          $mensalidadeRestante = $mensalidadeRestante[0];
          $dataVencimento = $mensalidadeRestante->getDataVencimento($contrato);
          $diferenca = strtotime($dataAtual) - strtotime($dataVencimento);
          $dias = floor($diferenca / (60 * 60 * 24));
          $numeroDiasMes = date("t", strtotime($dataAtual));
          $valorMensalidade = $contrato->getMensalidade();
          $diaria = $valorMensalidade/$numeroDiasMes;
          $acrescimo = 0;
          $desconto = 0;
          if ($dias > 0) {
          $result = $this->query("select * from marina.parametros where chave in ('multa-atraso','juros-mes')");
          $parametros = array();
          while ($linha = $this->fetch($result)) {
          $parametros[$linha['chave']] = $linha['valor'];
          }
          $acrescimo += $parametros['multa-atraso'];
          $acrescimo += $diaria * ( $dias * ( -1 ));
          }

          echo $dataVencimento . "<br>" . $dataAtual . "<br>";
          echo "dias: " .$dias * (-1);
          } */
        return parent::editar($contrato);
    }

    public function renovarContrato($idContrato) {
        $dao = new MensalidadeDAO($this->getBanco());

        $mensalidade = new Mensalidade();
        $mensalidade->setMesReferencia(1);
        $mensalidade->setIdContrato($idContrato);
        $mensalidade->setAtivo(1);
        $mensalidade->setIdusuario(1);
        if ($dao->inserir($mensalidade)) {

            for ($i = 2; $i < 13; $i++) {
                $mensalidade = new Mensalidade();
                $mensalidade->setMesReferencia($i);
                $mensalidade->setIdContrato($idContrato);
                $mensalidade->setIdusuario(1);
                if (!$dao->inserir($mensalidade)) {
                    break;
                }
                #        showDetails($mensalidade);
            }
        } else {
            echo "erro ao renovar contrato";
            exit;
        }
    }

}

?>