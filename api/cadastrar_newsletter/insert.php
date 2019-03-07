<?php 

	require_once '../core/Config.php';
	require_once '../core/Tabela.class.php';

	$newsletter = new Tabela($conexao->pdo,'newsletter'); 
	
	$newsletter->nome_usuario = $_POST['nome_usuario'];
	$newsletter->tel_usuario = $_POST['tel_usuario'];
	$newsletter->email_usuario = $_POST['email_usuario'];

	header("Location:../../index.php");
	
	
	echo json_encode($newsletter->salvar());
