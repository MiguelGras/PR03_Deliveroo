function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function filtro() {
    /* Obtener elemento html donde introduciremos la recarga (datos o mensajes) */
    var div = document.getElementById('div-3');
    /* 
    Obtener elemento/s que se pasarán como parámetros: token, method, inputs... 
    var token = document.getElementById('token').getAttribute("content");


    Usar el objeto FormData para guardar los parámetros que se enviarán:
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('clave', valor);
    */
    //var token = document.getElementById('token').getAttribute("content");
    var method = document.getElementById('postSearch').value;
    var filtro = document.getElementById('Search').value;

    var formData = new FormData();
    //formData.append('_token', token);
    formData.append('_method', method);
    formData.append('titulo', filtro);

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    /*
    ajax.open("method", "rutaURL", true);
    GET  -> No envía parámetros
    POST -> Sí envía parámetros
    true -> asynchronous
    */
    ajax.open("GET", "vistaclientes", true);
    ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                /* Crear la estructura html que se devolverá dentro de una variable recarga*/
                var recarga = '';
                for (let i = 0; i < respuesta.length; i++) {
                    recarga += '@foreach($listaRestaurantes as $restaurante)'
                    recarga += '<div class="div-3-restaurante">'
                    recarga += '<div class="div-3-restaurante-img">'
                    recarga += '<img src="{{asset(' + storage + ').' / '.' + respuesta[i].foto + '}}">'
                    recarga += '</div>'
                    recarga += '<div class="div-3-restaurante-contenido">'
                    recarga += '<h5>{{ Str::limit(' + respuesta[i].nombre + ', 24,"") }}</h5>'
                    recarga += '@if(' + respuesta[i].valoracion + ' <5)'
                    recarga += '<i class="fas fa-star val-grey"></i><p class="val-grey">&nbsp;' + respuesta[i].valoracion + '&nbsp;</p>'
                    recarga += '@elseif(' + respuesta[i].valoracion + ' <7.5 && ' + respuesta[i].valoracion + ' >5)'
                    recarga += '<i class="fas fa-star val-blue"></i><p class="val-blue">&nbsp;' + respuesta[i].valoracion + ' Bueno &nbsp;</p>'
                    recarga += '@else'
                    recarga += '<i class="fas fa-star val-green"></i><p class="val-green">&nbsp;' + respuesta[i].valoracion + ' Excelente &nbsp;</p>'
                    recarga += '@endif'
                    recarga += '@php'
                    recarga += '$tipo=DB::select(DB::raw("SELECT tbl_tipo_cocina.tipo FROM tbl_tipo_cocina INNER JOIN tbl_tipo_cocina_restaurante on tbl_tipo_cocina.id=tbl_tipo_cocina_restaurante.tipo_cocina_fk where tbl_tipo_cocina_restaurante.restaurante_fk=:tipo"),array(' + tipo + ' => $restaurante->id));'
                    recarga += '@endphp'
                    recarga += '@php $tipo_str=""; @endphp'
                    recarga += '@foreach ($tipo as $tipo)'
                    recarga += '@php'
                    recarga += '$tipo_str=$tipo_str.$tipo->tipo." ";'
                    recarga += '@endphp'
                    recarga += '@endforeach'
                    recarga += '<p class="tipo-grey">{{ Str::limit($tipo_str, 17,"...") }}</p>'
                    recarga += '@php'
                    recarga += '$servicio=DB::select(DB::raw("SELECT tbl_servicio.tipo from tbl_servicio INNER JOIN tbl_tipo_servicio_restaurante on tbl_servicio.id=tbl_tipo_servicio_restaurante.tipo_servicio_fk where tbl_tipo_servicio_restaurante.restaurante_fk=:servicio"),array(' + servicio + ' => $restaurante->id));'
                    recarga += '@endphp'
                    recarga += '@php $servicio_str=""; @endphp'
                    recarga += '@foreach ($servicio as $servicio)'
                    recarga += '@php'
                    recarga += '$servicio_str=$servicio_str.$servicio->tipo." ";'
                    recarga += '@endphp'
                    recarga += '@endforeach'
                    recarga += '@foreach ($servicio as $servicio)'
                    recarga += '<p class="tipo-grey">{{$servicio_str}}</p>'
                    recarga += '@endforeach'
                    recarga += '<p class="tipo-grey">&nbsp; {{$restaurante->tiempo_medio}} min &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>'
                    recarga += '</div>'
                    recarga += '</div>'
                    recarga += '@endforeach'
                }
                div.innerHTML = recarga;
                /* creación de estructura: la estructura que creamos no ha de contener código php ni código blade*/
                /* utilizamos innerHTML para introduciremos la recarga en el elemento html pertinente */
            }
        }
        /*
        send(string)->Sends the request to the server (used for POST)
        */
    ajax.send(formData)
}