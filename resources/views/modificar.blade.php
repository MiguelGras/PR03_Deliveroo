<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Actualizar Restaurante</title>
</head>
<body>
<form action="{{url('modificarRestaurante')}}" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <p>Nombre</p>
        <input type="text" name="nombre" value="{{$restaurante->nombre}}">
        <p>Valoracion</p>
        <input type="number" name="valoracion" value="{{$restaurante->valoracion}}">
        <p>Tipo de comida</p>
        <input type="text" name="tipo" value="{{$restaurante->tipo}}">
        <p>Foto</p>
        <input type="file" name="foto" value="{{$restaurante->foto}}">
        <div>
            <input type="hidden" name="id" value="{{$restaurante->id}}">
            <input type="hidden" name="id" value="{{$restaurante->id}}">
            <input type="submit" value="Enviar">
        </div>
    </form>
</body>
</html>