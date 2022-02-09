@if(!Session::get('email'))
    <?php
        //Si la session no esta definida te redirige al login.
        return redirect()->to('vistaclientes')->send();
    ?>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- bootstrap-->
    <script type="text/javascript" src="../js/iconos_g.js"></script> <!-- iconos FontAwesome-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- jquery-->
    <script src="js/js.js"></script>
    <link rel="stylesheet" href="../css/style_restaurante.css">
    @foreach ($listaRestaurantes as $restaurante)
        <title>Deliveroo - {{$restaurante->nombre}}</title>
    @endforeach
</head>
<body>
    <div class="div-1">
        <div class="div-1-logo">
            <a href="{{url('/vistaclientes')}}"><img src="../storage/deliveroo-logo.png"></a>
        </div>
        <div class="div-1-sesion">
                <form action='{{url('logout')}}' method='get'>
                    <button class='btn bt-logout' type='submit' ><i class='fas fa-user'></i>  Cerrar sesión</button>
                </form>
        </div>
    </div>
    <div class="contenido">
        @foreach ($listaRestaurantes as $restaurante)
        @php
        $tipo=DB::select(DB::raw("SELECT tbl_tipo_cocina.tipo FROM tbl_tipo_cocina INNER JOIN tbl_tipo_cocina_restaurante on tbl_tipo_cocina.id=tbl_tipo_cocina_restaurante.tipo_cocina_fk where tbl_tipo_cocina_restaurante.restaurante_fk=:tipo"),array('tipo' => $restaurante->id));
    @endphp
    @php 
        $tipo_str=""; 
    @endphp
    @foreach ($tipo as $tipo)
        @php
            $tipo_str=$tipo_str.$tipo->tipo."  ";
            @endphp
    @endforeach
    @php
        $servicio=DB::select(DB::raw("SELECT tbl_servicio.tipo from tbl_servicio INNER JOIN tbl_tipo_servicio_restaurante on tbl_servicio.id=tbl_tipo_servicio_restaurante.tipo_servicio_fk where tbl_tipo_servicio_restaurante.restaurante_fk=:servicio"),array('servicio' => $restaurante->id));
    @endphp
    @php $servicio_str=""; @endphp
    @foreach ($servicio as $servicio)
        @php
            $servicio_str=$servicio_str.$servicio->tipo." ";
        @endphp
    @endforeach
        <div class="div-2">
            <div class="div-2-img">
                <img src="{{asset('storage').'/'.$restaurante->foto}}">
            </div>
        </div>
        <div class="div-3">
            <div class="div-3-h1"><h1>{{$restaurante->nombre}}</h1></div>
            <div class="div-3-tiempo-tipo">
                <p class="tipo-grey">{{$tipo_str}}</p>
            </div>
            <div class="div-3-valoracion-envio">
                @if($restaurante->valoracion <5)
                        <div class="font-small"><i class="fas fa-star fa-1x val-grey"></i><p class="val-grey">&nbsp;{{$restaurante->valoracion}}&nbsp;</p><p>{{$restaurante->tiempo_medio}} min | </p><p>{{$servicio_str}}</p></div>
                    @elseif($restaurante->valoracion <7.5 && $restaurante->valoracion >5)
                        <div class="font-small"><i class="fas fa-star fa-1x val-blue"></i><p class="val-blue">&nbsp;{{$restaurante->valoracion}} Bueno &nbsp;</p><p>{{$restaurante->tiempo_medio}} min | </p><p>{{$servicio_str}}</p></div>
                    @else
                        <div class="font-small"><i class="fas fa-star fa-1x val-green"></i><p class="val-green">&nbsp;{{$restaurante->valoracion}} Excelente &nbsp;</p><p>{{$restaurante->tiempo_medio}} min | </p><p>{{$servicio_str}}</p></div>
                    @endif
            </div>
        </div>
        <div class="div-descripcion-galeria">
            <div class="div-descripcion">
                <h4>Info</h4>
                <p>{{$restaurante->descripcion}}</p>
            </div>
            <div class="div-galeria">
                <h4>Info</h4>
                <button type="button" class="btn btn-primary">Hacer pedido</button>
                <button type="button" class="btn btn-primary btn-color">Llamar a {{$restaurante->nombre}}</button>
            </div>
        </div>
        @endforeach
    </div>
    
</div>

</body>
</html>