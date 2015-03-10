@extends('layouts.admin')    

@section('content')
	<h2>Perfil del Usuario {{ $user->full_name }}</h2>
	<div class="alert alert-info">
		A continuación encontrara una pequeña ficha con los datos del usuario del Cual esta consultando el perfil. 
	</div>
	<br>
	@if(Session::has('notice'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('notice') }}
		</div>
		<br>
	@endif
	<section class="panel">
	    <header class="panel-heading">
			<a href="{{ URL::previous() }}" class="btn btn-info"><i class="fa fa-chevron-left"></i>  Volver</a>
			&nbsp;
			&nbsp;
			<span class="dropdown">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				Acciones <span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
                    <li><a href="/admin/usuarios/{{ $user->id }}/editar"><i class="fa fa-pencil"></i> Editar</a></li>
                    <li><a href="/admin/usuarios/{{ $user->id }}/pedidos"><i class="fa fa-pencil"></i> Pedidos</a></li>
                    @if ($user->id != Auth::user()->id)
	                    <li><a href="/admin/usuarios/borrar/{{ $user->id }}"><i class="fa fa-trash-o"></i> Borrar</a></li>
                    @endif
				</ul>
			</span>
	        <span class="tools pull-right">
				<span class="visible-lg pull-right">{{ $user->full_name }}</span>
	        </span>

	    </header>
	    <div class="panel-body">
	        <section id="no-more-tables">
		    <table class="table table-bordered table-striped table-condensed cf">
				<tr>
					<td class="visible-lg"><strong>Username</strong></td><td data-title="Username"> {{ ($user->username) }} </td>
				</tr>
				<tr>
					<td class="visible-lg"><strong>Nombre Real</strong></td><td data-title="Nombre Real"> {{ $user->full_name }} </td>
				</tr>
				<tr>
					<td class="visible-lg"><strong>Email</strong></td><td data-title="Correo Electronico"> {{ $user->email }} </td>
				</tr>
				<tr>
					<td class="visible-lg"><strong> Direción</strong></td><td data-title="Dirección"> {{ $user->user_address }}, {{ ucwords(strtolower(Ciudad::getName($user->municipio))) }}, Edo. {{ ucwords(strtolower(Estado::getName($user->estado))) }} </td>
				</tr>
				<tr>
					<td class="visible-lg"><strong> Teléfono</strong></td><td data-title="Teléfono"> {{ $user->user_mobile }} </td>
				</tr>
				<tr>
					<td class="visible-lg"><strong> Nivel</strong></td><td data-title="Rol de Usuario"> {{ $rol->role_name }} </td>
				</tr>
		    </table>
	        </section>
	    </div>
	</section>
@stop