<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/*public function role(){
		return $this->belongsTo('Role');
	}*/

	protected $softDelete = true;
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	public static $rules = array(
		'full_name' 	=> 'required',
		'username' 	=> 'required|min:2|max:16|unique:users,username,id',
		'email' 		=> 'required|email|unique:users,email,id',
		'password' 	=> 'required|min:6',
		'user_mobile' 	=> 'required',
		'user_address' 	=> 'required',
		'role_id' 	=> 'numeric'
   	);
   	public static $messages = array(
		'full_name.required' => 'El nombre completo es obligatorio.',
		'user_mobile.required' => 'El telefono es obligatorio.',
		'user_address.required' => 'La direccion es obligatoria.',
		'username.require' => 'El Nombre de Usuario es Obligatorio.',
		'username.min' => 'El Nombre de Usuario debe tener minimo dos caracteres.',
		'username.max' => 'El Nombre de Usuario debe tener mmaximo 10 caracteres.',
		'username.unique' => 'El Nombre de Usuario ya esta tomado.',
		'email.required' => 'El email es obligatorio.',
		'email.email' => 'El email debe contener un formato válido.',
		'email.unique' => 'El email pertenece a otro usuario.',
		'password.required' => 'La contraseña es obligatoria.',
		'password.min' => 'La contraseña debe tener como minimo seis caracteres.'
		/*'level.required' => 'El nivel es obligatorio.',*/
		/*'role_id.numeric' => 'El nivel debe ser numérico.'*/
   	);
   	public static function validate($data, $id=null){
		$reglas = self::$rules;
		$reglas['email'] = str_replace('id', $id, self::$rules['email']);
		$reglas['username'] = str_replace('id', $id, self::$rules['username']);
		$messages = self::$messages;
		return Validator::make($data, $reglas);
   	}
	
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public static function getName($id)
	{
		$name = User::find($id);
		if($name)
		{
			return $name->full_name;
		}else{
			return 'false';
		}
	}

	public static function getAddress($id)
	{
		$address = User::find($id);
		return $address->user_address;
	}
	public static function getEstado($id)
	{
		$address = User::find($id);
		return $address->estado;
	}
	public static function getCiudad($id)
	{
		$address = User::find($id);
		return $address->municipio;
	}

	public static function getPhone($id)
	{
		$phone = User::find($id);
		return $phone->user_mobile;
	}

	public function facturas()
    {
        return $this->hasMany('Factura');
    }

}
