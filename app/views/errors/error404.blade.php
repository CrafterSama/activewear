@extends('layouts.home')

@section('content')
<div class="body-error">
    <div class="container ">
    <br />
    <section class="error-wrapper text-center">
      <div class="error-head"> </div>
      <h1><img src="assets/images/404.png" alt=""></h1>
      <div class="error-desk">
          <h2>Modulo no Encontrado</h2>
          <p class="nrml-txt">No podemos encontrar esta Pagina</p>
      </div>
      <a href="/" class="btn btn-success btn-lg"><i class="fa fa-home"></i> Regresar al Inicio</a>
    </section>
  </div>
</div>
@stop