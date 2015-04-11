<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Product extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

  use SoftDeletingTrait;

	protected $table = 'products';

  protected $softDelete = true;

	public function stamps()
	{
 		return $this->hasMany('Stamp');
	}
	public function modelos()
	{
 		return $this->hasMany('Modelo');
	}
	/*public static $rules = array(
		'amounts_' 	=> 'required|numeric',
		/*'price_out_tax_float' 	=> 'required',
		'email' 		=> 'required|email|unique:users,email,id',
		'password' 	=> 'required|min:6',
		'role_id' 	=> 'numeric'
   	);*/

   	public static $messages = array(

		'amounts.required' => 'Rellenar la Cantidad es obligatorio',
		'amounts.numeric' => 'Cantidad solo acepta Datos Numericos',
   	);
   	public static function validate($data, $id=null){
		$reglas = self::$rules;
		$reglas['amounts'] = str_replace('id', $id, self::$rules['amounts']);
		$messages = self::$messages;
		return Validator::make($data, $reglas);
   	}
   	public static function getAmounts($id)
   	{
   		$amounts = Product::where('model_id','=', $id)
                    ->where('amounts','!=','0')
                    ->pluck(DB::raw('sum(amounts)'));

        return $amounts;
   	}
   	public static function getModelByStampId($id)
   	{
   		return DB::table('products')
   				->where('stamp_id','=',$id)
   				->pluck('model_id');
   	}
   	public static function totalPzs()
   	{
   		return $amounts = Product::where('amounts','!=','0')
        		->pluck(DB::raw('sum(amounts)'));
   	}
   	public static function totalBs()
   	{
   		$cantidades = Product::where('amounts','!=','0');

      return $cantidades;
   	}
   	public static function getBrand($id = null)
   	{
        $brand = Product::find($id)->pluck('brand');

        return $brand;
   	}
}