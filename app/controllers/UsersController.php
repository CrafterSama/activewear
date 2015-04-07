<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class UsersController extends BaseController {

    use SoftDeletingTrait;

	private $autorizado;
	public function __construct() {
		$this->autorizado = (Auth::check() and Auth::user()->role_id == 1);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$users  = 	User::where('id','!=',Auth::user()->id)->paginate(10);
		$roles 	= 	Role::all();
		foreach ($users as $user) {
			$rol 	= 	Role::find($user->role_id);	# code...
		}
		if(is_null($users))
		{
			return View::make('admin.users');
		}
		else
		{
			return View::make('admin.users')->with('users',$users)->with('roles',$roles)->with('rol',$rol);
		}		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$user = new User();
		$roles = Role::all();
		$options = array();
		foreach ($roles as $role) {
			$options[$role->id] = $role->role_name;
		}
		$states = Estado::orderBy('estado','asc')->get();
        //$states = State::dropdown(1);
        $municipios = Municipio::orderBy('municipio','asc')->get();
        //$municipios = Municipio::dropdown(1);
		$estados = array();
		$ciudades = array();
		foreach ($states as $state) {
			$estados[$state->id] = $state->estado;
		}
		foreach ($municipios as $municipio) {
			$ciudades[$municipio->id] = $municipio->municipio;
		}
		return View::make('users.form')->with(['user' => $user, 'roles' => $roles, 'options' => $options, 'states' => $states, 'estados' => $estados, 'municipios' => $municipios, 'ciudades' => $ciudades]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$user = new User();
		$user->full_name = Input::get('full_name');
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->user_address = Input::get('user_address');
		$user->estado = Input::get('estado');
		$user->municipio = Input::get('municipio');
		$user->user_mobile = Input::get('user_mobile');
		$user->role_id = Input::get('role_id');

		$validator = User::validate(array(
			'full_name' => Input::get('full_name'),
			'username' => Input::get('username'),
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			'user_address' => Input::get('user_address'),
			'user_mobile' => Input::get('user_mobile'),
			'role_id' => Input::get('role_id'),
		));
		if($validator->fails()){
			$errors = $validator->messages()->all();
			$user->password = null;
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$user->save();
			return Redirect::to('admin/usuarios')->with('notice', 'El usuario ha sido creado correctamente.');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$user 	= 	User::find(Auth::user()->id);
		$idRol 	= 	$user->role_id;
		$rol 	= 	Role::find($idRol);
		return View::make('users.profile')->with('user', $user)->with('rol', $rol);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$user = User::find($id);
		if (is_null ($user))
		{
			App::abort(404);
		}
		$roles = Role::all();
		$options = array();
		foreach ($roles as $role) {
			$options[$role->id] = $role->role_name;
		}
		$states = Estado::orderBy('estado','asc')->get();
        //$states = State::dropdown(1);
        $cities = Ciudad::orderBy('ciudad','asc')->get();
        //$municipios = Municipio::dropdown(1);
		$estados = array();
		$ciudades = array();
		foreach ($states as $state) {
			$estados[$state->id] = $state->estado;
		}
		foreach ($cities as $city) {
			$ciudades[$city->id] = $city->ciudad;
		}
		return View::make('users.form')->with(['user' => $user, 'roles' => $roles, 'options' => $options, 'states' => $states, 'estados' => $estados, 'cities' => $cities, 'ciudades' => $ciudades]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$user = User::find($id);
		$user->full_name = Input::get('full_name');
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->role_id = Input::get('role_id');
		$user->user_address = Input::get('user_address');
		$user->estado = Input::get('estado');
		$user->municipio = Input::get('municipio');
		$user->user_mobile = Input::get('user_mobile');
		
		/*$validator = User::validate(array(
			'full_name' => Input::get('full_name'),
			'username' => Input::get('username'),
			'email' => Input::get('email'),
			'user_address' => Input::get('user_address'),
			'user_mobile' => Input::get('user_mobile'),				
			'role_id' => Input::get('role_id'), 
			'estado' => Input::get('estado'),
			'municipio' => Input::get('municipio'),
		), $user->id);
		
		if($validator->fails()){
			$errors = $validator->messages()->all();
			return Redirect::back()->withErrors($validator)->withInput();
		}else{*/
			$user->save();
			return Redirect::to('admin/usuarios')->with('notice', 'El usuario ha sido modificado correctamente.');
		/*}*/
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$user = User::find($id);
		if ($user->id == Auth::user()->id) 
		{
			return Redirect::to('admin/usuarios')->with('notice', 'No puedes borrar tu propio usuario.');
		} 
		else 
		{
			if (is_null($user))
			{
				App::abort(404);
			}
		
			$user->delete();
			
			if (Request::ajax())
			{
				return Response::json(array(
					'success' => true,
					'msg'	 => 'Usuario '.$user->full_name.' eliminado',
					'id'	 => $user->id
				));
			} 
			else 
			{
				return Redirect::back()->with('notice', 'El usuario ha sido eliminado correctamente.');	
			}
		}
	}
	public function showProfile($id)
	{
		$user 	= 	User::find($id);
		$idRol 	= 	$user->role_id;
		$rol 	= 	Role::find($idRol);
		return View::make('users.profile')->with('user', $user)->with('rol', $rol);
	}
	public function password($id)
	{
		if(!$this->autorizado) return Redirect::to('/login');
		
		$user = User::find($id);
		
		return View::make('users.password')->with('user', $user);
	}
	public function changePassword($id)
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$user = User::find($id);
		$user->password = Hash::make(Input::get('password'));
		$user->save();
		return Redirect::to('admin/usuarios')->with('notice', 'La Contraseña ha sido modificada correctamente.');
	}
	public function showRegister()
    {
    	return View::make('registration');
    }
    public function postRegister()
    {
		$user = new User();
		$user->full_name = Input::get('full_name');
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->user_address = Input::get('user_address');
		$user->estado = Input::get('estado');
		$user->municipio = Input::get('municipio');
		$user->user_mobile = Input::get('user_mobile');
		$user->password = Hash::make(Input::get('password'));
		$user->role_id = 2;
   		$validator = User::validate(array(
			'full_name' => Input::get('full_name'),
			'username' => Input::get('username'),
			'user_address' => Input::get('user_address'),
			'estado' => Input::get('estado'),
			'municipio' => Input::get('municipio'),
			'user_mobile' => Input::get('user_mobile'),	
			'email' => Input::get('email'),
			'password' => $user->password,
		), $user->id);
		if($validator->fails()){
			$errors = $validator->messages()->all();
			$user->password = null;
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$user->save();
			return Redirect::to('/registrarse')->with('notice', 'El usuario ha sido creado satisfactoriamente.');
		}
    }
    public function bannedUsers()
    {
    	if(!$this->autorizado) return Redirect::to('/login');
    	$users = User::onlyTrashed()->paginate(10);
		$roles 	= 	Role::all();
		foreach ($users as $user) {
			$rol 	= 	Role::find($user->role_id);	# code...
		}
		if(is_null($users))
		{
			return View::make('users.banned');
		}
		else
		{
			return View::make('users.banned')->with('users',$users)->with('roles',$roles);
		}	

    }
    public function restoreUser($id)
    {
    	if(!$this->autorizado) return Redirect::to('/login');
    	$user = User::withTrashed()->where('id', $id)->restore();
    	/*var_dump($user);*/
    	/*$user->restore();*/
    	return Redirect::back()->with('notice', 'El usuario ha sido restaurado correctamente.');
    }
    public function showOrders($id)
    {
    	$orders = Factura::where('user_id','=',$id)->orderBy('id','desc')->paginate(10);
    	//dd($orders);
    	$id = $id;
    	//return View::make('admin.ordersbyuser')->with(['orders'=>$orders, 'id'=>$id]);
    	return View::make('admin.ordersbyuser', compact('orders'))->with(['id'=>$id]);
    }
    public function cities($id)
    {
		$ciudades = DB::table('ciudades')->where('estado_id','=',$id)->orderBy('nombre','asc')->lists('nombre','id');
		
		return Response::json($ciudades);
    }

}
