<?php 

	// require_once '../core/Config.php';
	// require_once '../core/Tabela.class.php';

	$estabelecimento = new Tabela($conexao->pdo,'estabelecimento'); 

	$registrosEstabelecimento = $estabelecimento->filtrar('1=1','nome_estabelecimento ASC');


