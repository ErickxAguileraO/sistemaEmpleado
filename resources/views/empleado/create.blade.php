@extends('layouts.app')
<br>
@section('content')
<div class="container">

<br>

<!-- enctype es para enviar foto o archivos al formulario -->
<form action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">
    <!-- crea la llave de seguridad de laravel -->
    @csrf
    <!-- referenciamos a la carpea empleado con la view form.blade.php-->
    @include('empleado.form',['modo'=>'Crear'])

</form>

</div>
@endsection
