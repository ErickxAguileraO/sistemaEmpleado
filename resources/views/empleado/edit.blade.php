@extends('layouts.app')

@section('content')
<div class="container">

    <br>

    <!-- cformulario enviamos informacion-->
    <form action="{{ url('/empleado/'.$empleado->id) }}" method="post" enctype="multipart/form-data">

        @csrf
        <!-- usando el patch y enviando al controlador update-->
        {{ method_field('PATCH') }}

        <!-- referenciamos a la carpea empleado con la view form.blade.php-->
        @include('empleado.form',['modo'=>'Editar'])

    </form>

</div>
@endsection

