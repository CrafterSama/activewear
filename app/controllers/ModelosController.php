<?php

class ModelosController extends \BaseController {

	
	private $autorizado;
	
	public $errors;
	
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

		$modelos = Modelo::paginate(10);

		if(is_null($modelos))
		{
			return View::make('admin.modelos');
		}
		else
		{
			return View::make('admin.modelos')->with('modelos',$modelos);
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
		$modelo = new Modelo();
		return View::make('models.form')->with('modelo', $modelo);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$modelo = new Modelo();
		$modelo->model_name = Input::get('model_name');
		$modelo->price_out_tax_float = Input::get('price_out_tax_float');
		$validator = Modelo::validate(array(
			'model_name' => Input::get('model_name'),
			'price_out_tax_float' => Input::get('price_out_tax_float'),
		));
		if($validator->fails()){
			$errors = $validator->messages()->all();
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$modelo->save();
			return Redirect::to('admin/modelos')->with('notice', 'El Modelo ha sido creado correctamente.');
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
		//
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
		$modelo = Modelo::find($id);
		if (is_null ($modelo))
		{
			App::abort(404);
		}
		return View::make('models.form')->with('modelo', $modelo);
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
		$modelo = Modelo::find($id);
		$modelo->model_name = Input::get('model_name');
		$modelo->price_out_tax_float = Input::get('price_out_tax_float');
		$validator = Modelo::validate(array(
			'model_name' => Input::get('model_name'),
			'price_out_tax_float' => Input::get('price_out_tax_float'), 
		), $modelo->id);
		if($validator->fails()){
			$errors = $validator->messages()->all();
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$modelo->save();
			return Redirect::to('admin/modelos')->with('notice', 'El modelo ha sido modificado correctamente.');
		}
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
		$modelo = Modelo::find($id);
		if (is_null($modelo))
		{
			App::abort(404);
		}
		$products = DB::table('products')
						->where('model_id','=',$id)
						->get();
		if($products)
		{
			foreach ($products as $product) {
				$p = Product::find($product->id);
				$p->forceDelete();
			}
		}
		$modelo->forceDelete();


		
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
			return Redirect::back()->with('notice', 'El producto ha sido eliminado correctamente.');	
		}
	}


}
