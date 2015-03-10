@extends('layouts.home')

@section('title')Galerias @stop

@section('content')

    <div class="row clearfix">
        <div class="col-md-4 column">
            <img src="/../assets/images/banner_galeria.jpg" alt="galerias" class="banner_top">
        </div>
        <div class="col-md-4 column">

        </div>
        <div class="col-md-4 column">
           <div class="quote">Si estas cansada de empezar, deja de rendirte <br /> #CariocaActiveWear</div>
        </div>
    </div>
    <br />
    <div class="col-md-12">
        <div class="col-empty visible-md visible-lg">.</div>
       <div class="col-md-3 col-sm-5">
            <div class="row">
                <img src="/../assets/images/galeria_1.jpg" width='100%' alt="Inicio" >
                <div class="carioca_color1 fig-text"><h3><a href="/galerias/desfiles"><p align="right">Desfiles <br />Carioca 2014 + </p></a></h3></div>
            </div>
        </div>
        <div class="col-empty">.</div>
        <div class="col-sm-2 visible-sm"></div>
        <div class="col-md-3 col-sm-5">
            <div class="row">
                <img src="/../assets/images/galeria_2.jpg" width='100%' alt="Inicio" >
                <div class="carioca_color4 fig-text"><h3><a href="/galerias/sesiones"><p align="right">Sesiones de <br />Fotos + </p></a></h3></div>
            </div>
        </div>
        <div class="col-empty visible-md visible-lg">.</div>
        <div class="col-md-3">
            <div class="row">
                  <img src="/../assets/images/galeria_3.jpg" width='100%' alt="Inicio" >
                <div class="carioca_color2 fig-text"><h3><p align="right"><a href="/galerias/eventos">Eventos <br />Especiales + </p></h3></div>
            </div>
        </div>
    </div>
    <br />
@stop
