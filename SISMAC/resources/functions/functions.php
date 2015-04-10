<?php

require_once $path . 'config.php';

function getView($get) {
    $view = "view/template-client/";
    $view .= $get['c'];
    $view .= "/";
    $view .= $get['v'];
    $view .= ".html";
    return $view;
}

function getController($get) {
    $page = "controllers/";
    $page .= $get['c'];
    $page .= "/controller.php?m=";
    $page .= $get['m'];
    return $page;
}

function getLoader($get) {
    $loader = "view/loader/";
    $loader .= $get['c'];
    $loader .= "/";
    $loader .= $get['v'];
    $loader .= ".php";
    return $loader;
}

function showDetails($bean) {
    echo "<pre>";
    print_r($bean);
    echo "</pre>";
}

function removeMascara($text, $mask) {

    for ($i = 0; $i < strlen($mask); $i++) {
        $text = str_replace($mask[$i], '', $text);
    }
    return $text;
}

function parseDateSQL($date) {
    $sqlDate = substr($date, 6, 4) . "-";
    $sqlDate .= substr($date, 3, 2) . "-";
    $sqlDate .= substr($date, 0, 2);
    return $sqlDate;
}

function parseDatePTBR($date) {
    $PTBRDate = substr($date, 8, 2) . "/";
    $PTBRDate .= substr($date, 5, 2) . "/";
    $PTBRDate .= substr($date, 0, 4);
    return $PTBRDate;
}

function parseMoneySQL($money) {
    return str_replace($money, ",", ".");
}

function parseMoneyPTBR($money) {
    
}

function mask($val, $mask, $money = false) {
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
        if ($mask[$i] == '#') {
            if (isset($val[$k])) {
                $maskared .= $val[$k++];
            }
        } else {
            if (isset($mask[$i])) {
                $maskared .= $mask[$i];
            }
        }
    }
    return $maskared;
}
/*
function getPrimmeiraMensalidade(Contrato $contrato) {
    $dataInicio = date("Y-m-d");
    $venciemento = ($contrato->getVencimento());
    $valorMensalidade = $contrato->getMensalidade();
    $difDias = 0;
    $desconto = 0;
    $numeroDiasMes = date("t", strtotime($dataInicio));
    $diaInicio = date("d", strtotime($dataInicio));
    $diaria = $valorMensalidade / $numeroDiasMes;
    if ($venciemento > $numeroDiasMes)
        $venciemento = $numeroDiasMes;
    if ($diaInicio > $venciemento) {
        $difDias = $numeroDiasMes - $diaInicio + $venciemento;
    } else if ($diaInicio < $venciemento) {
        $difDias = $venciemento - $diaInicio;
    }
    if ($difDias > 0) {
        $desconto = $valorMensalidade - $diaria * $difDias;
    }
    $mensalidadeObj = new Mensalidade();
    $mensalidadeObj->setDesconto($desconto);
    $mensalidadeObj->setIdContrato($contrato->getId());
    $usuario = unserialize($_SESSION['usuario']);
    $mensalidadeObj->setIdUsuario($usuario->getId());
    $mensalidadeObj->setAtivo(1);
    $mensalidadeObj->setMesReferencia(date('m', strtotime($dataInicio)));
    $mensalidadeObj->setAnoReferencia(date('Y', strtotime($dataInicio)));
    return $mensalidadeObj;
}*/

//versão na marina
function getPrimmeiraMensalidade(Contrato $contrato) {

    $dataInicio = $contrato->getDataInicio();
    $venciemento = ($contrato->getVencimento());
    $valorMensalidade = $contrato->getMensalidade();
    $difDias = 0;
    $desconto = 0;
    $numeroDiasMes = date("t", strtotime($dataInicio));
    $diaInicio = date("d", strtotime($dataInicio));
    $diaria = $valorMensalidade / $numeroDiasMes;

    /*if (strcasecmp("pos", $contrato->getTipo()) == 0) {
        $dia = date('d', strtotime($dataInicio));
        $mes = date('m', strtotime($dataInicio)) - 1;
        $ano = date('Y', strtotime($dataInicio));
        $dataInicio = date("Y-m-d", mktime(0, 0, 0, $mes, $dia,$ano ));
    }*/
    if($venciemento > $numeroDiasMes)
        $venciemento = $numeroDiasMes;
  
    if ($diaInicio > $venciemento) {
        //  $difDias 	= $diaInicio - $venciemento;
        $difDias = $numeroDiasMes - $diaInicio + $venciemento;
    } else if ($diaInicio < $venciemento) {
        //     $difDias = $venciemento - $diaInicio;
        //     $difDias = $numeroDiasMes - $difDias;
        $difDias = $venciemento - $diaInicio;
    }
    if($difDias > 0 ){
        $desconto = $valorMensalidade - $diaria * $difDias;
    }
    
    $mensalidadeObj = new Mensalidade();
    $mensalidadeObj->setDesconto($desconto);
    $mensalidadeObj->setIdContrato($contrato->getId());
    $usuario = unserialize($_SESSION['usuario']);
    $mensalidadeObj->setIdUsuario($usuario->getId());
    $mensalidadeObj->setAtivo(1);
    $mensalidadeObj->setMesReferencia(date('m', strtotime($dataInicio)));
    $mensalidadeObj->setAnoReferencia(date('Y', strtotime($dataInicio)));
    return $mensalidadeObj;
}

function get($chave, $remove = false) {
    $valor = '';
    if (isset($_SESSION[$chave])) {
        $valor = $_SESSION[$chave];
        if ($remove)
            unset($_SESSION[$chave]);
    }
    #showDetails($_SESSION);
    return $valor;
}

function set($chave, $valor) {
    $_SESSION[$chave] = $valor;
}

function getMesExtenso($mes) {
    if (!$mes) {
        $mes = date("m");
    }
    $mesExtenso = array(
        "Jan" => "Janeiro", "Feb" => "Fevereiro", "Mar" => "Mar&ccedil;o", "Apr" => "Abril", "May" => "Maio", "Jun" => "Junho",
        "Jul" => "Julho", "Aug" => "Agosto", "Sep" => "Setembro", "Oct" => "Outubro", "Nov" => "Novembro", "Dec" => "Dezembro");

    return $mesExtenso[date("M", mktime(0, 0, 0, $mes, 1, date("Y")))];
}

function objectToArray($obj) {
    //   echo get_class($obj) . "chamou Object to array<br>";
    
    $resultado = array();
    $methodsList = get_class_methods($obj);
   
    foreach ($methodsList as $method) {
        if (strcasecmp(substr($method, 0, 3), "get") == 0) {
            $subObj = $obj->{"$method"}();
            $keyObj = substr($method, 3);
            $keyObj[0] = strtolower($keyObj[0]);
            if (is_array($subObj) && count($subObj) > 0) {
                foreach ($subObj as $key => $intObj) {
                    if (is_object($intObj)) {
                        $resultado [$keyObj][$key] = objectToArray($intObj);
                    } else {
                        $resultado [$keyObj][$key] = $intObj;
                    }
                }
            } else if (is_object($subObj)) {
                $resultado [$keyObj] = objectToArray($subObj);
            } else {
                $resultado [$keyObj] = $subObj;
            }
        }
    } 
    return $resultado;
}

?>