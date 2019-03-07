<?php 

	require_once '../core/Config.php';
	require_once '../core/Tabela.class.php';

	$estabelecimento = $_POST['estabelecimento'];
	$proprietario = $_POST['primeiroNome'].' '.$_POST['sobrenome'];
	$cidade = $_POST['cidade'];
	$rua = $_POST['rua'];
	$bairro = $_POST['bairro'];
	$tipo_restaurante = $_POST['tipo_estabelecimento'];
	$tel_fixo = $_POST['telefone'];
	$email = $_POST['email'];

	$estabelecimento = new Tabela($conexao->pdo,'estabelecimento'); 
	
	$estabelecimento->nome_estabelecimento = $estabelecimento;
	$estabelecimento->nome_proprietario = $proprietario;
	$estabelecimento->cidade = $cidade;
	$estabelecimento->rua = $rua;
	$estabelecimento->bairro = $bairro;
	$estabelecimento->tipo_restaurante = $tipo_restaurante;
	$estabelecimento->tel_fixo = $tel_fixo;
	$estabelecimento->email = $email;
	
	$estabelecimento->salvar();

	if ($estabelecimento->salvar()) {
		echo 1;
	}else{
		echo 0;
	}