<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CartController extends BaseController {

    use SoftDeletingTrait;

    public function get_cart()
    {
        return Cart::content();        
    }  

    public function post_add($id, $qty = 1)
    {   
        $product = Product::find($id);

        $rid = Cart::search(array('id' => $id));
        if(isset($rid[0])){
            $cart = Cart::get($rid[0]);
        }        

        if(!isset($cart) || (($cart->qty + $qty) <= $product->amounts)){            
            $precio = Modelo::getPrice($product->model_id);
            $name = Stamp::getStampName($product->stamp_id) . "(". Modelo::getName($product->model_id) .")";

            Cart::add($id, $name, $qty, $precio, array('image' => Stamp::getName($product->stamp_id)));
        }        
    } 

    public function get_removeitem($rowid)
    {
        if(Cart::get($rowid))
            Cart::remove($rowid);

        return Redirect::to('/carrito');
    }  

    public function post_minus($rowid)
    {
        if($cart = Cart::get($rowid)){
            $qty = $cart->qty-1;
            if($qty == 0){
                Cart::remove($rowid);
            } else{
                Cart::update($rowid, array("qty" => $qty));
            }
        }            

        return Redirect::to('/carrito');
    } 

    public function post_plus($rowid)
    {

        if($cart = Cart::get($rowid)){
            $product = Product::find($cart->id);                 

            if(($qty = $cart->qty+1) <= $product->amounts){            
                Cart::update($rowid, array("qty" => $qty));
            }             
        }

        return Redirect::to('/carrito');
    } 


    public function get_procesar()
    {
         /* crear factura */
        $factura = new Factura();
        $factura->user_id = Auth::user()->id;
        $factura->slug = Uuid::generate();
        if (is_null(Input::get('tax'))) {
        }else{
            $factura->with_tax = Input::get('tax');
        }
        $factura->save();

        foreach ($carts = Cart::content() as $key => $cart) {
            $product = Product::find($cart->id);                 

            if(( $product->amounts - $cart->qty ) >= 0 ){
                /* actualiza existencia */
                $product->amounts = $product->amounts - $cart->qty;
                $product->save();
                /* crea item del pedido */
                $item = new Item();
                $item->producto_id = $cart->id;
                $item->cantidad = $cart->qty;
                $item->precio = $cart->price;
                $item->factura_id = $factura->id;

                $item->keep = $cart->name ." | ". $cart->qty ." | ". $cart->price ." | ". $cart->options['image'];  
                $item->save();
            }
        }  
        Cart::destroy();  

        $user = Auth::user();
        $cdiscount = Configuration::getDiscount();
        $tax = Configuration::getIva();

        $datos = [];
        $datos['user'] = $user;
        $datos['factura'] = $factura;
        $datos['cart'] = $carts;
        $datos['discount'] = $cdiscount;

        //return View::make('emails.factura', array('datos' => $data));

        Mail::send('emails.factura', $datos , function($m) use ($user)
        {
            $m->from(Configuration::getSalesEmail(), 'Carioca ActiveWear');
//            $m->to($user['email'])->cc('ventasactivewear@gmail.com')->bcc('administracion@cariocaactivewear.com')->subject('Orden de Compra.');
            $m->to($user['email'])->subject('Orden de Compra.');
        }); 
        
        $message = Configuration::getOrderMessage();

        return Redirect::to('/order/' . $factura->id)->with('notice', $message);
    } 

    public function get_factura($slug){
        $factura = Factura::where('slug', '=', $slug)->firstOrFail();
        return View::make('factura', array('factura' => $factura));
    }

    public function post_pay(){
        $inputs = Input::all();

        $rules = array(
            'banco' => 'required',
            'recibo' => 'required',
            'monto'    => 'required',
            'fecha' => 'required',
            );

        $validation = Validator::make($inputs, $rules);

        if ($validation->fails())
        {
            return Redirect::to('/order/' . Input::get('id'))->withInput(Input::except('adjunto'))->withErrors($validation);
        }

        $pago = new Pago();
        $pago->banco = $inputs['banco'];
        $pago->recibo = $inputs['recibo'];
        $pago->monto = $inputs['monto'];
        $pago->fecha = $inputs['fecha'];

        if (Input::file('adjunto')){
            $adj = Input::file('adjunto');

            $destinationPath = 'assets/images/pays/';
            $filename = str_random(16)."_".$adj->getClientOriginalName();
            $adjunto = Input::file('adjunto')->move($destinationPath, $filename);
            $pago->adjunto = $adjunto;
        }

        $pago->factura_id = $inputs['id'];


        $pago->save();

        if(Input::get('options') == 'no')
        {
            $user = User::find(Auth::user()->id);
            $user->user_address = Input::get('user_address');
            $user->estado = Input::get('estado');
            $user->municipio = Input::get('municipio');
            $user->save();
        }

        $factura = Factura::find($inputs['id']);

        $data['user'] = Auth::user();

        $data['factura'] = $factura->toArray();
        $data['items'] = $factura->items->toArray();
        $data['pago'] = $factura->pago->toArray();
        $data['discount'] = Configuration::getDiscount();


        Mail::send('emails.pago', $data , function($m) use ($data)
        {
            $m->from(Configuration::getContactEmail(), 'ActiveWear');
            $m->to($data['user']['email'])->cc(Configuration::getAdminEmail())->subject('Confirmación de Pago.');
        });
        
        $message = Configuration::getBuyMessage();

        return Redirect::back()->with('notice', ''.$message.'');
    }

    public function get_orders(){

        $orders = Factura::where('user_id','=',Auth::user()->id)->orderBy('id','desc')->paginate(10);
        //dd($orders);
        $id = $id;
        //return View::make('admin.ordersbyuser')->with(['orders'=>$orders, 'id'=>$id]);
        return View::make('home.orders', compact('orders'))->with(['id'=>$id]);
        /*return View::make('home.orders', array('orders' => Auth::user()->facturas));*/
    }

    public function get_order($id){
        $order = Factura::withTrashed()->find($id);
        $states = Estado::orderBy('estado','asc')->get();
        $cities = Ciudad::orderBy('ciudad','asc')->get();
        $estados = array();
        $ciudades = array();
        foreach ($states as $state) {
            $estados[$state->id] = $state->estado;
        }
        foreach ($cities as $city) {
            $ciudades[$city->id] = $city->ciudad;
        }
        return View::make('home.order', array('order' => $order, 'states'=>$states,'estados'=>$estados,'cities'=>$cities,'ciudades'=>$ciudades));
    }
    public function deleteOrder($id)
    {
        $order = Factura::withTrashed()->find($id);

        $order->ForceDelete();

        return Redirect::back()->with('notice', 'El Pedido ha sido eliminado correctamente.');
    }

}