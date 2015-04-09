@extends('layouts.home')

@section('title', Stamp::getStampName($product->stamp_id).' ('.ucwords(strtolower(Modelo::getName($product->model_id))).')')

@section('content')
<?php $image = '/assets/images/stamps/'.Stamp::getName($product->stamp_id); ?>
<div class="main">
    <div class="container">
        <div class="row">
            <br />
    @if(Session::has('notice'))
<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
{{ Session::get('notice') }}
</div>
@endif
    <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-info btn-md" onclick="history.go(-1)">
                        <i class="fa fa-chevron-left"></i> Volver
                    </button>
                    <h3 class="panel-title visible-lg pull-right">Perfil del Producto</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-5">
                        <figure class="img-thumbnail">
                            <a href="/assets/images/stamps/{{ Stamp::getName($product->stamp_id) }}">
                                <img src="{{ Image::path($image, 'resizeCrop', 435, 420)->responsive('max-width=435', 'resize', 435) }}" alt="" class="img-tumbnail img-responsive" />
                            </a>
                        </figure>
                    </div>
                    <div class="col-md-7">
                        <h2>{{ Stamp::getStampCode($product->stamp_id) }} ({{ ucwords(strtolower(Modelo::getName($product->model_id))) }})</h2>
                        <h3>{{ Stamp::getStampName($product->stamp_id) }}</h3>
                        <h3>{{ Stamp::getStampDesc($product->stamp_id) }}</h3>
                        {{-- $product->stamp_id --}}
                        <br />
                        <p><strong>Precio: </strong> Bs. {{  number_format(Modelo::getPrice($product->model_id), 2, ',', '.') }} </p>
                        <br />
                        <div class="col-sm-9">
                            {{ Form::selectRange('qty', 1, $product->amounts, array('id'=>'qty','class'=>'form-control col-sm-3')) }}
                            <br />
                            <br />
                            <button class="btn btn-success btn-lg add-to-cart" data-id="{{ $product->id }}">
                                <i class="fa fa-shopping-cart fa-lg"></i>&nbsp;&nbsp;Agregar a la Cesta
                            </button>
                            <button id="carrito" onclick="location.href='/carrito'" class="btn btn-success btn-lg hide">
                            	<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Ir al Carrito
                            </button>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
    <script>
        $(document).on('ready', function(){
            $(".add-to-cart").on("click", function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var qty = $("select[name=qty]").val() || 1;
                $.post('/cart/' + id + '/add/' + qty, function(data, textStatus, xhr) {
                    $.post('/total', function(data, textStatus, xhr) {
                        $(".cart-text").html(data);
                    });
                });
                $('#carrito').removeClass('hide');
                $(this).removeClass('btn-success');
                $(this).addClass('btn-info');
                $(this).html('<i class="fa fa-check fa-lg"></i> Agregado');
            })
        });
    </script>
@stop
