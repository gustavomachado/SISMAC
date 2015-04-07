<?php

require_once ("../../config.php");

require_once ( $path . 'model/DAO/UsuarioDAO.php');
require_once ( $path . 'model/Bean/Usuario.php');
require_once ( $path . 'resources/functions/functions.php');
require_once ( $path . 'model/Bean/Cliente.php');

session_start();


if (isset($_GET['m'])) {

    $dao = new UsuarioDAO(new Banco());

    $method = $_GET['m'];

    switch ($method) {

        case 'salvar':
            salvar($dao);
            break;

        case 'excluir':
            excluir($dao);
            break;
        case 'restaurar':
            restaurar($dao);
            break;
        case 'logout':
            session_destroy();
            header("Location: /SISMAC/?c=usuario&v=login");
            break;
        case 'login';
            $login;
            $senha;
            $login = $_POST['nome'];
            $senha = $_POST['senha'];
            $usuario = new Usuario();
            $usuario->setlogin($login);
            $usuario->setSenha($senha);
            $usuario->setAtivo(1);
            if ($dao->exists($usuario)) {
                $usuario = $dao->pesquisar($usuario, "login = '" . $usuario->getLogin() . "' and senha = '" . $usuario->getSenhaMD5() . "'");
                $usuario = $usuario[0];
                $_SESSION['usuario'] = serialize($usuario);
                header("Location: /SISMAC/?c=usuario&v=home");
            } else {
                $_SESSION['msgbody'] = "Usu&aacute;rio n&atilde;o encontrado.";
                $_SESSION['title'] = "Erro ao logar";
                $_SESSION['msgclass'] = "msg-erro";
                header("Location: /SISMAC/?c=usuario&v=login");
            }

            break;
        case 'forma_pagamento':
            addFormaPagamento($dao);
            break;
        case 'parametros':
            parametros($dao);
            break;
        default:

            break;
    }
}

function salvar(GenericDAO $dao) {
    //  showDetails($_REQUEST);
    // exit;
    $id = $_REQUEST['id_usuario'];
    $nome = $_REQUEST['nome_usuario'];
    $sobrenome = $_REQUEST['sobrenome_usuario'];
    $senha = $_REQUEST['senha_usuario'];
    $senhaconfirm = $_REQUEST['senha_usuario_confirmacao'];


    if (strcmp($senha, $senhaconfirm) == 0) {

        $usuario = new Usuario();

        if ($id > 0) {
            $usuario = $dao->pesquisar(new Usuario(), "id=$id");
            $usuario = $usuario[0];
        }

        $usuario->setId($id);
        if (strlen($sobrenome) > 0) {
            $usuario->setLogin($nome . "." . $sobrenome);
            $usuario->setNome($nome . " " . $sobrenome);
        } else {
            $usuario->setLogin($nome);
            $usuario->setNome($nome);
        }

        $usuario->setNome($nome . " " . $sobrenome);
        $usuario->setSenha(md5($senha));
        $usuario->setIdPerfil($_REQUEST['perfil']);

        if ($id > 0) {
            $dao->editar($usuario);
        } else {

            $uExist = $dao->pesquisar(new Usuario(), " login= '" . $usuario->getLogin() . "'");
            if ($uExist) {
                $uExist = $uExist[0];
                if ($uExist->getAtivo()) {
                    $_SESSION['title'] = "Erro";
                    $_SESSION['msgbody'] = "O login " . $usuario->getLogin() . " j&aacute; foi definido, e por isso n&atilde;o"
                            . " pode ser atribuido &agrave; outro usu&aacute;rio.";
                    $_SESSION['msgclass'] = "msg-erro";
                } else {
                    $_SESSION['title'] = "Erro";
                    $_SESSION['msgbody'] = "J&aacute; existe um us&aacute;rio com o login " . $usuario->getLogin() . ", por&eacute; "
                            . "est&aacute; inativo, Deseja Ativ&aacute;-lo novamente ? <a href='controllers/usuario/controller.php?m=restaurar&id=" .
                            $uExist->getId() . "'  >Sim</a>.";
                    $_SESSION['msgclass'] = "msg-erro";
                }
                header("Location: /SISMAC/?c=usuario&v=salvar");
                exit;
            } else {
                $usuario->setAtivo(1);
                $dao->inserir($usuario);
            }
        }
        $_SESSION['title'] = "Sucesso";
        $_SESSION['msgbody'] = "Usu&aacute;rio cadastrado com sucesso.";
        $_SESSION['msgclass'] = "msg-success";
        header("Location: /SISMAC/?c=usuario&v=salvar&id=" . $usuario->getId());
    } else {
        $_SESSION['title'] = "Erro";
        $_SESSION['msgbody'] = "Senhas informadas não correspondem.";
        $_SESSION['msgclass'] = "msg-erro";
        if ($id > 0) {
            header("Location: /SISMAC/?c=usuario&v=salvar&id=$id");
        } else {
            header("Location: /SISMAC/?c=usuario&v=salvar");
        }
    }
}

function excluir(GenericDAO $dao) {

    $id = $_REQUEST['id'];

    if ($dao->query("UPDATE marina.usuario SET ativo=0 WHERE id = $id") > 0) {
        $_SESSION['title'] = "Sucesso";
        $_SESSION['msgbody'] = "Usu&aacute;rio exclu&iacute;do com sucesso.";
        $_SESSION['msgclass'] = "msg-success";
    } else {
        $_SESSION['title'] = "Falha";
        $_SESSION['msgbody'] = "Usu&aacute;rio n&atilde;o foi exclu&iacute;do.";
        $_SESSION['msgclass'] = "msg-warning";
    }
    header("location: /SISMAC/?c=usuario&v=salvar");
}

function restaurar(GenericDAO $dao) {


    $dao->query("UPDATE marina.usuario SET ativo=1 WHERE id = " . $_REQUEST['id']);

    $_SESSION['title'] = "Sucesso";
    $_SESSION['msgbody'] = "Usu&aacute;rio restaurado com sucesso.";
    $_SESSION['msgclass'] = "msg-success";
    header("location: /SISMAC/?c=usuario&v=salvar");
}

function addFormaPagamento(GenericDAO $dao) {

    $forma = $_REQUEST['forma'];

    if (strlen($forma) > 0) {

        if (isset($_REQUEST['inserir']) && !$_REQUEST['inserir']) {
            $dao->query("UPDATE marina.formapagamento SET ativo=0 where descricao = '$forma'");
        } else {
            if (isset($_REQUEST['restore'])) {
                $dao->query("UPDATE marina.formapagamento SET ativo=1 where descricao = '$forma'");
            } else {
                $dao->query("INSERT INTO marina.formapagamento(descricao)values('$forma');");
            }
        }
    }
    header("Location: /SISMAC/?c=parametros&v=configurar");
}

function parametros(GenericDAO $dao) {
    foreach ($_POST as $chave => $parametro) {
        $dao->query("UPDATE marina.parametros SET valor='$parametro' WHERE chave='$chave'");
    }
    header("Location: /SISMAC/?c=parametros&v=configurar");
}

?>