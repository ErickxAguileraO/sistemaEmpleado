<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; //clase que contiene varios elementos para borrar

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recibe los datos de la BD de empleado los 5 primero registro los guardamos en una variable datos y se la pasamos a index
        $datos['empleados']=Empleado::paginate(1);

        //retorna la vista empleado.index
        return view('empleado.index',$datos );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //lista arreglo limitar los caracteres y valide correo ademas de los formatos imagenes
        $campos=[
            'nombre'=>'required|string|max:100',
            'apellidoPaterno'=>'required|string|max:100',
            'apellidoMaterno'=>'required|string|max:100',
            'correo'=>'required|email',
            'foto'=>'required|max:10000|mimes:jpeg,png,jpg,gif'
        ];
        //mensaje para mostrar al user del error
        $mensaje=[

            'required'=>'El :attribute es requerido',
            'foto.required'=>'La foto es requerida'

        ];
        //unimos los arreglos
        $this->validate($request, $campos, $mensaje);

        //recibe la informacion del formulario excepto el token
        $datosEmpleado = request()->except('_token');



        //busca si existe un archivo foto si lo hay alteramos en el nombre lo insertamos en la carpeta uploads y lo dejamos jpg
        if($request->hasFile('foto'))
        {

            $datosEmpleado['foto']=$request->file('foto')->store('uploads','public');

        }
        //inserta los datos a la bd en el modelo empleado
        Empleado::insert($datosEmpleado);

        //responde mostrar en un doc json toda la informacion que se le envio
       // return response()->json($datosEmpleado);

       //retornando hacia la redireccion empleado a index recibe un mensaje

       return redirect('empleado')->with('mensaje','Empleado fue agregado exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */

     //buscamos con la id, almacenamos en la variable y retornamos a la vista y pasamos la informacion
    public function edit($id)
    {

        //buscar un refistro que coincida con el id y guardarla en la variable
        $empleado = Empleado::findOrFail($id);

        //retornar la vista para darle la direccion correspondiente
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */

    //$request recepciona los datos por el metodo patch y el id nos sirve para recuperar la informaccion
    public function update(Request $request, $id)
    {
        //validamos que los campos no esten vacios
        $campos=[
            'nombre'=>'required|string|max:100',
            'apellidoPaterno'=>'required|string|max:100',
            'apellidoMaterno'=>'required|string|max:100',
            'correo'=>'required|email',

        ];
        //mensaje para mostrar al user del error
        $mensaje=[

            'required'=>'El :attribute es requerido',


        ];
        //si existe una foto se hace lo siguiente de lo contrario no hace nada
        if($request->hasFile('foto'))
        {

            $campos=['foto'=>'required|max:10000|mimes:jpeg,png,jpg,gif'];
            $mensaje=['foto.required'=>'La foto es requerida'];
        }

        //unimos los arreglos
        $this->validate($request, $campos, $mensaje);


        //recepcionando los datos menos el token y el metodo patch
        $datosEmpleado = request()->except(['_token','_method']);

        if($request->hasFile('foto'))
        {
            $empleado = Empleado::findOrFail($id); //recuperamos la info
            Storage::delete('public/'.$empleado->foto);//con esto estamos borrando la info de la foto
            $datosEmpleado['foto']=$request->file('foto')->store('uploads','public');

        }

        //modelo empleado preguntamos si coincide con el id y buscar el id y cuando lo encuentre actualice utilizando los datos de empleado
        Empleado::where('id','=',$id)->update($datosEmpleado);

        //buscar un registro que coincida con el id y guardarla en la variable
        $empleado = Empleado::findOrFail($id);

        //retornar la vista para darle la direccion correspondiente
        //return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('mensaje','Empleado Modificado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */

     //le pasamos el dato id desde index para el borrado
    public function destroy($id)
    {

         //buscar un registro que coincida con el id y guardarla en la variable
        $empleado = Empleado::findOrFail($id);
        //borrar fisicamente en storage
        if(Storage::delete('public/'.$empleado->foto ))
        {

            //pasamos la id para que borre
            Empleado::destroy($id);

        }


        // redireccionamos al despliegue de index
        return redirect('empleado')->with('mensaje','Empleado Borrado');
    }
}
