<?php
session_start();
require_once('config.php');
require_once ($path . 'resources/functions/functions.php');
require_once ($path . 'utils/Banco.php');
?>


<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="resources/images/logo.png">
        <title>SisMAC-Marina &Aacute;guas Claras</title>
        <link rel="stylesheet" href="resources/css/bootstrap.css">
        <link rel="stylesheet" href="resources/css/font-awesome.css">
        <link rel="stylesheet" href="resources/css/bootstrap-datetimepicker-site.css">
        <link rel="stylesheet" href="resources/css/pygments-manni.css">
        <link rel="stylesheet" href="resources/css/bootstrap-datetimepicker.css">
        <link rel="stylesheet" href="resources/css/style.css">

        <script type="text/javascript" src="resources/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="resources/js/jquery-ui.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap.js"></script>
        <script type="text/javascript" src="resources/js/extenso.js"></script>
        <script type="text/javascript" src="resources/js/functions.js"></script>
        <script type="text/javascript" src="resources/js/jquery.mask.js"></script>
        <script type="text/javascript" src="resources/js/jquery.maskMoney.js"></script>
        <script type="text/javascript" src="resources/js/moment.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <div class="col-lg-12  text-center main-header " >
            <img src="resources/images/logo.png" style="max-height: 100%;">
        </div>

        <div class="content-main-mobile" style="border: 1px solid black; min-height: 62%;">
            <div class="col-lg-6">
                <label>Embarca&ccedil;&atilde;o</label>
                <input id="emb" type="text" class="form-control" >
            </div>
            <div class="col-lg-3">
                <a class="btn btn-info search" >
                    <span class="glyphicon glyphicon-search search"></span>
                    Buscar
                </a>
                <img src="resources/images/ajax_loader.gif" class="loading">
            </div>
            <div class="lista-pesquisa col-lg-12" style="margin-top: 20px; ">
                
            </div>
        </div>
    </body>
</html>
