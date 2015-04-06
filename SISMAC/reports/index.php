<?php
require '../config.php';
require_once $path . 'resources/functions/functions.php';
require_once ($path . 'resources/lib/raelgc/view/Template.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use raelgc\view\template;

$template = new Template($_REQUEST['v'].".html");

include_once $_REQUEST['v'].".php";


$template->show();