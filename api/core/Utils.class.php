<?php 

	/**
	* Classe abstrata com métodos utilitários
	* @author Augusto Clemente <augustosurubim@gmail.com>
	* @link https://github.com/AugustoClemente/
	* @version 1.00
	* @access public
	*/
	abstract class Utils
	{

		static function dataTela($pData) {
			$data_desinvertida = implode("/", array_reverse(explode("-", $pData)));	
			return $data_desinvertida;
		}

		static function dataBanco($pData) {
			$data_invertida = implode("-", array_reverse(explode("/", $pData)));	
			return $data_invertida;
		}
		
	}