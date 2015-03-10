<?php

/**********************************************************************
 * Active Wear Admin Panel
 * --------------------------------------------------------------------
 * File: Helper.php
 * Author: Julmer Olivero <jolivero.03@gmail.com>
 * Licence: GPLv3 - http://www.gnu.org/licenses/gpl.txt
 * --------------------------------------------------------------------
 * El archivo Helper.php Contiene varias funciones con las cuales se 
 * puede obtener el resultado deseado de algunos Objetos.
 **********************************************************************/

class Helper extends Eloquent
{
	

	private static function ConSoSinS($val, $sentence) 
	{
		if ($val > 1) return $val.str_replace(array('(s)','(es)'),array('s','es'), $sentence); 
		else return $val.str_replace('(s)', '', $sentence);
	}
	
	public static function getDate($dato)
	{
		$time = time() - $dato;

		if ($time <= 0) return 'Ahora';
		else if ($time < 60) return "Hace ".self::ConSoSinS(floor($time), ' Segundo(s)');
		else if ($time < 60*60) return "Hace ".self::ConSoSinS(floor($time/60), ' Minuto(s)');
		else if ($time < 60*60*24) return "Hace ".self::ConSoSinS(floor($time/(60*60)), ' Hora(s)');
		else if ($time < 60*60*24*30) return "Hace ".self::ConSoSinS(floor($time/(60*60*24)), ' Día(s)');
		else if ($time < 60*60*24*30*12) return "Hace ".self::ConSoSinS(floor($time/(60*60*24*30)), ' Mes(es)');
		else return "Hace ".self::ConSoSinS(floor($time/(60*60*24*30*12)), ' Año(s)');
	}

	public static function Modelos($id)
	{
		
	}
	public static function woutSpace($string)
	{
		$change = array(' '=>'-','ñ'=>'n');

		return strtr($string, $change);
	}

}