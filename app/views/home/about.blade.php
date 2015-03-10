@extends('layouts.home')

@section('title') Acerca de - ActiveWear @stop

@section('content')
    <div class="about-header row">
        <div class="col-md-4">
            <img src="/../assets/images/banner_acerca.jpg" alt="acerca de" class="banner_top">
        </div>
        <div class="col-md-4 visible-lg"></div>
        <div class="col-md-4 visible-lg carioca-logo">
           <div class="quote"><strong>Si no luchas por lo que quieres <br /> no te lamentes por lo que tienes <br /> #CariocaActiveWear</strong></div>
        </div>
    </div>
    <div class="about-body row">
        <div class="col-md-3  visible-md visible-lg">
            <img src="/../assets/images/acerca_1.jpg" alt="acerca de" class="carioca-about-image-left">
        </div>
        <div class="col-md-6">
            <p class="text-justify">
                Carioca nace con la idea de llevar la moda o estilo femenino fitness de Brasil para Venezuela, compartir la alegria de los colores que predominan a la hora de ir a los gimnasios o academias (como se dice en Brasil).  Fue entonces como en 2012 sus socias iniciales comenzaron con el apoyo y confianza de una  reconocida marca de trajes de baños hechos en Venezuela.
            </p>
            <p class="text-justify">
                Alli comenzaron a introducir los pantalones deportivos con estampas coloridas y de calidad certificada Brasilera, la cual fue aceptada con buenas vibras y reconocimiento por parte de sus clientes.
            </p>
            <p class="text-justify">
                <strong>CARIOCA</strong>, que significa? El carioca es el nativo de Rio de Janeiro; quienes son parecido en caracteristica al Maracaibero; siendo que Maracaibo ciudad base de la empresa y donde se fabrica y se le da vida a esta ropa deportiva que alegra y acompaña el buen vestir para mantenerse en forma y llevar una vida sana.
            </p>
            <br />
            <br />
        </div>
        <div class="col-md-3 visible-md visible-lg">
            <img class="image-shadow" src="/../assets/images/acerca_2.jpg" width="75%" alt="acerca de" align="right" class="">
            <br />
            <img class="image-shadow" src="/../assets/images/acerca_3.jpg" width="75%" alt="acerca de" align="left" class="">
        </div>
    </div>
    <div class="about-footer col-md-12">
        <div class="last-box-index col-md-6 carioca_color2">
            <a href="http://www.pioggiadimare.com" rel="nofollow"><i class="fa fa-chain"></i>&nbsp;&nbsp;Pioggia SwimWear   <img src="/../assets/images/logo-pioggia.png" alt="acerca de" width="15%" align="" class=""></a>
        </div>
        <div class="col-md-6">
        </div>
    </div>
@stop
