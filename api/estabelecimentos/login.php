<?php 
	
	require_once '../core/Config.php';
	require_once '../core/Sessao.class.php';

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

	if (Sessao::login('usuario', $usuario, $senha)){
		echo 1;
	} else {
		echo 0;
	}

 ?>