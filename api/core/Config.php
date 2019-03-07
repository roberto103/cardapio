<?php

	require_once 'Conexao.class.php';
	
	//Dados de acesso ao Banco de Dados
	const host = '127.0.0.1';
	const dbname = 'cardapio';
	const user = 'root';
	const password = '';
	const salt = 'matrix';

	$conexao = new Conexao(host, user, password, dbname);