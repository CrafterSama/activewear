@extends('layouts.home')

@section('title')Desfile Carioca 2014 @stop

@section('content')

    <div class="row clearfix">
        <div class="col-md-4 column">
            <img src="/../assets/images/banner_galeria.jpg" alt="galerias" class="banner_top">
        </div>
        <div class="col-md-4 column">

        </div>
        <div class="col-md-4 column">
           <div class="quote"><strong>Si estas cansada de empezar, deja de rendirte <br /> #CariocaActiveWear</strong></div>
        </div>
    </div>
    <div class="col-md-12">
        <h2 class="text-center">No hay Fotos en la Galerías</h2>
        <br />
        <div class="text-center">
          <button class="btn btn-success btn-lg" onclick="location.href='/productos/carioca'">Visita Nuestros Productos</button>
          <br />
          <br />
        </div>
    </div>


@stop
