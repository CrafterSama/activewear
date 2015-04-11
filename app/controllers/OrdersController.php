<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class OrdersController extends \BaseController {

    use SoftDeletingTrait;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Item::orderBy('id','=','desc')->paginate(10);

		if($product->brand == '0') {
			$brand = 'Pioggia';
		} else {
			$brand = 'Carioca';
		}

		$image = '/assets/images/stamps/'.Stamp::getName($product->stamp_id);
		
		return View::make('admin.orders')->with(['items'=>$items, 'brand'=>$brand, 'image'=>$image]);
	}
	public function approveOrder($id)
	{
		$approved = Item::where('factura_id','=',$id);

		$approved->delete();

        $factura = Factura::withTrashed()->find($id);

		$data = [];
        $data['user'] = User::find($factura->user_id);
        $data['factura'] = $factura->toArray();
        $data['items'] = $factura->items->toArray();
        $data['pago'] = $factura->pago->toArray();
        $data['discount'] = Configuration::getDiscount();

        //print_r($data);

        Mail::send('emails.orden', $data , function($m) use ($data)
        {
            $m->from('administracion@cariocaactivewear.com', 'ActiveWear');
            $m->to('ventasactivewear@gmail.com')->cc('jolivero.03@gmail.com')->subject('Confirmación de Pedido.');
        });

		return Redirect::back()->with('notice','El Pedido ha sido aprobado satisfactoriamente');
	}
	public function approved()
	{
		$items = Item::onlyTrashed()->where('shipped','=','no')->orderBy('created_at','desc')->paginate(10);

		if($product->brand == '0') {
			$brand = 'Pioggia';
		} else {
			$brand = 'Carioca';
		}

		$image = '/assets/images/stamps/'.Stamp::getName($product->stamp_id);
		
		return View::make('admin.approved')->with(['items'=>$items, 'brand'=>$brand, 'image'=>$image]);
	}
	public function shipped()
	{
		$items = Item::onlyTrashed()->where('shipped','=','yes')->orderBy('created_at','desc')->paginate(10);

		if($product->brand == '0') {
			$brand = 'Pioggia';
		} else {
			$brand = 'Carioca';
		}

		$image = '/assets/images/stamps/'.Stamp::getName($product->stamp_id);
		
		return View::make('admin.shipped')->with(['items'=>$items, 'brand'=>$brand, 'image'=>$image]);
	}
	public function shippedOrder($id)
	{
		DB::table('items')
            ->where('factura_id', $id)
            ->update(array('shipped' => 'yes'));

        $factura = Factura::withTrashed()->find($id);

        $datos = [];
        $user = User::find($factura->user_id);
        
        Mail::send('emails.gratitude', $datos , function($m) use ($user)
        {
            $m->from(Configuration::getSalesEmail(), 'Carioca ActiveWear');
            $m->to($user['email'])->subject('Gracias por Su Compra.');
        }); 

/*        Mail::send('emails.gratitude', $data , function($m) use ($data)
        {
            $m->from('administracion@cariocaactivewear.com', 'ActiveWear');
            $m->to('ventasactivewear@gmail.com')->cc('jolivero.03@gmail.com')->subject('Confirmación de Pedido.');
        });*/

        return Redirect::back()->with('notice','El Pedido ha sido entregado satisfactoriamente'); 
	}
	public function cancelOrder($id)
	{
		$item = Item::find($id);
		//print_r($item);
		$product = Product::find($item->producto_id);
		//print_r($product);/*
		$product->amounts = $item->cantidad + $product->amounts;
		if($product->save())
		{
			$item->forceDelete();
			return Redirect::back()->with('notice','Los Productos fueron devueltos a stock y el pedido cancelado');
		}
		else
		{
			return Redirect::back()->with('notice','El pedido no pudo ser cancelado');
		}

	}
	public function cancelAllOrder($id)
	{
        /*$order = Factura::withTrashed()->find($id);

        $order->ForceDelete();

        return Redirect::back()->with('notice', 'El Pedido ha sido eliminado correctamente.');*/
        
		$items = Item::where('factura_id','=',$id);
		//print_r($item);
		foreach ($items as $item) {
			# code...
			$product = Product::find($item->producto_id);
			//print_r($product);/*
			$product->amounts = $item->cantidad + $product->amounts;
			
			if($product->save()) {
				$item->forceDelete();
			} else {
				return Redirect::back()->with('notice','El pedido no pudo ser cancelado');
			}			
			// dd($item);
		}
		return Redirect::back()->with('notice','Los Productos fueron devueltos a stock y el pedido cancelado');

	}
}
