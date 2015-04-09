@extends('layouts.home')

@section('title') Lista de Productos - ActiveWear @stop

@section('content')
<div class="row clearfix">
	<div class="col-md-4 column">
		<img src="/../assets/images/banner_productos.jpg" alt="galerias" class="banner_top">
	</div>
	<div class="col-md-2 column">

	</div>
	<div class="col-md-4 column">
		<div class="quote"><strong>Luce Moderna, mientras entrenas <br /> #CariocaActiveWear</strong></div>
	</div>
	<div class="col-md-2 visible-lg visible-md column">
		<img src="/../assets/images/logo-3.png" width='100%' align="right">
	</div>
</div>

<?php
$url = Request::segment(5);
//print_r($url);
$n = 1;
if ($url=='short')
{
	$n = 2;
}
if ($url=='nina')
{
	$n = 3;
}
if ($url=='capri')
{
	$n = 4;
}
if ($url=='largo')
{
	$n = 5;
}

?>
    @include('common.tabs')
    <div class="carioca_color{{ $n }} products-tabs-bg">
	    <div class="row products-body">
			@if (empty($products))
				<h4>Aun no hay Datos</h4>
			@else
				@foreach ($products as $product)
					<?php 
						if($product->brand == '0')
						{
							$brand = 'Pioggia';
						}
						else
						{	
							$brand = 'Carioca';
						}
					?>
					<?php $image = '/assets/images/stamps/'.Stamp::getName($product->stamp_id); ?>
					<div class="col-sm-6 product-item">
						{{-- var_dump($product->model_id) --}}
						<div class="item-left col-sm-6">
							<a href="/productos/ver/{{ $product->id }}" class="img-thumbnail">
								<img src="{{ Image::path($image, 'resizeCrop', 175, 150)->responsive('max-width=200','min-width=150', 'resize', 100) }}" alt="Estampado" />
							</a>
						</div>
						<div class="item-right col-sm-6">
							<a style="color: black; font-size:1.3em;" href="/productos/ver/{{ $product->id }}">
								{{ ucwords(strtolower(Stamp::getStampCode($product->stamp_id))) }}
							</a>
							<br />
							<strong>Marca:</strong> {{ ucwords(strtoupper($brand)) }}
							<br />
							{{ ucwords(strtoupper(Stamp::getStampDesc($product->stamp_id))) }}
							<br />
							{{ ucwords(strtoupper(Stamp::getStampName($product->stamp_id))) }}
							{{-- $product->stamp_id --}}
							@if (Auth::user()->role_id == 1)
								<div class="pull-right">
									<a href="/admin/productos/{{ $product->id }}/editar" class="btn btn-warning btn-xs white"  data-toggle="tooltip" data-placement="top" title="Editar Registro"><i class="fa fa-pencil fa-lg"></i></a>
								</div>
							@endif
						</div>
					</div>
				@endforeach
				{{ $products->links() }}
			@endif
	    </div>
	</div>
@stop
