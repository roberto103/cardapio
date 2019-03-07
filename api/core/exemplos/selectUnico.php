<?php 

	require_once '../Config.php';
	require_once '../Tabela.class.php';

	$estabelecimento = new Tabela($conexao->pdo,'estabelecimento'); 

	$estabelecimento->filtrarPorId(3);
	
	echo $estabelecimento->nome_estabelecimento;
	echo $estabelecimento->email;