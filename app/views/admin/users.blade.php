@extends('layouts.admin')

@section('content')

	<h2>Lista de Usuarios</h2>
	<div class="alert alert-info">
		A continuación encontrara una lista de los usuarios en el sistema sus rangos, fecha de registro, a traves de ella puede ver el perfil del usuario, editarlo, borrarlo y ver los pedidos de cada uno de los usuarios en caso de que tengan alguno.
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
			Usuarios
	        <span class="tools pull-right">
	            <a href="usuarios/agregar" class="btn btn-success pull-right white"><i class="fa fa-plus fa-lg"></i>  Agregar Usuario</a>	
	        </span>
	    </header>
	    <div class="panel-body">
	        <section id="no-more-tables">
	            <table class="table table-striped table-condensed cf">
	            	<thead class="cf">
						<tr>
							<th class="text-center">Username</th>
							<th class="text-center">Correo Electronico</th>
							<th class="text-center">Nombre Completo</th>
							<th class="text-center">Fecha de Registro</th>
							<th class="text-center">Rol</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead>
					<tbody class="text-center">
						@foreach ($users as $user)
							<tr>
								<td data-title="Username">{{ $user->username }}</td>
								<td data-title="Correo Electronico">{{ $user->email }}</td>
								<td data-title="Nombre Completo">{{ $user->full_name }}</td>
								<td data-title="Fecha de Registro">{{ $user->created_at }}</td>
								<td data-title="Rol">{{ Role::getName($user->role_id) }}</td>
								<td data-title="Acciones" class="text-center">
									<a href="/admin/usuarios/{{ $user->id }}/perfil" class="btn btn-info btn-xs white"  data-toggle="tooltip" data-placement="top" title="Ver Perfil"><i class="fa fa-user fa-lg"></i></a>
									<a href="/admin/usuarios/{{ $user->id }}/pedidos" class="btn btn-info btn-xs white"  data-toggle="tooltip" data-placement="top" title="Ver Pedidos"><i class="fa fa-list-alt fa-lg"></i></a>
									<a href="/admin/usuarios/{{ $user->id }}/editar" class="btn btn-warning btn-xs white"  data-toggle="tooltip" data-placement="top" title="Editar Registro"><i class="fa fa-pencil fa-lg"></i></a>
									<a href="{{ url('/admin/usuarios/borrar',$user->id) }}" class="btn btn-danger btn-xs btn-delete" data-id="{{ $user->id }}" data-toggle="tooltip" data-placement="top" title="Borrar Registro" onclick="return confirm('¿Esta seguro que desea borrar este Registro?');"><i class="fa fa-trash-o fa-lg"></i></a>
								</td>
							</tr>
		    			@endforeach							
					</tbody>
	            </table>
	            {{ $users->links() }}
	        </section>
	    </div>
	</section>
  {{ Form::open(array('url'=>array('admin.users.destroy', 'USER_ID'), 'method'=>'DELETE', 'role'=>'form', 'id'=>'form-delete')) }}
  {{ Form::close() }}
@stop