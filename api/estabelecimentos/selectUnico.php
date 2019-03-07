<?php 

	require_once '../core/Config.php';
	require_once '../core/Tabela.class.php';

	$estabelecimento = new Tabela($conexao->pdo,'estabelecimento'); 

	$estabelecimento->filtrarPorId($_GET['id']);
	
	echo json_encode($estabelecimento, true);
	 