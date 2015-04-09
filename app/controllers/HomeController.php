<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showIndex');
	|
	*/
		/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('home.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	public function showIndex()
	{
		/*$posts = Post::all();
		
		if(is_null($posts))
		{*/
	
		/*}
		else
		{
			return View::make('home.index')->with(array('posts',$posts));
		}*/
		
	}

	public function showProducts()
	{
		$models = Modelo::paginate(4);
		$modelos = Modelo::whereNotBetween('id', array(1, 4))->get();
		$products = Product::whereRaw('amounts != 0 and brand = 0')
		  	->orderBy('id','desc')
			->paginate(6);
		return View::make('home.products')->with(['products'=>$products, 'models'=>$models, 'modelos'=>$modelos]);
	}

	public function showProductsCarioca()
	{
		$models = Modelo::paginate(4);
		$modelos = Modelo::whereNotBetween('id', array(1, 4))->get();
		$products = Product::whereRaw('amounts != 0 and brand = 1')
		  ->orderBy('id','desc')
					->paginate(6);
		return View::make('home.products')->with(['products'=>$products, 'models'=>$models, 'modelos'=>$modelos]);
	}

	public function showProductsPioggia()
	{
		$models = Modelo::paginate(4);
		$modelos = Modelo::whereNotBetween('id', array(1, 4))->get();
		$products = Product::whereRaw('amounts != 0 and brand = 0')
		  	->orderBy('id','desc')
			->paginate(6);
		return View::make('home.products')->with(['products'=>$products, 'models'=>$models, 'modelos'=>$modelos]);
	}

	public function showModels($id)
	{
		$models = Modelo::paginate(4);
		$modelos = Modelo::whereNotBetween('id', array(1, 4))->get();
		$products = Product::where('model_id','=',$id)->where('amounts','!=','0')
		  ->orderBy('id','desc')
					->paginate(6);
		return View::make('home.products')->with(['products'=>$products, 'models'=>$models, 'modelos'=>$modelos]);
	}
	
	public function showModelsPioggia($id)
	{
		$models = Modelo::paginate(4);
		$modelos = Modelo::whereNotBetween('id', array(1, 4))->get();
		$products = Product::where('model_id','=',$id)->where('amounts','!=','0')->where('brand','=','0')
		  ->orderBy('id','desc')
					->paginate(6);
		return View::make('home.products')->with(['products'=>$products, 'models'=>$models, 'modelos'=>$modelos]);
	}
	
	public function showModelsCarioca($id)
	{
		$models = Modelo::paginate(4);
		$modelos = Modelo::whereNotBetween('id', array(1, 4))->get();
		$products = Product::where('model_id','=',$id)->where('amounts','!=','0')->where('brand','=','1')
		  ->orderBy('id','desc')
					->paginate(6);
		return View::make('home.products')->with(['products'=>$products, 'models'=>$models, 'modelos'=>$modelos]);
	}
		
	public function showProductProfile($id,$title=null)
	{
		$product = Product::find($id);
		return View::make('home.prodprofile')->with('product',$product);
	}
	public function showOrders($id)
	{
		/*if(is_null($orders))
		{*/
			return View::make('home.orders')->with('orders',$orders);
		/*}
		else
		{
			return View::make('home.orders')->with(array('orders',$orders));
		}*/
	}

	public function showAbout()
	{
		return View::make('home.about');
	}

	public function showContact()
	{
		return View::make('home.contact');
	}

	public function postContact()
	{
		$data = Input::all();

        $rules = array(
            'name' 		=> 'required',
            'email' 	=> 'required',
            'message' 	=> 'required',
            );

        $validation = Validator::make($inputs, $rules);

        if ($validation->fails())
        {
            return Redirect::back()->with('error', $validation);
        }
		
		Mail::send('emails.contacto', $data , function($m) use ($data)
        {
            $m->from(Configuration::getContactEmail(), 'Carioca Active Wear');
            $m->to('jolivero.03@gmail.com')->cc($data['email'])->subject('Formulario de Contacto');
        });

		return Redirect::back()->with('status', 'Su correo fue enviado de forma satisfactoria.');
	}
	
	public function showGaleries()
	{
		return View::make('home.galerias');
	}
	
	public function showGalerie1()
	{
		return View::make('home.desfiles');
	}
	
	public function showGalerie2()
	{
		return View::make('home.sesiones');
	}

	public function showGalerie3()
	{
		return View::make('home.eventos');
	}	
	public function showBrasil2014()
	{
		return View::make('home.brasil-2014');
	}	
	public function showDunas2014()
	{
		return View::make('home.maracaibo-2014');
	}

}
