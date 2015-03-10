<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class ProdToOrder extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'prod_to_orders';

	public static function getQty($id)
	{
		$qty = DB::table('prod_to_orders')->where('order_id','=',$id)->pluck('quantities');

		return $qty;
	}

}