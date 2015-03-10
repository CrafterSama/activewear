<?php

class Pago extends Eloquent {

	protected $table = 'pagos';
	public $timestamp = true;

	public function factura()
    {
        return $this->hasOne('Factura');
    }
    public static function getBank($id)
    {
        $pay = DB::table('pagos')
                    ->where('factura_id','=',$id)
                    ->pluck('banco');
        if(is_null($pay)){
            return 'No hay banco asociado';
        }else{
            return $pay;
        }
    }
    public static function getBill($id)
    {
        $pay = DB::table('pagos')
                    ->where('factura_id','=',$id)
                    ->pluck('recibo');
        return $pay;
    }
    public static function getAmount($id)
    {
        $pay = DB::table('pagos')
                    ->where('factura_id','=',$id)
                    ->pluck('monto');
        return $pay;
    }
    public static function getAdj($id)
    {
    	$pay = DB::table('pagos')
    				->where('factura_id','=',$id)
    				->pluck('adjunto');
    	if ($pay) {
    		return $pay;
    	} else {
			return 'Sin Pagar';
    	}
    	
    }

}