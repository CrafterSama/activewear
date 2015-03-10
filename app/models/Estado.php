<?php

class Estado extends Eloquent {

    protected $table = 'estados';
	public $timestamps = false;

    public function municipios()
    {
        return $this->hasMany('Municipio','estado_id');
    } 

    public function ciudades()
    {
        return $this->hasMany('Ciudad','estado_id');
    } 

    public function getEstadoAttribute($value)
    {
    	return $value;
    }
    public static function getName($id)
    {
        $estado = Estado::find($id);
        if (is_null($estado)) {
            return 'No hay Estado Asociado.';
        } else {
            return $estado->estado;
        }
        
    }
}