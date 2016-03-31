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
		if(!$this->autorizado) return Redirect::to('/login');
		$products = Product::where('amounts','!=',0)->orderBy('id','desc')->paginate(10);
		$stamps = Stamp::all();
		$modelos = Modelo::all();
		return View::make('admin.products')->with(['products'=>$products,'stamps'=>$stamps,'modelos'=>$modelos]);
	}

	public function searchByModel($id)
	{
		$products = Product::where('model_id','=',$id)->where('amounts','!=','0')->orderBy('id','desc')->paginate(10);
		$stamps = Stamp::all();
		$modelos = Modelo::all();
		return View::make('admin.products')->with(['products'=>$products,'stamps'=>$stamps,'modelos'=>$modelos]);
	}

	public function search()
	{
	    $name = Input::get('search');
	    $model = Input::get('model');
	    $brand = Input::get('brand');
		$stamps = Stamp::all();
		$models = Modelo::all();
		$stampId = Stamp::where('stampcode','like','%'.$name.'%')->lists('id');
		if(empty($model) && empty($brand) && empty($name)):
			$products = Product::where('amounts','!=','0')->orderBy('id','desc')->get();
		elseif(empty($model) && empty($brand)) :
			$products = Product::whereIn('stamp_id',$stampId)->where('amounts','!=','0')->orderBy('id','desc')->get();
		elseif(empty($model)) :
			$products = Product::whereIn('stamp_id',$stampId)->where('brand','=',$brand)->where('amounts','!=','0')->orderBy('id','desc')->get();
		elseif(empty($name)) :
			$products = Product::where('model_id','=',$model)->where('brand','=',$brand)->where('amounts','!=','0')->orderBy('id','desc')->get();
		else:
			$products = Product::whereIn('stamp_id',$stampId)->where('brand','=',$brand)->where('model_id','=',$model)->where('amounts','!=','0')->orderBy('id','desc')->get();
		endif;
		
		return View::make('admin.search')->with(['products'=>$products,'stamps'=>$stamps,'models'=>$models,'stampId'=>$stampId])->with('notice', 'Se encontraron '.$products->count().' productos en tu busqueda');
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
			'stamp' 	=>'required|image|max:3072'
			);
		$inputs 		= array(
			'stampname'	=> Input::get('stampname'),
			'stampcode'	=> Input::get('stampcode'),
			'stampdesc'	=> Input::get('stampdesc'),
			'stamp' 	=> Input::file('stamp')
			);
		$messages 			= array(
			'stamp.image' => 'El Formato del Archivo debe ser de tipos Imagen (.jpg, .png, .gif, .bmp)',
			'stamp.max:3072' => 'La Imagen que esta tratando de subir pesa mas de 3MB, reduzca su tamaño en megas.',
			'stamp.required' => 'Debe subir una imagen del producto.',
			'stampcode.required' => 'Debe llenar el Campo Codigo del Stampado',
			/*'stampname.required' => 'Debe llenar el Campo Nombre del Stampado',
			'stampdesc.required' => 'Debe llenar el Campo Descripcion del Stampado',*/
		);
		$validate 	= Validator::make($inputs, $rules);
		if($validate->fails())	{
			$errors = $messages;
			return Redirect::back()->withErrors($validate)->withInput();
		} else {
			if( $validate->passes() ) {
				
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
					$amount 			=> 'required|numeric'
					);
					$inputs 			= array(
					$amount 			=> $amounts
					);
					$messages 			= array(
						'amounts_'.$modelId.'.required' => 'Dede llenar el campo Cantidades',
						'amounts_'.$modelId.'.numeric' => 'Las cantidades solo pueden ser numeros',
					);
					
					$validator = Validator::make($inputs,$rules);
					if($validator->fails())	{
						$errors = $messages;
						return Redirect::back()->withErrors($validator)->withInput();
					} else {
						$product->save();
						
					}/* */
				}
		
				
				return Redirect::to('admin/productos')->with('notice', 'Los productos han sido agregados correctamente.');
				
			} else {
				
				return Redirect::to('admin/productos')->with('notice','No se logro guardar informacion en los estampados');
			
			}
		}/* */
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
		$stamp->stampcode = Input::get('stampcode');
		$stamp->stampdesc = Input::get('stampdesc');
		
		if ($product->save() && $stamp->save())
		{
			return Redirect::to('admin/productos')->with('notice', 'El producto fue editado de manera satisfactoria.');
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
    public function chartData()
    {
        $devlist = DB::table('items')
            ->select(DB::raw('MONTHNAME(updated_at) as month'), DB::raw("DATE_FORMAT(updated_at,'%Y-%m') as monthNum"), DB::raw('count(*) as items'))
            ->groupBy('monthNum')
            ->get();

        return $devlist;
    }


}
