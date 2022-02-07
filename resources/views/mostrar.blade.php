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
    </div>
    <div class="contenido">
        @foreach ($listaRestaurantes as $restaurante)
        <div class="div-2">
            <div class="div-2-img">
                <img src="{{asset('storage').'/'.$restaurante->foto}}">
            </div>
        </div>
        <div class="div-3">
            <div class="div-3-h1"><h1>{{$restaurante->nombre}}</h1></div>
            <div class="div-3-tiempo-tipo">
                <p class="tipo-grey">Americana &nbsp; Burger</p>
            </div>
            <div class="div-3-valoracion-envio">
                @if($restaurante->valoracion <5)
                        <div class="flex"><i class="fas fa-star fa-1x val-grey"></i><p class="val-grey">&nbsp;{{$restaurante->valoracion}}&nbsp;</p><p>{{$restaurante->tiempo_medio}} min</p></div>
                    @elseif($restaurante->valoracion <7.5 && $restaurante->valoracion >5)
                        <div class="flex"><i class="fas fa-star fa-1x val-blue"></i><p class="val-blue">&nbsp;{{$restaurante->valoracion}} Bueno &nbsp;</p><p>{{$restaurante->tiempo_medio}} min</p></div>
                    @else
                        <div class="flex"><i class="fas fa-star fa-1x val-green"></i><p class="val-green">&nbsp;{{$restaurante->valoracion}} Excelente &nbsp;</p><p>{{$restaurante->tiempo_medio}} min</p></div>
                    @endif
            </div>
        </div>
        @endforeach
    </div>
    
</div>

</body>
</html>