<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Modelo extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'modelos';

	public function products()	{
		return $this->hasMany('Product', 'model_id', 'id', 'brand');
	}

	public static $rules = array(
		'model_name' 	=> 'required|unique:modelos,model_name,id',
		'price_out_tax_float' 	=> 'required',
/*		'email' 		=> 'required|email|unique:users,email,id',
		'password' 	=> 'required|min:6',
		'role_id' 	=> 'numeric'*/
   	);

   	public static $messages = array(
		'model_name.required' => 'El nombre del modelo es obligatorio.',
		'model_name.unique' => 'El nombre ya esta en el sistema.',
		'price_out_tax_float.require' => 'El Campo del precio es Obligatorio.'
   	);
   	public static function validate($data, $id=null){
		$reglas = self::$rules;
		$reglas['model_name'] = str_replace('id', $id, self::$rules['model_name']);
		$messages = self::$messages;
		return Validator::make($data, $reglas);
   	}

	public static function getName($id)
	{
		$modelo = Modelo::find($id);
		if(is_null($modelo))
		{
			return '&nbsp;&nbsp;"No hay Modelo Asociado" ';
		}
		else
		{
			return $modelo->model_name;
		}
	}
	public static function getNameByStamp($id)
	{
		return DB::table('modelos')
				->join('products','products.model_id','=','modelos.id')
				->join('stamps','products.stamp_id','=','stamps.id')
				->where('stamps.id','=',$id)
				->pluck('modelos.model_name');

	}
	public static function getPrice($id)
	{
		$modelo = Modelo::find($id);
		if($modelo)
		{
			//return $modelo->model_name;
			return $modelo->price_out_tax_float;
		}
		else
		{
			return '&nbsp;&nbsp;"No hay Precio Asociado(Borre el Producto)" ';
		}
	}

}