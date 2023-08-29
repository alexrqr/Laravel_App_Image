<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Faker\Extension\CompanyExtension;
use Illuminate\Http\Request;

class LaptopController extends Controller
{

    //Obliga a iniciar sesión en el sitio web para acceder a los módulos
    public function __construct()
    {
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
        $laptops = Laptop::all();

        return view('laptop.index')->with('laptops', $laptops);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('laptop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        /* $laptops = new Laptop();
        $laptops->codigo = $request->get('codigo');
        $laptops->descripcion = $request->get('descripcion');
        $laptops->imagen = $request->get('imagen');
        $laptops->precio = $request->get('precio');

        $laptops->save();
        return redirect('/laptops'); */

        $request->validate([
            'codigo' => 'required', 'descripcion' => 'required', 'imagen' => 'required|image|mimes:jpeg,png,svg|max:1024', 'precio' => 'required'
        ]);

        $laptop = $request->all();

        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenLaptop = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenLaptop);
            $laptop['imagen'] = "$imagenLaptop";
        }

        Laptop::create($laptop);
        return redirect()->route('laptops.index');
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
    public function edit(Laptop $laptop)
    {
        //
        /* $laptop = Laptop::find($id);

        return view('laptop.edit') ->with('laptop', $laptop); */
        return view('laptop.edit', compact('laptop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laptop $laptop)
    {
        $request->validate([
            'codigo' => 'required', 'descripcion' => 'required'
        ]);
        $prod = $request->all();
        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenLaptop = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenLaptop);
            $prod['imagen'] = "$imagenLaptop";
        } else {
            unset($prod['imagen']);
        }
        $laptop->update($prod);
        return redirect()->route('laptops.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //eliminar registro mediante el id
        $laptop = Laptop::find($id);
        $laptop->delete();

        return redirect('/laptops');
    }
}
