<?php 

	require_once '../Config.php';
	require_once '../Tabela.class.php';

	$estabelecimento = new Tabela($conexao->pdo,'estabelecimento'); 
	$estabelecimento->filtrarPorId(1);

	$estabelecimento->nome_estabelecimento = 'La Bella Massa';
	$estabelecimento->email = 'augusto@uol.com.br';
	
	$estabelecimento->salvar();