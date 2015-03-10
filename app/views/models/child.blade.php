@extends('layouts.home')

@section('title') Lista de Productos - ActiveWear @stop

@section('content')
<div class="main">
<div class="container">
	<div class="row">
		<br />
		<section class="panel">
		    <header class="panel-heading">
				@include('common.tabs')
	    	</header>
		    <div class="panel-body">
		        <section id="no-more-tables">
		            <table class="table table-rounded table-striped table-condensed cf">
		            	<thead class="cf">
							<tr>
								<th class="col-md-6">Estampados</th>
								<th class="col-md-2 text-center">en Stock</th>
							</tr>
						</thead>
						<tbody>
							@if (empty($products))
								<h4>Aun no hay Datos</h4>
							@else

								@foreach ($products as $product)
								{{-- var_dump($product->model_id) --}}
									<tr>
										<td class="col-md-6" data-title="Estampados">
											<span>
												<a href="/productos/ver/{{ $product->id }}" class="img-thumbnail">
													<img src="/assets/images/stamps/{{ Stamp::getName($product->stamp_id) }}" alt="Estampado" width="120px" />
												</a>
											</span>
											<span>
												<a href="/productos/ver/{{ $product->id }}">{{ Stamp::getStampName($product->stamp_id) }} ({{ ucwords(strtolower(Modelo::getName($product->model_id))) }})</a>
											</span>
										</td>
										<td class="col-md-2 text-center" data-title="en Stock">
											<span class="label label-primary pro-count">{{ $product->amounts }}</span>
										</td>
									</tr>
								@endforeach
							@endif
						</tbody>
		            </table>
		            {{ $products->links() }}
		        </section>
		    </div>
		</section>
	</div>
</div>
</div>

@stop