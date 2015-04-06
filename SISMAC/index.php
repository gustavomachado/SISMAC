<?php

session_start();
require_once('config.php');
require_once ($path . 'resources/lib/raelgc/view/Template.php');
require_once ($path . 'resources/functions/functions.php');
require_once ($path . 'utils/Banco.php');

$viewsPath = "view/template-client/";

#echo date('t');

if (!isset($_SESSION['usuario']) && ( strcmp($_GET['v'], "login") != 0 )) {
    header("Location: controllers/usuario/controller.php?m=logout");
}

use raelgc\view\template;
/*
$handle = printer_open("MP-4200 TH");

printer_start_doc($handle, "Pedido " . $comanda);
printer_draw_text($handle, "  Mesa: teste", 295, 20);
printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);*/
$template = new Template("resources/template/template.html");

$template->addFile("HEAD", $viewsPath . "head.html");

$banco = new Banco();

if (isset($_GET['v'])) {

    $loader = getLoader($_GET);

    if (file_exists($loader)) {

        require_once ('view/loader/header.php');
        require_once ('view/loader/footer.php');
        $template->addFile("NAV", $viewsPath . "/nav.html");
        include $loader;
    } else {
        $template->addFile("CONTENT", $viewsPath . "/usuario/login.html");
    }
} else {
    header("Location: ?c=usuario&v=login");
}

$template->show();
?>