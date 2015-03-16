@extends('layouts.home')

@section('title') Carioca ActiveWear @stop

@section('content')
<div class="img-index col-md-12">
    <div class="carioca-index-image">
        <div class="col-md-5">
            <h3 class="font-cursiva-index"><p>¡La Ropa Deportiva<br />que esta de moda!</p></h3>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5">
            <h3 class="font-cursiva-index"><p class="second-text">Luce Moderna,<br />Mientras entrenas!<br />#Carioca</p></h3>
        </div>
        <div class="white-space-index"></div>
        <div style="col-md-12">
            <div style="background-color: rgba(0, 0, 0, 0.5)" align="center"><img src="/../assets/images/logo_carioca.png" width='70%'></div>
        </div>
     </div>
</div>
<div class="buttons col-md-8 col-xs-12">
    <div class="img-1 col-xs-6 col-md-6">
        <img class="products col-md-12" src="/../assets/images/home_productos.png" alt="productos" width="100%">
        <div class="title-box carioca_color1">
            <h3 class="fig-text"><a href="/productos/carioca" alt="Productos Carioca"><strong>Productos Carioca + </strong></a></h3>
        </div>
    </div>
    <div class="img-2 col-xs-6 col-md-6">
        <img class="carrito col-md-12" src="/../assets/images/home_carrito.png" alt="carrito" width="100%">
        <div class="title-box carioca_color4">
            <h3 class="fig-text"><a href="/carrito" alt="Carrito de Compras"><strong>Carrito + </strong></a></h3>
        </div>
    </div>
</div>
<div class="col-md-4 social-buttons">
    <div class="col-md-12">
        <div class="social">
            <div class="row">
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
        </div>
        <div class="boxes">
            <div class="row">
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
        </div>
        <div class="text-box carioca_color2">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="fig-text"><strong>Siguenos +</strong></h3>
                </div> 
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
