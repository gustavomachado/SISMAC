<?php

session_start();
require_once ('../../config.php');
require_once ( $path . 'model/DAO/ClienteDAO.php');
require_once ( $path . 'model/DAO/EmailDAO.php');
require_once ( $path . 'model/DAO/EnderecoDAO.php');
require_once ( $path . 'model/DAO/EmbarcacaoDAO.php');
require_once ( $path . 'model/DAO/TelefoneDAO.php');
require_once ( $path . 'model/DAO/ContratoDAO.php');
require_once ( $path . 'utils/Banco.php');
require_once ( $path . 'resources/functions/functions.php');
require_once ( $path . 'model/Bean/Cliente.php');
require_once ( $path . 'model/Bean/Telefone.php');
require_once ( $path . 'model/Bean/Endereco.php');
require_once ( $path . 'model/Bean/Email.php');
require_once ( $path . 'model/Bean/Embarcacao.php');
require_once ( $path . 'model/Bean/Contrato.php');
require_once ( $path . 'model/Bean/Mensalidade.php');
require_once ( $path . 'model/Bean/Usuario.php');


$dao = new ClienteDAO(new Banco());

if (isset($_GET['m'])) {

    $method = $_GET['m'];

    switch ($method) {
        case 'salvar':
            salvar($dao);
            break;
        case 'editar':
            editar($dao);
            break;
        case 'pesquisar':
            pesquisar($dao);
            break;
        case 'excluir':
            excluir($dao);
            break;
        case 'listar':
            listar($dao);
            break;
        case 'restaurar':
            restaurar($dao);
            break;
        default:
            # code...
            break;
    }
}

function salvar($dao) {
    $cliente = new Cliente();
    $counters = array("telefones" => 0, "enderecos" => 0, "emails" => 0, "embarcacoes" => 0);

    foreach ($_POST as $key => $value) {
        if (method_exists($cliente, "set$key")) {
            //echo "setou $key = $value<hr>";
            $cliente->{"set$key"}($value);
        } else {
            if (strlen(strpos($key, "telefone")) > 0) {
                $counters['telefones'] ++;
            } else if (strlen(strpos($key, "idend")) > 0) {
                $counters['enderecos'] ++;
            } else if (strlen(strpos($key, "email")) > 0) {
                $counters['emails'] ++;
            } else if (strlen(strpos($key, "idemb")) > 0) {
                $counters['embarcacoes'] ++;
            }
        }
    }
        
    removeMascaras($cliente);
    $cliente->setDataNascimento(parseDateSQL($cliente->getDataNascimento()));
    $cliente->setDataInicio(parseDateSQL($cliente->getDataInicio()));
    

    if ($counters['embarcacoes'] < 1)
        $cliente->setAtivo(0);

    if (!$dao->inserir($cliente)) {
        $_SESSION['title'] = "Erro";
        $_SESSION['msgbody'] = "Falha ao Cadastrar o Cliente";
        $_SESSION['msgclass'] = "msg-erro";
        header("Location: /SISMAC/?c=cliente&v=salvar");
    } else {
        try {

            $dao = new TelefoneDAO($dao->getBanco());

            for ($i = 0; $i < $counters['telefones']; $i++) {
                $telefone = new Telefone();
                $telefone->setTelefone(removeMascara($_POST['telefone' . $i], " .()-"));
                $telefone->setOperadora($_POST['operadora' . $i]);
                $telefone->setTipo($_POST['tipotel' . $i]);
                $telefone->setativo($_POST['ativo-1-' . $i]);
                $telefone->setIdCliente($cliente->getId());
                $telefone->setId($_POST['idtel' . $i]);

                if (!$dao->inserir($telefone))
                    throw new Exception("Falha ao resgistrar telefone " . $i);
            }
            $dao = new EnderecoDAO($dao->getBanco());
            for ($i = 0; $i < $counters['enderecos']; $i++) {
                $endereco = new Endereco();
                $endereco->setrua($_POST['rua' . $i]);
                $endereco->setbairro($_POST['bairro' . $i]);
                $endereco->setcidade($_POST['cidade' . $i]);
                $endereco->setestado($_POST['estado' . $i]);
                $endereco->setnumero($_POST['numero' . $i]);
                $endereco->setcomplemento($_POST['complemento' . $i]);
                $endereco->setreferencia($_POST['referencia' . $i]);
                $endereco->setcep(removeMascara($_POST['cep' . $i], ".-"));
                $endereco->settipo($_POST['tipoend' . $i]);
                $endereco->setativo($_POST['ativo-2-' . $i]);
                $endereco->setIdCliente($cliente->getId());
                $endereco->setId($_POST["idend" . $i]);
                if (!$dao->inserir($endereco))
                    throw new Exception("Falha ao resgistrar endereco " . $i);
            }

            $dao = new EmailDAO($dao->getBanco());
            for ($i = 0; $i < $counters['emails']; $i++) {
                $email = new Email();
                $email->setEmail($_POST['email' . $i]);
                $email->setAtivo($_POST["ativo-3-" . $i]);
                $email->setIdCliente($cliente->getId());
                $email->setId($_POST["idema" . $i]);
                if (!$dao->inserir($email))
                    throw new Exception("Falha ao resgistrar email " . $i);
            }
            $dao = new EmbarcacaoDAO($dao->getBanco());
            $contratoDAO = new ContratoDAO($dao->getBanco());
            # showDetails($_POST);
            # showDetails($counters);
            for ($i = 0; $i < $counters['embarcacoes']; $i++) {
                $embarcacao = new Embarcacao();
                $embarcacao->setCor($_POST['coremb' . $i]);
                $embarcacao->setMarcamotor($_POST['marcaemb' . $i]);
                $embarcacao->setNome($_POST['nomeemb' . $i]);
                $embarcacao->setCasco($_POST['casco' . $i]);
                $embarcacao->setId($_POST['idemb' . $i]);
                $embarcacao->setAtivo($_POST["ativo-4-" . $i]);

                if (!$dao->inserir($embarcacao)) {
                    throw new Exception("Falha ao resgistrar embarcacao " . $i);
                }
                #  echo "embarcacao incerida<br>";
                $contrato = new Contrato();
                $contrato->setVencimento($_POST['vencimento' . $i]);
                $contrato->setdatainicio(parseDateSQL($_POST['datainicio' . $i]));
                $contrato->setmensalidade(str_replace(",", ".", removeMascara($_POST['mensalidade' . $i], "R$.")));
                $contrato->setAtivo($_POST["ativo-4-" . $i]);
                $contrato->setTipo($_POST['tipoContrato' . $i]);
                $contrato->setIdCliente($cliente->getId());
                $contrato->setIdEmbarcacao($embarcacao->getId());


                $contratoDAO->inserir($contrato);
                /*     showDetails($contrato);

                  if(!$contratoDAO->createMensalidade(getPrimmeiraMensalidade($contrato)))
                  throw new Exception("Erro ao gerar Mensalidade");
                 */
            }
        } catch (Exception $e) {
            //   echo "entrou no catch<hr>" . $e->getMessage();
            $_SESSION['title'] = "Error";
            $_SESSION['msgbody'] = $e->getMessage();
            $_SESSION['msgclass'] = "msg-erro";
            header("Location: /SISMAC/?c=cliente&v=salvar");
        }
        $_SESSION['title'] = "Sucesso";
        $_SESSION['msgbody'] = "Cadastro do Cliente Realizado com Sucesso.";
        $_SESSION['msgclass'] = "msg-success";
        header("Location: /SISMAC/?c=cliente&v=editar&id=" . $cliente->getId());
    }
}

function removeMascaras($cliente) {
    $cliente->setRg(removeMascara($cliente->getRg(), "-"));
    $cliente->setCpf(removeMascara($cliente->getCPF(), ".-/"));
}

function editar($dao) {

    $cliente = new Cliente();
    $counters = array("telefones" => 0, "enderecos" => 0, "emails" => 0, "embarcacoes" => 0);

    foreach ($_POST as $key => $value) {

        if (method_exists($cliente, "set$key")) {
            $cliente->{"set$key"}($value);
        } else {
            if (strlen(strpos($key, "telefone")) > 0) {
                $counters['telefones'] ++;
            } else if (strlen(strpos($key, "idend")) > 0) {
                $counters['enderecos'] ++;
            } else if (strlen(strpos($key, "email")) > 0) {
                $counters['emails'] ++;
            } else if (strlen(strpos($key, "idemb")) > 0) {
                $counters['embarcacoes'] ++;
            }
        }
    }


    if ($counters['embarcacoes'] < 1) {
        $cliente->setAtivo(0);
    } else {
        $cliente->setAtivo(1);
    }

        
    removeMascaras($cliente);
    $cliente->setDataNascimento(parseDateSQL($cliente->getDataNascimento()));
    $cliente->setDataInicio(parseDateSQL($cliente->getDataInicio()));


    if (!$dao->editar($cliente)) {
        $_SESSION['title'] = "Error";
        $_SESSION['msgbody'] = "Falha ao Alterar Dados do Cliente";
        $_SESSION['msgclass'] = "msg-erro";
        header("Location: /SISMAC/?c=cliente&v=editar&id=" . $cliente->getId());
    } else {
        try {

            $dao = new TelefoneDAO($dao->getBanco());

            for ($i = 0; $i < $counters['telefones']; $i++) {
                $telefone = new Telefone();
                $telefone->setTelefone(removeMascara($_POST['telefone' . $i], " .()-"));
                $telefone->setOperadora($_POST['operadora' . $i]);
                $telefone->setTipo($_POST['tipotel' . $i]);
                $telefone->setativo($_POST['ativo-1-' . $i]);
                $telefone->setIdCliente($cliente->getId());
                $telefone->setId($_POST['idtel' . $i]);
                if ($telefone->getId() < 1) {
                    if (!$dao->inserir($telefone))
                        throw new Exception("Falha ao resgistrar telefone " . $i);
                }else {
                    if (!$dao->editar($telefone))
                        throw new Exception("Falha ao alterar telefone " . $telefone->getTelefone());
                }
            }
            $dao = new EnderecoDAO($dao->getBanco());
            for ($i = 0; $i < $counters['enderecos']; $i++) {
                $endereco = new Endereco();
                $endereco->setrua($_POST['rua' . $i]);
                $endereco->setbairro($_POST['bairro' . $i]);
                $endereco->setcidade($_POST['cidade' . $i]);
                $endereco->setestado($_POST['estado' . $i]);
                $endereco->setnumero($_POST['numero' . $i]);
                $endereco->setcomplemento($_POST['complemento' . $i]);
                $endereco->setreferencia($_POST['referencia' . $i]);
                $endereco->setcep(removeMascara($_POST['cep' . $i], ".-"));
                $endereco->settipo($_POST['tipoend' . $i]);
                $endereco->setativo($_POST['ativo-2-' . $i]);
                $endereco->setIdCliente($cliente->getId());
                $endereco->setId($_POST["idend" . $i]);
                if ($endereco->getId() < 1) {
                    if (!$dao->inserir($endereco))
                        throw new Exception("Falha ao resgistrar endereco " . $i);
                }else {
                    if (!$dao->editar($endereco))
                        throw new Exception("Erro ao alterar registro do endereco em " . $endereco->getBairro());
                }
            }

            $dao = new EmailDAO($dao->getBanco());
            for ($i = 0; $i < $counters['emails']; $i++) {
                $email = new Email();
                $email->setEmail($_POST['email' . $i]);
                $email->setAtivo($_POST["ativo-3-" . $i]);
                $email->setIdCliente($cliente->getId());
                $email->setId($_POST["idema" . $i]);
                if ($email->getId() < 1) {
                    if (!$dao->inserir($email))
                        throw new Exception("Falha ao resgistrar email " . $i);
                }else {
                    if (!$dao->editar($email))
                        throw new Exception("Erro ao alterar email " . $email->getEmail());
                }
            }
            $dao = new EmbarcacaoDAO($dao->getBanco());
            $contratoDAO = new ContratoDAO($dao->getBanco());
            for ($i = 0; $i < $counters['embarcacoes']; $i++) {
                $embarcacao = new Embarcacao();
                $embarcacao->setCor($_POST['coremb' . $i]);
                $embarcacao->setMarcamotor($_POST['marcaemb' . $i]);
                $embarcacao->setNome($_POST['nomeemb' . $i]);
                $embarcacao->setCasco($_POST['casco' . $i]);
                $embarcacao->setId($_POST['idemb' . $i]);
                $embarcacao->setAtivo($_POST["ativo-4-" . $i]);

                if ($embarcacao->getId() < 1) {

                    if (!$dao->inserir($embarcacao)) {
                        throw new Exception("Falha ao resgistrar embarcacao " . $i);
                    }

                    $contrato = new Contrato();
                    $contrato->setVencimento($_POST['vencimento' . $i]);
                    $contrato->setdatainicio(parseDateSQL($_POST['datainicio' . $i]));
                    $contrato->setmensalidade(str_replace(",", ".", removeMascara($_POST['mensalidade' . $i], "R$.")));
                    $contrato->setAtivo($_POST["ativo-4-" . $i]);
                    $contrato->setTipo($_POST['tipoContrato' . $i]);
                    $contrato->setIdCliente($cliente->getId());
                    $contrato->setIdEmbarcacao($embarcacao->getId());

                    if (!$contratoDAO->inserir($contrato)) {
                        throw new Exception("Falha ao resgistrar contrato " . $i);
                    }
                    /*
                      if(!$contratoDAO->createMensalidade(getPrimmeiraMensalidade($contrato)))
                      throw new Exception("Erro ao gerar Mensalidade");
                      )
                     * 
                     */
                } else {
                    if (!$dao->editar($embarcacao))
                        throw new Exception("Erro ao alterar dados da Embarcacao");
                }
            }
        } catch (Exception $e) {
            $_SESSION['title'] = "Error";
            $_SESSION['msgbody'] = $e->getMessage();
            $_SESSION['msgclass'] = "msg-erro";
            header("Location: /SISMAC/?c=cliente&v=editar&id=" . $cliente->getId());
        }
        $_SESSION['title'] = "Sucesso";
        $_SESSION['msgbody'] = "Dados do Cliente Alterados com Sucesso.";
        $_SESSION['msgclass'] = "msg-success";
        header("Location: /SISMAC/?c=cliente&v=editar&id=" . $cliente->getId());
    }
}

function pesquisar(ClienteDAO $dao, $whereClause = 'true') {

    $whereClause = " true ";
    $listaClientes = array();

    if (strlen($_POST['emb']) > 0) {
        $whereClause .= "and nome like '%" . $_POST['emb'] . "%'";
        $daoEmb = new EmbarcacaoDAO($dao->getBanco());
        $embarcacoes = $daoEmb->pesquisar(new Embarcacao(), $whereClause);
        $daoContrato = new ContratoDAO($dao->getBanco());
        foreach ($embarcacoes as $embarcacao) {
            $whereClause = " idembarcacao = " . $embarcacao->getId();
            $whereClause .= " order by id desc limit 1";
            $contrato = $daoContrato->pesquisar(new Contrato(), $whereClause);
            if ($contrato) {
                $contrato = $contrato[0];
                $whereClause = " id = " . $contrato->getIdCliente();
                $clientes = $dao->pesquisar(new Cliente(), $whereClause);
                if ($clientes)
                    $listaClientes[] = serialize($clientes[0]);
            }
        }
    }else {
        foreach ($_POST as $key => $value)
            if (strlen($value) > 0 && strcmp($key, "emb") != 0)
                $whereClause .= " and $key like '%$value%'";
        $whereClause .= " and ativo=1 order by nome asc;";
        $clientes = $dao->pesquisar(new Cliente(), $whereClause);
        if ($clientes)
            foreach ($clientes as $cliente)
                $listaClientes[] = serialize($cliente);
    }
    foreach ($_POST as $key => $value) {
        set($key, $value);
    }
    set('lista', $listaClientes);
    #showDetails($_SESSION);
    #exit;
    header("Location: /SISMAC/?c=cliente&v=pesquisar");
}

function listar($dao) {
    fazerLista($dao);

    header("Location: /SISMAC/?c=cliente&v=listar");
}

function excluir($dao) {

    if (isset($_GET['id'])) {
        $cliente = $dao->pesquisar(new Cliente(), "id=" . $_GET['id']);
        $cliente = $cliente[0];

        $embarcacoes = $cliente->getEmbarcacao();
        //   showDetails($embarcacoes);
        //  exit;
        try {
            $msg = "Erro ao excluir ";
            $genericDAO = new ContratoDAO($dao->getBanco());
            foreach ($embarcacoes as $embarcacao) {
                $contrato = $embarcacao->getContrato();
                //   $contrato->setAtivo(0);
                $genericDAO->excluir($contrato);
                //    showDetails($contrato);
            }

            /* 	if(!$genericDAO->excluir($embarcacao))
              throw new Exception($msg . "embarcações"); */

            $cliente->setDataFim(date("Y-m-d"));
            
            if (!$dao->excluir($cliente))
                throw new Exception($msg . "cliente");
        } catch (Exception $e) {
            $_SESSION['title'] = "Error";
            $_SESSION['msgbody'] = $e->getMessage();
            $_SESSION['msgclass'] = "msg-erro";
            header("Location: /SISMAC/?c=cliente&v=ficha&id=" . $cliente->getId());
        }
        $_SESSION['title'] = "Sucesso";
        $_SESSION['msgbody'] = "Dados do Cliente Excluidos com Sucesso.";
        $_SESSION['msgclass'] = "msg-success";
        header("Location: /SISMAC/?c=cliente&v=ficha&id=" . $cliente->getId());
    }
}

function restaurar($dao) {

    fazerLista($dao);
    header("Location: /SISMAC/?c=cliente&v=lista-restaurar");
}

function fazerLista($dao) {
    $filtros = array();
    $i = $j = 1;

    $whereClause = '';
    $ordem = array();
    foreach ($_GET as $key => $value)
        if (strlen(stripos($key, "filtro")) > 0)
            $whereClause .= " $value='" . $_GET['v' . $i++] . "' and ";
        else if (strlen(stripos($key, "ordem")))
            $ordem[] = $_GET['ordem' . $j++];

    $whereClause .= " true ";

    if (count($ordem) > 0)
        $ordem = "order by " . implode(",", $ordem);
    else
        $ordem = "order by cliente.nome asc , cliente.ativo desc";
    $whereClause .= $ordem;

    $lista = $dao->pesquisar(new cliente(), $whereClause);
    $i = 0;
    foreach ($lista as $cliente)
        $lista[$i++] = serialize($cliente);
    set('lista', $lista);
}

?>