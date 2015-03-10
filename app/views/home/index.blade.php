@extends('layouts.home')

@section('title') Carioca ActiveWear @stop

@section('content')
<div class="img-index col-md-12">
    <div class="carioca-index-image">
         <div class="row clearfix">
            <div class="col-md-5">
                <h3 class="font-cursiva-index"><p>¡La Ropa Deportiva<br />que esta de moda!</p></h3>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <h3 class="font-cursiva-index"><p class="second-text">Luce Moderna,<br />Mientras entrenas!<br />#Carioca</p></h3>
            </div>
         </div>
         <div class="white-space-index"></div>
         <div style="col-md-12">
             <div style="background-color: rgba(0, 0, 0, 0.5)" align="center"><img src="/../assets/images/logo_carioca.png" width='70%'></div>
         </div>
     </div>
</div>
<div class="buttons col-md-8">
    <div class="col-md-6 img-1">
        <div class="row-fluid">
            <img class="products col-md-12" src="/../assets/images/home_productos.png" alt="productos">
            <div class="title-box carioca_color1">
                <h3 class="fig-text"><a href="/productos/carioca" alt="Productos Carioca"><strong>Productos Carioca + </strong></a></h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 img-2">
        <div class="row-fluid">
            <a href="/carrito"><img class="carrito col-md-12" src="/../assets/images/home_carrito.png" alt="carrito"></a>
            <div class="title-box carioca_color4">
                <h3 class="fig-text"><a href="/carrito" alt="Carrito de Compras"><strong>Carrito + </strong></a></h3>
            </div>
        </div>
    </div>
</div>
hola
<div class="col-md-4">
    <div class="col-md-12 social-buttons">
        <div class="row social">
            <div class="col-xs-4 carioca_color1">
                <div class="social-box "><a class="btn btn-block btn-social btn-instagram" href="http://www.instagram.com/carioca_activewear"><i class="fa fa-instagram fa-lg fa-3x"></i></a></div>
            </div>
            <div class="col-xs-4 carioca_color4">
                <div class="social-box"><a class="btn btn-block btn-social btn-facebook" href="https://www.facebook.com/pages/Carioca-Activewear/332150280300248"><i class="fa fa-facebook fa-lg fa-3x"></i></a></div>
            </div>
            <div class="col-xs-4 carioca_color3">
                <div class="social-box"><a class="btn btn-block btn-social btn-twitter" href="http://www.twitter.com/cariocaactive"><i class="fa fa-twitter fa-lg fa-3x"></i></a></div>
            </div>
        </div>
        <div class="row boxes">
            <div class="col-xs-4 carioca_color1">
                <div class="box"></div>
            </div>
            <div class="col-xs-4 carioca_color4">
                <div class="box"></div>
            </div>
            <div class="col-xs-4 carioca_color3">
                <div class="box"></div>
            </div>
        </div>
        <div class="row carioca_color2">
            <div class="col-md-12">
                <h3 class="fig-text"><strong>Siguenos +</strong></h3>
            </div>
        </div>
    </div>
</div>
<div class="last-box-index col-md-12">
    <div class="col-md-6 carioca_color2">
        <a href="/productos/pioggia" rel="nofollow">&nbsp;&nbsp; Productos Pioggia &nbsp;&nbsp; <img src="/../assets/images/logo-pioggia.png" alt="acerca de" width="13%" align="" class=""></a>
    </div>
    <div class="col-md-6"></div>
</div>

@stop
