<?php

	/**
	* Manipulador de tabelas MySQL Orientado à Objeto
	* @author Augusto Clemente <augustosurubim@gmail.com>
	* @link https://github.com/AugustoClemente/ORM-MySql
	* @version 1.00
	* @access public
	*/
	class Tabela
	{
		/**
		* Instância PDO
		* @access public
		* @var pdo
		*/
		public $pdo;

		/**
		* Tabela que esta classe manipula
		* @access public
		* @var string
		*/
		public $tabela;

		/**
		* A quantidade de registros retornados em algum método
		* @access public
		* @var string
		*/
		public $qtdRegistrosRetornados;


		/**
		* Array de todos os campos da tabela
		* @access public
		* @var array
		*/
		public $campos;
	
		
		/**
	    * Construtor da Classe
		*
	    * @param pdo $pdo (Objeto PDO)
	    * @param string $tabela (o nome da tabela que esta classe irá manipular)
	    * @access public
	    */
		function __construct($pdo,$tabela)
		{
			$this->pdo = $pdo;
			$this->tabela = $tabela;
			$this->limpar();
		}
	

		/**
	    * Filtra um registro da tabela pelo campo ID
		*
	    * @param int $id (id do registro que será filtrado na tabela)
	    * @return bool (true se econtrar o registro, false se não econtrar)
	    * @access public
	    */
		function filtrarPorId($id)
		{
			$handle = $this->pdo->prepare("SELECT *, count(id) AS registroEncontrado FROM ".$this->tabela." WHERE id = :id LIMIT 1");
			$handle->bindValue(':id',$id);
			$handle->execute();
			$resultadoSQL = $handle->fetch(PDO::FETCH_ASSOC);

			$retorno = '';

			foreach ($resultadoSQL as $campo => $valor) 
			{
				$this->$campo = $valor;

				if ($campo == 'registroEncontrado') 
				{
					if ($valor > 0)
					{
						$retorno = true;
					} else {
						$retorno = false;
					}

					$this->qtdRegistrosRetornados = $valor;
				}
			}

			return $retorno;
		}


		/**
	    * Retorna um array de objetos representando os registros filtrados por um critério
		*
	    * @param string $criterio (cláusula sql "where" para filtrar os registros retornados)
	    * @param string $ordenarPor (cláusula sql "order by" para ordenar os registros)
		* @return array or false (array se sucesso, false se nenhum registro retornado)
	    * @access public
	    */
		function filtrar($criterio,$ordenarPor)
		{
			$criterioSQL = str_ireplace(" E ", " AND ", $criterio);
			$criterioSQL = str_ireplace(" OU ", " OR ", $criterioSQL);
			$criterioSQL = str_ireplace(" ENTRE ", " BETWEEN ", $criterioSQL);
			$criterioSQL = str_ireplace(" EM ", " IN ", $criterioSQL);
			$criterioSQL = str_ireplace(" NAO ", " NOT ", $criterioSQL);
			$criterioSQL = str_ireplace(" COMO ", " LIKE ", $criterioSQL);

			$ordenarPorSQL = str_ireplace(" LIMITE ", " LIMIT ", $ordenarPor);

			$this->limpar();

			$retorno = array();

			$handle = $this->pdo->prepare("SELECT * FROM ".$this->tabela." WHERE ".$criterioSQL." ORDER BY ".$ordenarPorSQL);
			$handle->execute();
			$resultadoSQL = $handle->fetchAll(PDO::FETCH_OBJ);


			$handle = $this->pdo->prepare("SELECT count(id) AS qtdRegistrosRetornados FROM ".$this->tabela." WHERE ".$criterioSQL);
			$handle->execute();
			$tmp = $handle->fetch(PDO::FETCH_OBJ);
			$this->qtdRegistrosRetornados = $tmp->qtdRegistrosRetornados;


			if ($this->qtdRegistrosRetornados > 0)
			{
				
				foreach ($resultadoSQL as $registro) 
				{
					$retorno[] = $registro;
				}

				return $retorno;

			} else {
				return false;
			}
		}


		/**
	    * Deleta um registro da tabela
		*
	    * @param int $id (id do registro que será deletado da tabela)
	    * @return bool (true se sucesso, false se erro)
	    * @access public
	    */
		function deletar($id)
		{
			$handle = $this->pdo->prepare("DELETE FROM ".$this->tabela." WHERE id = :id");
			$handle->bindValue(':id',$id);
			
			if ($handle->execute()) 
			{
				return true;
			} else {
				return false;
			}

			$this->limpar();
		}


		/**
	    * Limpa a instância da tabela para valores padrão
		*
	    * @access public
	    */
		function limpar()
		{
			$handle = $this->pdo->prepare("DESCRIBE ".$this->tabela);
			$handle->execute();
			$atributos = $handle->fetchAll(PDO::FETCH_ASSOC);

			$this->campos = array();

			foreach ($atributos as $colunas) 
			{
				foreach ($colunas as $coluna => $valor) 
				{
					if ($coluna == 'Field')
					{
						$this->campos[] = $valor;
						$this->$valor = NULL;
					}
				}
			}
		}



		/**
	    * Insere ou atualiza um registro na tabela
		*
	    * @access public
	    */
		function salvar() 
		{
			
			if ($this->id == NULL) 
			{
				$sqlInsert = "INSERT INTO $this->tabela (" . implode(',', $this->campos) . ") VALUES (null,";

				foreach ($this->campos as $campo) 
				{
					if ($campo != 'id')
					{
						$sqlInsert .= ':'.$campo.',';
					}
				}

				$sqlInsert = substr($sqlInsert, 0, strlen($sqlInsert) - 1);
				$sqlInsert .= ")";

				$handle = $this->pdo->prepare($sqlInsert);

				foreach ($this->campos as $campo) 
				{
					if ($campo != 'id')
					{
						/* Estava dando erro porquê estava retornando um objeto e você não pode concatenar esse objeto com uma string */

						// $handle->bindValue(":$campo",$this->$campo);
						$handle->bindValue(":$campo", $campo);
					}
				}
				
				if ($handle->execute()) 
				{
					$this->id = $this->pdo->lastInsertId();
					return true;
				} else {
					return false;
				}

				
			} else {
				
				$sqlUpdate = "UPDATE $this->tabela SET ";

				foreach ($this->campos as $campo) 
				{
					if ($campo != 'id')
					{
						$sqlUpdate .= $campo.'=:'.$campo.',';
					}
				}

				$sqlUpdate = substr($sqlUpdate, 0, strlen($sqlUpdate) - 1);
				$sqlUpdate .= ' WHERE id=:id LIMIT 1';

				$handle = $this->pdo->prepare($sqlUpdate);

				foreach ($this->campos as $campo) 
				{
					if ($campo != 'id')
					{
						/* Estava dando erro porquê estava retornando um objeto e você não pode concatenar esse objeto com uma string */

						// $handle->bindValue(":$campo",$this->$campo);
						$handle->bindValue(":$campo", $campo);
					}
				}

				$handle->bindValue(":id",$this->id);
				
				if ($handle->execute()) 
				{
					return true;
				} else {
					return false;
				}

			}

		}


	}