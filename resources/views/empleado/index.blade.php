
@extends('layouts.app')

@section('content')
<div class="container">


        @if(Session::has('mensaje'))
            <!-- Muestra mensaje de las formularios con estilo bootstrap-->
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"> &times; </span>
                </button>-->
            </div>
        @endif









        <!-- con esto linkeamos con la vista create-->
        <!-- con la class="btn btn-success" le damos estilo bootstrap-->
        <br>
    <a href="{{ url('empleado/create') }}" class="btn btn-success">Registrar nuevo empleado</a>
    <br>
    <br>
    <table class="table table-light">
        <!-- las columnas de los datos bd-->
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <!-- Despleagar la info de la BD-->
        <tbody>
            <!-- Consultar la informacion con blade un foreach-->
            <!-- Leeremos los datos de la variable $datos[empleado] de EmpleadoController-->
            @foreach( $empleados as $empleado )
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>
                    <!-- en src asset nos da acceso al deposito donde estan als fotos-->
                    <!-- luego que muestre el dato de la foto-->
                    <img class="img-thumbnail img-fluid" src=" {{ asset('storage').'/'.$empleado->foto }} " width="100" alt="">



                </td>



                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->apellidoPaterno }}</td>
                <td>{{ $empleado->apellidoMaterno }}</td>
                <td>{{ $empleado->correo }}</td>
                <td>
                    <!-- se enviar a empleado una id, y la entruccion es edit mostrara formulario y llegar los registros con los datos -->
                    <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning">
                    Editar
                    </a>

                    |

                    <!-- formulario crea un boton que va enviar la informacion a empleado junto con el id-->
                    <!-- Que envie a travez dce este formulario la id que desea borrar-->
                    <!-- class="d-inline" alineamos los botones -->
                    <form action="{{ url('/empleado/'.$empleado->id) }}" class="d-inline" method="post">
                        @csrf
                        <!-- metodo con delete para que al final acepte el borrado con el ip a travez del boton-->

                        {{ method_field('DELETE') }}
                        <!-- class="btn btn-danger" para darle estilo al boton -->
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Deseas borrar?')"  value="Borrar">

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $empleados->links() !!} <!-- paginacion de lista de empleado -->
</div>
@endsection
