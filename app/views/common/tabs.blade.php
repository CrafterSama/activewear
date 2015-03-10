<ul class="nav nav-tabs">
    <?php 
    $url = Request::path(); 
    $segment = Request::segment(2); 
    //print_r($url);
    ?>
    @if( $segment == 'pioggia' )

        <li class=""><a class="carioca_color1" href="/productos/pioggia">TIPOS DE ESTAMPADOS</a></li>
        <?php $n = 1; ?>
        @foreach ($models as $model)
            <?php $n++;  ?>
            
            <li class=""><a class="carioca_color{{ $n }}" href="/productos/pioggia/modelos/{{ $model->id }}/{{ Helper::woutSpace(strtolower(Modelo::getName($model->id))) }}">{{ strtoupper(ucwords(Modelo::getName($model->id))) }}</a></li>
            {{-- expr --}}
        @endforeach
        <li class="dropdown">
            <a class="other-products" href="#" data-toggle="dropdown">OTROS MODELOS <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
            @foreach ($modelos as $modelo)
                 <li @if ($url == 'productos/pioggia/modelos/{{ $modelo->id }}/{{ Helper::woutSpace(strtolower(Modelo::getName($modelo->id))) }}') class="active" @else  @endif><a href="/productos/pioggia/modelos/{{ $modelo->id }}/{{ Helper::woutSpace(strtolower(Modelo::getName($modelo->id))) }}">{{ strtoupper(ucwords(Modelo::getName($modelo->id))) }}</a></li>
            @endforeach
            </ul>
        </li>
    @endif
    @if( $segment == 'carioca' )
        <li class=""><a class="carioca_color1" href="/productos/carioca">TIPOS DE ESTAMPADOS</a></li>
        <?php $n = 1; ?>
        @foreach ($models as $model)
            <?php $n++;  ?>
            
            <li class=""><a class="carioca_color{{ $n }}" href="/productos/carioca/modelos/{{ $model->id }}/{{ Helper::woutSpace(strtolower(Modelo::getName($model->id))) }}">{{ strtoupper(ucwords(Modelo::getName($model->id))) }}</a></li>
            {{-- expr --}}
        @endforeach
        <li class="dropdown">
            <a class="other-products" href="#" data-toggle="dropdown">OTROS MODELOS <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
            @foreach ($modelos as $modelo)
                 <li @if ($url == 'productos/carioca/modelos/{{ $modelo->id }}/{{ Helper::woutSpace(strtolower(Modelo::getName($modelo->id))) }}') class="active" @else  @endif><a href="/productos/carioca/modelos/{{ $modelo->id }}/{{ Helper::woutSpace(strtolower(Modelo::getName($modelo->id))) }}">{{ strtoupper(ucwords(Modelo::getName($modelo->id))) }}</a></li>
            @endforeach
            </ul>
        </li>
    @endif
</ul>
