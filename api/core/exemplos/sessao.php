<?php 

	require_once 'Config.php';
	require_once '../Sessao.class.php';

	
	//Verifica se está logado -----------------------------	

		if (!Sessao::estaLogado())
		{
			//direcionar para a página de login
		}


	//Fazer Login -----------------------------------------

		if (Sessao::login('tabela','usuario','senha'))
		{
			//direcionar para a página destino
		} else {
			//direcionar para a página de login
		}


	//Fazer Logout ----------------------------------------
	
		Sessao::logout();
		//direcionar para alguma página