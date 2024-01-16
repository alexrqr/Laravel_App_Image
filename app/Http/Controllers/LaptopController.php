<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Faker\Extension\CompanyExtension;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function search(Request $request)
    {
        /* $codprod  = $request->input('code');
        $descpro  = $request->input('descrip');

        $fromDate = Carbon::createFromFormat('Y-m-d\TH:i:s', $request->input('fechaCreacion'))->format('Y-m-d H:i:s');
        $toDate = Carbon::createFromFormat('Y-m-d\TH:i:s', $request->input('fechaActualiza'))->format('Y-m-d H:i:s');

        $query = \DB::table('laptops')
            ->where('created_at', '>=', $fromDate)
            ->where('updated_at', '<=', $toDate)
            ->where('codigo', 'LIKE', '%' . $codprod . '%')
            ->where('descripcion', 'LIKE', '%' . $descpro . '%')
            ->get();

        return view('laptop.index', compact('query')); */

    /* $codprod = $request->input('code');
    $descpro = $request->input('descrip');

    // Obtener las fechas proporcionadas en el formulario
    $fromDate = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('fechaCreacion'))->format('Y-m-d H:i:s');
    $toDate = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('fechaActualiza'))->format('Y-m-d H:i:s');

    // Utilizar Eloquent para realizar la consulta en lugar de la consulta de constructor de consultas query
    $laptops = Laptop::where(function ($query) use ($codprod, $descpro) {
            $query->where('codigo', 'LIKE', '%' . $codprod . '%')
                ->orWhere('descripcion', 'LIKE', '%' . $descpro . '%');
        })
        ->where(function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate])
                ->orWhereBetween('updated_at', [$fromDate, $toDate]);
        })
        ->get();

    // Puedes usar compact('query') para pasar los resultados a la vista
    return view('laptop.index', compact('laptops')); */ //query

        $codprod = $request->input('code');

        // Utilizar Eloquent para realizar la consulta en lugar de la consulta de constructor de consultas query
        $laptops = Laptop::where('codigo', 'LIKE', '%' . $codprod . '%')->get();

        // Puedes usar compact('laptops') para pasar los resultados a la vista
        return view('laptop.index', compact('laptops', 'codprod'));
    }

    public function limpiarFormulario(Request $request){

        return response()->json(['success'=>true]);

    }

}
