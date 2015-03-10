<?php

class Parroquia extends Eloquent {

	protected $table = 'parroquias';
	public $timestamps = false;

	public function municipio()
    {
        return $this->belongsTo('Municipio', 'municipio_id', 'id');
    }
        public static function getName($id)
    {
        $parroquia = Parroquia::find($id);
        return $parroquia->parroquia;
    }

}