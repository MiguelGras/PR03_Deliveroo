<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- bootstrap-->
    <script type="text/javascript" src="js/iconos_g.js"></script> <!-- iconos FontAwesome-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- jquery-->
    <script src="js/js.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Deliveroo - Food Delivery</title>
</head>
<body>
    <div class="div-1">
        <div class="div-1-logo">
            <a href="#"><img src="storage/deliveroo-logo.png"></a>
        </div>
        <div class="div-1-input-busqueda">
            <i class="fa fa-search"></i>
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        </div>
        <div class="div-1-sesion">
            <button class="btn"><i class="fas fa-user"></i>  Iniciar sesión</button>
        </div>
    </div>
    <div class="contenido">
    <div class="div-2">
        <div class="div-2-radio">
            <form  method="post">
                <label>
                    <input type="radio" name="servicio" checked/>
                    <span> Recogida</span>
                </label>
                <label>
                    <input type="radio" name="servicio"/>
                    <span> Envio</span>
                </label>
            </form>
        </div>
        <div class="div-2-orden">
            <p>Buscar por:</p>
            <form  method="post">
                <label>
                    <input type="radio" name="orden" checked/>
                    <span> Valoracion</span>
                </label>
                <label>
                    <input type="radio" name="orden"/>
                    <span> Tiempo</span>
                </label>
            </form>
        </div>
        <div class="div-2-categoria">
            <p>Categoria:</p>
            <form method="post">
                @foreach($listaTipo as $tipo)
                <label class="container">{{$tipo->tipo}}
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                @endforeach
            </form>
        </div>
    </div>
    <div class="div-3">
        @foreach($listaRestaurantes as $restaurante)
            <div class="div-3-restaurante">
                <div class="div-3-restaurante-img">
                    <img src="{{asset('storage').'/'.$restaurante->foto}}">
                </div>
                <div class="div-3-restaurante-contenido">
                    <h5>{{ Str::limit($restaurante->nombre, 24,"") }}</h5>
                    @if($restaurante->valoracion <5)
                        <i class="fas fa-star val-grey"></i><p class="val-grey">&nbsp;{{$restaurante->valoracion}}&nbsp;</p>
                    @elseif($restaurante->valoracion <7.5 && $restaurante->valoracion >5)
                        <i class="fas fa-star val-blue"></i><p class="val-blue">&nbsp;{{$restaurante->valoracion}} Bueno &nbsp;</p>
                    @else
                        <i class="fas fa-star val-green"></i><p class="val-green">&nbsp;{{$restaurante->valoracion}} Excelente &nbsp;</p>
                    @endif
                    @php
                        $tipo=DB::select(DB::raw("SELECT tbl_tipo_cocina.tipo FROM tbl_tipo_cocina INNER JOIN tbl_tipo_cocina_restaurante on tbl_tipo_cocina.id=tbl_tipo_cocina_restaurante.tipo_cocina_fk where tbl_tipo_cocina_restaurante.restaurante_fk=:tipo"),array('tipo' => $restaurante->id));
                    @endphp
                    @php $tipo_str=""; @endphp
                    @foreach ($tipo as $tipo)
                        @php
                            $tipo_str=$tipo_str.$tipo->tipo." ";
                        @endphp
                    @endforeach
                    <p class="tipo-grey">{{ Str::limit($tipo_str, 17,"...") }}</p>
                    @php
                        $servicio=DB::select(DB::raw("SELECT tbl_servicio.tipo from tbl_servicio INNER JOIN tbl_tipo_servicio_restaurante on tbl_servicio.id=tbl_tipo_servicio_restaurante.tipo_servicio_fk where tbl_tipo_servicio_restaurante.restaurante_fk=:servicio"),array('servicio' => $restaurante->id));
                    @endphp
                    @php $servicio_str=""; @endphp
                    @foreach ($servicio as $servicio)
                        @php
                            $servicio_str=$servicio_str.$servicio->tipo." ";
                        @endphp
                    @endforeach
                    @foreach ($servicio as $servicio)
                    <p class="tipo-grey">{{$servicio_str}}</p>
                    @endforeach
                    <p class="tipo-grey">&nbsp; {{$restaurante->tiempo_medio}} min &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                </div>
            </div>
        @endforeach        
    </div>
</div>

</body>
</html>