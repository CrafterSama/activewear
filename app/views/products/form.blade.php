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
							<div class="col-md-6" >
								<h4>Codigo, Nombre, Descripción e Imagen del Producto</h4>
								<hr />
								<div class="form-group">
									{{ Form::text('stampcode','',array('placeholder'=>'Codigo del Estampado','class'=>'form-control')) }}
								</div>
								<div class="form-group">
									{{ Form::text('stampname','',array('placeholder'=>'Nombre del Estampado','class'=>'form-control')) }}
								</div>
								<div class="form-group">
									{{ Form::text('stampdesc','',array('placeholder'=>'Descripcion','class'=>'form-control')) }}
								</div>
								<div class="form-group">
					                <select name="brand" id="brand" class="selectpicker" data-width="100%" required>
					                	<option value="2">Pioggia</option>
					                	<option value="1">Carioca</option>
					                </select>
					            </div>
								<div class="form-group">
					        		<input type='file' name="stamp" class="filestyle" data-buttonName="btn-primary" />
					        	</div>
					        	<div class="form-group">
							        <div class="thumbnail">
			        					<img id="target" src="#" alt="Estampado" class="img-responsive" />
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<h4>Modelos</h4>
								<hr />
								@foreach ($modelos as $modelo)
									<div class="row">
										<div class="col-xs-12">
											<span class="col-md-6 btn btn-default" data-toggle="buttons">
												{{ Form::label($modelo->model_name, strtoupper($modelo->model_name)) }}
												&nbsp;&nbsp;&nbsp;
												<input type="checkbox" name="model_id['{{ $modelo->id }}']" value="{{ $modelo->id }}" data-size="mini" />
											</span>
											<span class="col-md-6">
												<input type="number" min="1" name="amounts_{{ $modelo->id }}" placeholder="Cantidades" class="form-control col-md-6" />
											</span>
										</div>
									</div>
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
								<div class="form-group">
									<img src="/../assets/images/stamps/{{ Stamp::getName($stamp->id) }}" alt="" width="120px" class="img-thumbnail" />
					        	</div>
					        	<div class="form-group">
									<label for="stampname">Codigo del Stampado</label>
									<input type="text" value="{{ Stamp::getStampCode($stamp->id) }}" name="stampcode" class="form-control">				
					        	</div>
					        	<div class="form-group">
									<label for="stampname">Nombre del Stampado</label>
									<input type="text" value="{{ Stamp::getStampName($stamp->id) }}" name="stampname" class="form-control">
					        	</div>
					        	<div class="form-group">
									<label for="stampname">Observaciones del Producto</label>
									<input type="text" value="{{ Stamp::getStampDesc($stamp->id) }}" name="stampdesc" class="form-control">
					        	</div>
					        	<div class="form-group">
									<label for="amounts">Cantidades</label>
									<input type="number" min="1" value="{{ $product->amounts }}" name="amounts" class="form-control">
					        	</div>
								<div class="form-group">
					                <select name="brand" id="brand" class="selectpicker" data-width="100%">
					                @if($product->brand == '2')
					                	<option value="2" selected="selected">Pioggia</option>
					                	<option value="1">Carioca</option>
					                @else	
					                	<option value="2">Pioggia</option>
					                	<option value="1" selected="selected">Carioca</option>
					                @endif
					                </select>
					            </div>
							</div>
						</div>
						{{ Form::submit('Guardar', array('class'=>'btn btn-primary pull-right')) }}
					{{ Form::close() }}
				@endif
			</section>
		</div>
	</section>
@stop