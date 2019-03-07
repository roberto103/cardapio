<?php 

	require_once '../Config.php';
	require_once '../Tabela.class.php';

	$estabelecimento = new Tabela($conexao->pdo,'estabelecimento'); 

	$registrosEstabelecimento = $estabelecimento->filtrar('1=1','nome_estabelecimento ASC');
	
	foreach ($registrosEstabelecimento as $estab) {
		echo $estab->nome_estabelecimento.'<br>';
	}