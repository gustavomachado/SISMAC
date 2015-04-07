<?php

require_once ( $path . 'model/DAO/UsuarioDAO.php');
require_once ( $path . 'model/Bean/Usuario.php');
require_once ( $path . 'resources/functions/functions.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$template->SELECTED3 = "selected";

$template->addFile("CONTENT", 'view/template-client/usuario/salvar.html');
$template->addFile("SIDEBAR", "view/template-client/usuario/sidebar.html");

$usuarioDAO = new UsuarioDAO(new Banco());




$uLogado = unserialize($_SESSION['usuario']);

if ($uLogado->getIdPerfil() == 1) {
    $listaUsuarios = $usuarioDAO->pesquisar(new Usuario(), "ativo=1 and login != 'admin' ");
    foreach ($listaUsuarios as $usuario) {
        $template->USUARIO = $usuario->getLogin();
        $template->ID = $usuario->getId();
        $template->block("LISTA_USUARIOS");
    }
} else {
    if (!isset($_REQUEST['id']) || $_REQUEST['id'] != $uLogado->getId()) {
        header("Location: ?c=usuario&v=salvar&id=" . $uLogado->getId());
        exit;
    }
}



if (isset($_REQUEST['id'])) {
    $usuario = $usuarioDAO->pesquisar(new Usuario(), "id=" . $_REQUEST['id']);
    $usuario = $usuario[0];

    $login = $usuario->getLogin();
    $loginArray = explode(".", $login);
    $template->NOME_USUARIO = $loginArray[0];
    $template->SOBRENOME_USUARIO = $loginArray[1];
    $template->ID_USUARIO = $_REQUEST['id'];
}

if ($uLogado->getIdPerfil() == 1) {
    $perfis = $usuarioDAO->query("SELECT * FROM marina.perfil order by perfil");
    while ($linha = $usuarioDAO->fetch($perfis)) {
        $template->ID_PERFIL = $linha['idperfil'];
        $template->PERFIL = $linha['perfil'];
        if (isset($_REQUEST['id'])) {
          //  echo $usuario->getIdPerfil() . " - " . $linha['idperfil'] . "<br>";
            if ($usuario->getIdPerfil() == $linha['idperfil']) {
                $template->SELECTED = "selected";
            } else {
                $template->clear("SELECTED");
            }
        } else {
            //  $template->clear("SELECTED");
        }
        $template->block("PERFIS");
    }
} else {
    $perfis = $usuarioDAO->query("SELECT * FROM marina.perfil where idperfil != 1 order by perfil");
    while ($linha = $usuarioDAO->fetch($perfis)) {
        $template->ID_PERFIL = $linha['idperfil'];
        $template->PERFIL = $linha['perfil'];
        if (isset($_REQUEST['id'])) {
            if ($usuario->getIdPerfil() == $linha['idperfil']) {
                $template->SELECTED = "selected";
            } else {
                $template->clear("SELECTED");
            }
        } else {
            $template->clear("SELECTED");
        }
        $template->block("PERFIS");
    }
}
?>