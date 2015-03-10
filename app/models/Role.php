<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Role extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'roles';

	public function user()
	{
 		return $this->hasMany('User');
	}
	public static function getName($id)
	{
		$rol = Role::find($id);
		return $rol->role_name;
	}

}