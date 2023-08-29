<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productos = Productos::all();

        return view('productos.index')->with('productos', $productos); // views/productos/index
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('productos.create'); //Carpeta/archivo views/productos/create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //recogiendo los datos del form
        /* $productos = new Productos();
        $productos->codigo          = $request->get('codigo');
        $productos->nombre          = $request->get('nombre');
        $productos->descripcion     = $request->get('descripcion');
        $productos->imagen          = $request->get('imagen');
        $productos->precio          = $request->get('precio');

        $productos->save();

        return redirect('/productos'); */

        /* Codigo para agregar imagen */
        $request->validate([
            'codigo' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,svg,jpg|max:1024',
            'precio' => 'required'
        ]);

        $producto = $request->all();

        if($imagen = $request->file('imagen')){
            $rutaGuardarProd = 'image/';
            $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarProd, $imagenProducto);
            $producto['imagen'] = "$imagenProducto";
        }

        Productos::create($producto);
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productos $producto)
    {
        //
        $request->validate([
            'codigo'=>'required', 'nombre'=>'required', 'descripcion'=>'required', 'precio'=>'required'
        ]);

        $prod = $request->all();

        if($imagen = $request->file('imagen')){
            $rutaGuardarImg  = 'image/';
            $imagenProducto  = date('YmfHis'). " . " . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $prod['imagen'] = "$imagenProducto";
        }else{
            unset($prod['imagen']);
        }

        $producto->update($prod);

        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $producto = Productos::find($id);

        $producto->delete();

        return redirect('/productos');
    }
}
