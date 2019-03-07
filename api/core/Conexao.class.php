<?php

	/**
	* Manipulador de banco de dados MySQL Orientado à Objeto
	* @author Augusto Clemente <augustosurubim@gmail.com>
	* @link https://github.com/AugustoClemente/ORM-MySql
	* @version 1.00
	* @access public
	*/
	class Conexao
	{
		/**
	    * Nome do Host MySQL 
	    * @access private
	    * @var string
	    */
	    private $host;

	    /**
	    * Usuário do Banco de Dados MySQL
	    * @access private
	    * @var string
	    */
	    private $usuario;

	    /**
	    * Senha do Usuário do Banco de Dados MySQL
	    * @access private
	    * @var string
	    */
	    private $senha;

	    /**
	    * Nome do Banco de Dados
	    * @access private
	    * @var string
	    */
	    private $bd;

	    /**
	    * Objeto PDO da conexão com MySQL
	    * @access public
	    * @var string
	    */
	    public $pdo;


	    /**
	    * Construtor da Classe MySql
		*
	    * @param string host (Host MySql)
	    * @param string usuario (Usuário MySql)
	    * @param string senha (Senha do Usuário MySql)
	    * @param string bd (Nome do Banco de Dados)
	    * @access public
	    */
	    function __construct($host,$usuario,$senha,$bd) {
	        $this->host 	= $host;
	        $this->usuario 	= $usuario;
	        $this->senha	= $senha;
	        $this->bd	= $bd;
	        $this->conectar();
	    }


	    /**
	    * Estabelece a conexão com o MySQL e seleciona o banco de dados
		*
	    * @return void
	    * @access private
	    */
	    function conectar() {
	        try 
			{
			    $pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->bd.";charset=utf8", $this->usuario, $this->senha);
			    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $this->pdo = $pdo;
			} catch(PDOException $e) {
			    echo 'ERROR: ' . $e->getMessage();
			}
	    }

	}