<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB; //necesario para hacer un paginacion si usas Query Builder
use App\Categoria; //importando modelo categoria, cada controlador tiene sus modelos

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //para listar las categorias
    public function index(Request $request)
    {

       if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){

           // $categorias = Categoria::paginate(5); //para paginar
           $categorias = Categoria::orderBy('id' , 'desc')->paginate(5);


        }else{
            $categorias = Categoria::where($criterio, 'like', '%' .  $buscar . '%'  )->orderBy('id' , 'desc')->paginate(5);
        }

        

        return [
            'pagination' => [
                'total'  => $categorias->total(),
                'current_page' => $categorias->currentPage(),
                'per_page' => $categorias->perPage(),
                'last_page' =>  $categorias->lastPage(),
                'from' => $categorias->firstItem(),
                'to' => $categorias->lastItem()
            ],
            'categorias' => $categorias
        ];

       // return $categorias;
    }

    public function selectCategoria(Request $request){
        if(!$request->ajax()) return redirect('/');

        $categorias = Categoria::where('condicion', '=', '1')
        ->select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        return ['categorias' => $categorias];
    }

    //metodo insartar datos
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = '1';
        $categoria->save();

    }

    //metodo para actualizar
    public function update(Request $request)
    {
        
        if(!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->id);//buscamos categorias en la tabla, y actualizamos
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = '1';
        $categoria->save();
    }

   
    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->id);
        $categoria->condicion = '0';
        $categoria->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->id);
        $categoria->condicion = '1';
        $categoria->save();
    }


}
