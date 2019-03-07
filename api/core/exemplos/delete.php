<?php

	require_once '../Config.php';
	require_once '../Tabela.class.php';

	$estabelecimento = new Tabela($conexao->pdo,'estabelecimento');
	$estabelecimento->deletar(1);