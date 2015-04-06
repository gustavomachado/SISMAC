<?php 
 
 require_once ( $path . 'model/Bean/Usuario.php');


$template->addFile("HEADER","view/template-client/header.html");

if(isset($_SESSION['usuario'])){

	$usuario = new Usuario();
	$usuario = unserialize($_SESSION['usuario']);
	$template->USUARIO_HEADER = $usuario->getLogin();
	$template->PERFIL_HEADER = $usuario->getPerfil();
}
 
if(isset($_SESSION['msgbody'])){

	$template->MSGCLASS 	= 'msg ' . get('msgclass');
	$template->TITLE 		= get('title');
	$template->MSGBODY 		= get('msgbody');

	unset($_SESSION['msgclass']	);
	unset($_SESSION['title']	);
	unset($_SESSION['msgbody']	);
}else{

	$template->MSGCLASS = "no-msg";
}




 ?>