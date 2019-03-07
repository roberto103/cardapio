<?php 

	require_once '../core/Config.php';
	require_once '../core/Tabela.class.php';

	$estabelecimento = new Tabela($conexao->pdo,'estabelecimento'); 
	$estabelecimento->filtrarPorId($_POST['id']);

	$estabelecimento->cont_acesso = $estabelecimento->cont_acesso + 1;
	
	
	echo json_encode($estabelecimento->salvar());