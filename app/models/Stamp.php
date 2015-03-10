<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Stamp extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'stamps';

		/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */

	public function products()
	{
		return $this->hasMany('Product','stamp_id','id');
	}
	public static function getId($name)
	{
		$stamp = Stamp::find($name);
		return $stamp->id;
	}
	public static function getName($id)
	{
		$stamp = Stamp::find($id);
		if (is_null($stamp)) {
			return 'No se Encuentra Imagen Asociada';
		} else {
			return $stamp->stamp;
		}
		
	}
	public static function getStampName($id)
	{
		$stamp = Stamp::find($id);
		if (is_null($stamp)) {
			return 'No se Encuentra Nombre Asociado';
		} else {
			return $stamp->stampname;
		}
		
	}
	public static function getStampCode($id)
	{
		$stamp = Stamp::find($id);
		if (is_null($stamp)) {
			return 'No se Encuentra Nombre Asociado';
		} else {
			return $stamp->stampcode;
		}
		
	}
	public static function getStampDesc($id)
	{
		$stamp = Stamp::find($id);
		if (is_null($stamp)) {
			return 'No se Encuentra Nombre Asociado';
		} else {
			return $stamp->stampdesc;
		}
		
	}

}