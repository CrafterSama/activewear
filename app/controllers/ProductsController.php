<?php

class ProductsController extends \BaseController {

	private $autorizado;
	
	public $errors;

	public $file;
	
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
		$products = Product::where('amounts','!=',0)->orderBy('id','desc')->paginate(10);
		$stamps = Stamp::all();
		$modelos = Modelo::all();
		return View::make('admin.products')->with(['products'=>$products,'stamps'=>$stamps,'modelos'=>$modelos]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$modelos = Modelo::all();
		$product = new Product();
		$stamp = new Stamp();
		return View::make('products.form')->with(['product' => $product,'modelos' => $modelos,'stamp' => $stamp]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$stamp 			= new Stamp();
		$stampname 		= Input::get('stampname');
		$stampcode 		= Input::get('stampcode');
		$stampdesc 		= Input::get('stampdesc');
		$file 			= Input::file('stamp');
		$filename 		= str_random(16).'_'.date('d_m_Y_H_i_s').'_'.$file->getClientOriginalName();
		$stamp->stampname = $stampname;
		$stamp->stampcode = $stampcode;
		$stamp->stampdesc = $stampdesc;
		$stamp->stamp 	= $filename;
		$rules 			= array(
			'stampcode'	=>'required',
			/*'stampname'	=>'required',
			'stampdesc'	=>'required',*/
			'stamp' 	=>'image|max:3072'
			);
		$inputs 		= array(
			'stampname'	=> Input::get('stampname'),
			'stampcode'	=> Input::get('stampcode'),
			'stampdesc'	=> Input::get('stampdesc'),
			'stamp' 	=> Input::file('stamp')
			);
		$validation 	= Validator::make($inputs, $rules);
		if( $validation->passes() )
		{
			//Upload the file
			$uploadPath = 'assets/images/stamps';
			$upload 	= $file->move($uploadPath,$filename);
			if ($upload) {
				$stamp->save();
			}
			//if it validate

			$stampId = Stamp::orderBy('created_at','DESC')->first();
			foreach (Input::get('model_id') as $modelId) {
				$product 			= new Product();
				$product->model_id 	= $modelId;
				$amounts 			= Input::get('amounts_'.$modelId.'');
				$brand 				= Input::get('brand');
				$product->amounts 	= $amounts;
				$product->stamp_id 	= $stampId->id;
				$product->brand     = $brand;
				$amount 			= 'amounts_'.$modelId;
				$rules 				= array(
					$amount 		=> 'required|numeric'
				);
				$inputs 			= array(
					$amount 		=> $amounts
				);
				$messages 			= array(
					'stamp.image|max:3072' => 'La Imagen que intenta agregar pesa mas de 3mb, reduzca su tamaño en megas.',
					'stampcode.required' => 'Debe llenar el Campo Codigo del Stampado',
					/*'stampname.required' => 'Debe llenar el Campo Nombre del Stampado',
					'stampdesc.required' => 'Debe llenar el Campo Descripcion del Stampado',*/
					'amounts_'.$modelId.'.required' => 'Dede llenar el campo Cantidades',
					'amounts_'.$modelId.'.numeric' => 'Las cantidades solo pueden ser numeros',
				);
				
				$validator 			= 	Validator::make($inputs,$rules);
				if($validator->fails())
				{
					$errors 		= $messages;
					return Redirect::back()->withErrors($validator)->withInput();
				}
				else
				{
					$product->save();
					
				}/* */
			}
			
			return Redirect::to('admin/productos')->with('notice', 'Los productos han sido agregados correctamente.');
			
		}
		else
		{
			return Redirect::to('admin/productos')->with('notice','No se logro guardar informacion en los estampados');
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
		$product = Product::find($id);
		$stamp = Stamp::find($product->stamp_id);
		if (is_null ($product))
		{
			App::abort(404);
		}
		return View::make('products.form')->with(['product' => $product, 'stamp' => $stamp]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$product = Product::find($id);
		$stamp = Stamp::find($product->stamp_id);
		
		$product->amounts = Input::get('amounts');
		$stamp->stampname = Input::get('stampname');
		
		if ($product->save() && $stamp->save())
		{
			return Redirect::to('admin/productos')->with('notice', 'El producto se edito correctamente.');
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
		$product = Product::find($id);
		if (is_null($product))
		{
			App::abort(404);
		}
		
		$product->delete();
		
		if (Request::ajax())
		{
			return Response::json(array(
				'success' => true,
				'msg'	 => 'Usuario '.$user->full_name.' eliminado',
				'id'	 => $user->id
			));
		}else
		{
			return Redirect::back()->with('notice', 'El producto ha sido eliminado correctamente.');	
		}
	}


}
