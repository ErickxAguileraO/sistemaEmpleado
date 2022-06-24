

<h1>{{ $modo }} empleado</h1>

<!-- mostrar los errores al usuario-->
@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach( $errors->all() as $error )
               <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>


@endif

<!-- form-group: conjunto de info para darle estilo al formulario con bootstrap-->
<div class="form-group">
    <!-- aca estan todos los datos para los form de create y edit-->
    <!-- llenamos los campos con los datos de la bd por cada linea-->
    <label for="nombre"> Nombre </label>
    <input type="text" class="form-control" name="nombre"
    value="{{ isset($empleado->nombre)?$empleado->nombre:old('nombre') }}" id="nombre">

</div>

<div class="form-group">
    <label for="apellidoPaterno"> Apellido Paterno </label>
    <!-- en el value: si existe ese valor imprimelo y de lo contrario pone espacio vacio-->
    <input type="text" class="form-control" name="apellidoPaterno"
    value="{{ isset($empleado->apellidoPaterno)?$empleado->apellidoPaterno:old('apellidoPaterno') }}" id="apellidoPaterno">

</div>

<div class="form-group">
    <label for="apellidoMaterno"> Apellido Materno </label>
    <input type="text" class="form-control" name="apellidoMaterno"
    value="{{ isset($empleado->apellidoMaterno)?$empleado->apellidoMaterno:old('apellidoMaterno') }}" id="apellidoMaterno">

</div>

<div class="form-group">
    <label for="correo"> Correo </label>
    <input type="text" class="form-control" name="correo"
    value="{{ isset($empleado->correo)?$empleado->correo:old('correo') }}" id="correo">

</div>


<div class="form-group">
    <label for="foto"></label>

    @if(isset($empleado->foto))

    <!-- mostramos la foto correspondiente y le damos estilo -->
    <img class="img-thumbnail img-fluid" src=" {{ asset('storage').'/'.$empleado->foto }} " width="100" alt="">
    @endif
    <input type="file" class="form-control" name="foto" value="" id="foto">

</div>


<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href="{{ url('empleado/') }}">Volver</a>


