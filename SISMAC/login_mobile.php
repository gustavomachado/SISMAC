<?php
session_start();
require_once('config.php');
require_once ($path . 'resources/functions/functions.php');

if (isset($_SESSION['msgbody'])) {

    $MSG_CLASS = 'msg ' . get('msgclass');
    $MSG_TITLE = get('title');
    $MSG_BODY = get('msgbody');

    unset($_SESSION['msgclass']);
    unset($_SESSION['title']);
    unset($_SESSION['msgbody']);
} else {

    $MSG_CLASS = "no-msg";
}
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
        <div id="msg-area" class="<?=$MSG_CLASS?>">
            <h2><?=$MSG_TITLE?></h2>
            <h4><?=$MSG_BODY?></h4>
        </div>
        <div class="col-lg-12  text-center main-header " >
            <img src="resources/images/logo.png" style="max-height: 100%;">
        </div>

        <div class="content-main-mobile" style="border: 1px solid black; min-height: 52%;">
            <form class="form col-lg-12" method="post" action="controllers/usuario/controller.php?m=login&mobile=1">
                <legend>Login</legend>
                <fieldset>

                    <div class="form-group">
                        <label>Usu&aacute;rio</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input class="form-control" type="text" name="nome" placeholder="EX. gustavo.machado">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Senha</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </span>
                            <input class="form-control" type="password" name="senha" >
                        </div>
                    </div>

                </fieldset>
                <div class="form-group ">
                    <button class="btn btn-info " type="submit">Logar</button>
                </div>
            </form>
        </div>

        <div class="linha"></div>
        <div class="footer">

        </div>
    </body>
</html>