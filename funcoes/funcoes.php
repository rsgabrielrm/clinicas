<?php 
	function chk_array ( $array, $key ) {
		// Verifica se a chave existe no array
		if ( isset( $array[ $key ] ) && ! empty( $array[ $key ] ) ) {
			// Retorna o valor da chave
			return $array[ $key ];
		}
		// Retorna nulo por padrão
		return null;
	} // chk_array

	function devolve_data_ptBR( $data ){
		if( $data ){
			return $newDate = date("d/m/Y", strtotime($data));
		}
		return;
	}
	function devolve_hora_ptBR( $hora ){
		if( $hora ){
			return substr($hora, 0,5);
		}
		return;
	}
	function devolve_data_mysql( $dia, $mes, $ano ){
		if( $dia && $mes && $ano ){
			return $ano.'-'.$mes.'-'.$dia;
		}
		return;
	}
	function devole_hora_mysql( $hora, $minuto ){
		if( $hora && $minuto ){
			return $hora.':'.$minuto.':00';
		}
		return;
	}