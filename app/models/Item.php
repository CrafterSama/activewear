<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Item extends Eloquent {

    use SoftDeletingTrait;
    
    protected $table = 'items';
    public $timestamp = true;
    protected $softDelete = true;

	public function product()
    {
        return $this->hasOne('Product', 'id', 'producto_id')->withTrashed();
    }
    public function factura()
    {
    	return $this->hasOne('Factura', 'id', 'factura_id');
    }
    public static function countItems($id)
    {
        $items = Item::withTrashed()->where('factura_id','=',$id)->get();
        return count($items);
    }
    public static function totalItems($id)
    {
        $totales = DB::table('items')->where('factura_id','=',$id)->get();
        if ($totales) {
            $tItems = 0;
            foreach ($totales as $total) {
                $tItems += $total->cantidad;
            }
            return $tItems;
        } else {
            return 'No Hay Monto Asociado';
        }
    }
    public static function totalFactura($id)
    {
        /*print_r($id);
        /*return '123456';*/
        $totales = DB::table('items')->where('factura_id','=',$id)->get();
        if ($totales) {
            $tFactura = 0;
            foreach ($totales as $total) {
                $tFactura += $total->cantidad*$total->precio;
            }
            return $tFactura;
        } else {
            return 'No Hay Monto Asociado';
        }
    }
}