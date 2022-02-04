<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- bootstrap-->
    <script type="text/javascript" src="js/iconos_g.js"></script> <!-- iconos FontAwesome-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- jquery-->
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
                    <h3>{{$restaurante->nombre}}</h3>
                    <p>Valoracion:{{$restaurante->valoracion}}/10</p>
                </div>
            </div>
        @endforeach        
    </div>
</div>

</body>
</html>