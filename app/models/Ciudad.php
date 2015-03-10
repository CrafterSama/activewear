<?php

class Ciudad extends Eloquent {

	protected $table = 'ciudades';
	public $timestamps = false;

	public function estado()
    {
        return $this->belongsTo('Estado', 'estado_id', 'id');
    }
        public static function getName($id)
    {
        $ciudad = Ciudad::find($id);
        if($ciudad){
            return $ciudad->ciudad;
        }else{
            return 'No hay Ciudad Asociada';
        }
    }

}