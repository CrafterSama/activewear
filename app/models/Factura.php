<?php

//use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Factura extends Eloquent {

    //use SoftDeletingTrait;

	protected $table = 'facturas';
	public $timestamp = true;

	public function items()
    {
        return $this->hasMany('Item')->withTrashed();
    }

    public function pago()
    {
        return $this->hasOne('Pago', 'factura_id', 'id');
    }

    public function total()
    {
        $total = 0;
        foreach ($this->items as $key => $item) {
            $total+= ($item->precio * $item->cantidad );
        }
        return $total;
    }

}