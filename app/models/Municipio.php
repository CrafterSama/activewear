<?php

class Municipio extends Eloquent {

	protected $table = 'municipios';
	public $timestamps = false;

    public function estado()
    {
        return $this->belongsTo('Estado', 'estado_id', 'id');
    }

	public function parroquias()
    {
        return $this->hasMany('Parroquia', 'municipio_id', 'id');
    }
    public static function getName($id)
    {
        $municipio = Municipio::find($id);
        if(is_null($municipio))
        {
            return 'no hay Municipio Asociado';
        }
        else
        {
            return $municipio->municipio;
        }
    }

}