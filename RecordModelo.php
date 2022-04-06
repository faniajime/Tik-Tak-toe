<?php

/**
 * Modelo Direccion.
 *
 */
class RecordModelo
{
	/**
	 * Constructor
	 */
	function __construct($nombre, $tiempo)
	{
		$this->nombre = $nombre;
		$this->tiempo = $tiempo;
	}

	function serialice(){
		return $this->nombre.':'.$this->tiempo;
	}
}