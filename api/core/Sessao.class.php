<?php

	require_once 'Conexao.class.php';
	require_once 'Config.php';

	/**
	* Classe abstrata para controlar Sessões
	* Tabela deve conter: id, nome, usuario, senha
	* @author Augusto Clemente <augustosurubim@gmail.com>
	* @link https://github.com/AugustoClemente/
	* @version 1.00
	* @access public
	*/
	abstract class Sessao
	{
		
		static function estaLogado()
		{
			if (session_status() === PHP_SESSION_DISABLED)
			{
				session_start();
			}
	 
			if (!isset($_SESSION['usuario-logado'])) {
			    Sessao::logout();
			    return false;
			} else {
				return true;
			}
		}


		static function logout()
		{
			if (session_status() === PHP_SESSION_DISABLED)
			{
				session_start();
			}

		    if (!session_status() === PHP_SESSION_DISABLED)
			{
				$_SESSION['usuario-nome'] = NULL;
			    $_SESSION['usuario-logado'] = NULL;

			    unset ($_SESSION['usuario-nome']);
			    unset ($_SESSION['usuario-logado']);
			    
		    	session_destroy();
		    }
		}


		static function login($tabela, $email, $senha)
		{
			$conexao = new Conexao(host, user, password, dbname);

			$handler = $conexao->pdo->prepare('SELECT * FROM '.$tabela.' WHERE email = :email AND senha = :senha');
			
			$handler->bindValue(':email', $email);
			$handler->bindValue(':senha', $senha);
			// $handler->bindValue(':senha', md5(salt.$senha));
			$handler->execute();
			$administrador = $handler->fetch(PDO::FETCH_OBJ);

			$logado = $handler->rowCount();

			if ($logado)
			{
				if (session_status() === PHP_SESSION_DISABLED)
				{
					session_start();
				}
	     
			    $_SESSION['usuario-logado'] = 1;
			    $_SESSION['usuario-nome'] = $administrador->nome;

			    return true;
			} else {
				Sessao::logout();
				return false;
			}
		}
	}