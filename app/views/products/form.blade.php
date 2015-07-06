@extends ('layouts.admin')

<?php

    if ($product->exists):
        $form_data = array('url' => 'admin/productos/'.$product->id.'/editar','role'=>'form', 'files'=>true);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'admin/productos/agregar','role'=>'form', 'files'=>true);
        $action    = 'Agregar';        
    endif;

?>

@section ('title') {{ $action }} productos @stop

@section ('content')

	<h1>{{ $action }} Productos</h1>
	<div class="alert alert-info">
		Formulario para {{ strtolower($action) }} los productos en el sistema. 
	</div>
	<br>
	<section class="panel">
		<header class="panel-heading">
			<a href="{{ URL::previous() }}" class="btn btn-info"><i class="fa fa-angle-double-left"></i> Volver</a>	
			<span class="pull-right">
				{{ $action }} Productos 
			</span>
		</header>
		<div class="panel-body">
			<section id="{{ strtolower($action) }}_modelos">
				@if ($action == 'Agregar')
					{{ Form::model($product, $form_data) }}
						@include ('common/errors', array('errors' => $errors))
						<div class="row">
							<div class="form-group col-md-6" >
								<h4>Codigo, Nombre, Descripción e Imagen del Producto</h4>
								<hr />
								{{ Form::label('stampcode','Codigo del Estampado') }}
								{{ Form::text('stampcode','',array('placeholder'=>'Codigo del Estampado','class'=>'form-control')) }}
								{{ Form::label('stampname','Nombre del Estampado') }}
								{{ Form::text('stampname','',array('placeholder'=>'Nombre del Estampado','class'=>'form-control')) }}
								{{ Form::label('stampdesc','Descripcion del Estampado') }}
								{{ Form::text('stampdesc','',array('placeholder'=>'Descripcion','class'=>'form-control')) }}
								<br />
				                <label for="brand">Marca</label>
				                <select name="brand" id="brand" class="selectpicker">
				                	<option value="0">Pioggia</option>
				                	<option value="1">Carioca</option>
				                </select>
				                <br />
					        	<input type='file' id="imgInp" name="stamp" class="file" /><br />
						        <div class="thumbnail">
		        					<img id="target" src="#" alt="Estampado" class="img-responsive" />
								</div>
							</div>
							<div class="form-group col-md-6">
								<h4>Modelos</h4>
								<hr />
								@foreach ($modelos as $modelo)
									<div class="row">
										<div class="col-xs-12">
											<span class="btn btn-default" data-toggle="buttons">
												{{ Form::label($modelo->model_name, strtoupper($modelo->model_name)) }}
												<input type="checkbox" name="model_id['{{ $modelo->id }}']" value="{{ $modelo->id }}" data-size="mini" />
												{{-- Form::checkbox('model_id['.$modelo->id.']',$modelo->id) --}}
											</span>
											<br />
											<input type="number" min="1" name="amounts_{{ $modelo->id }}" placeholder="Cantidades" class="form-control" />
										</div>
									</div>
								<br />
								<br />
								@endforeach
							</div>
						</div>
						{{ Form::submit('Guardar', array('class'=>'btn btn-primary pull-right')) }}
					{{ Form::close() }}
				@else
					{{ Form::model($product, $form_data) }}
						@include ('common/errors', array('errors' => $errors))
						<div class="row">
							<div class="form-group col-md-6">
								{{ Form::label(Modelo::getName($product->model_id), strtoupper(Modelo::getName($product->model_id))) }}
								<br />
								<img src="/../assets/images/stamps/{{ Stamp::getName($stamp->id) }}" alt="" width="120px" class="img-thumbnail" />
								<br />
								<label for="stampname">Codigo del Stampado</label>
								<input type="text" value="{{ Stamp::getStampCode($stamp->id) }}" name="stampcode" class="form-control">				<label for="stampname">Nombre del Stampado</label>
								<input type="text" value="{{ Stamp::getStampName($stamp->id) }}" name="stampname" class="form-control">				<label for="stampname">Descripcion del Stampado</label>
								<input type="text" value="{{ Stamp::getStampDesc($stamp->id) }}" name="stampdesc" class="form-control">
								<br />
								<label for="amounts">Cantidades</label>
								<input type="number" min="1" value="{{ Product::getAmounts($product->id) }}" name="amounts" class="form-control">
							</div>
						</div>
						{{ Form::submit('Guardar', array('class'=>'btn btn-primary pull-right')) }}
					{{ Form::close() }}
				@endif
			</section>
		</div>
	</section>
@stop