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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Crear Restaurante</title>
</head>
<body>
    @if($errors->any())
    <div>
        <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
    @endif
    <form action="{{url('crear')}}" method="post" enctype="multipart/form-data">
        @csrf
        <p>Nombre</p>
        <input type="text" name="nombre" placeholder="Introduce el nombre..." value="{{old('nombre')}}">
        @error('nombre')
            <br>
            {{$message}}
        @enderror
        <p>Valoracion</p>
        <input type="number" name="valoracion" placeholder="Introduce la valoracion...">
        @error('valoracion')
            <br>
            {{$message}}
        @enderror
        <p>Tipo</p>
        <input type="text" name="tipo" placeholder="Introduce el tipo de comida...">
        @error('tipo')
            <br>
            {{$message}}
        @enderror
        <p>Foto</p>
        <input type="file" name="foto">
        @error('foto')
            <br>
            {{$message}}
        @enderror
        <div>
            <input type="submit" value="Enviar">
        </div>
    </form>
</body>
</html>