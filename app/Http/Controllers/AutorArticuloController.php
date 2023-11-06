<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutorArticulo;
use App\Models\Articulo;
use App\Models\Autor;
use Illuminate\Support\Facades\Token;
use Illuminate\Support\Facades\DB;

class AutorArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('AutorArticulo.index');
    }

    public function filtro(Request $request)
    {
        try 
        {
            $startDate = $request->start_date;
            $endDate = $request->end_date;
    
            $autorArticulos = AutorArticulo::whereBetween('fecha', [$startDate, $endDate])->get();

            return view('AutorArticulo.index', compact('autorArticulos'));
        }
        catch(\Exception $e)
        {
            return back() -> with('error', 'Se produjo un error al procesar la solicitud');
        }
    }

    public function indexConsumible(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $autorArticulos = AutorArticulo::whereBetween('fecha', [$startDate, $endDate])->get();

        return response()->json($autorArticulos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try
        {
            $articulo = Articulo::all();
            $autor = Autor::All();
            return view('AutorArticulo.create', compact('articulo','autor'));
        }
        catch(\Exception $e)
        {
            return back() -> with('error', 'Se produjo un error al procesar la solicitud');
        }

    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $autorArticulo = new AutorArticulo([
                'idArticulo' => decrypt($request->idArticulo),
                'idAutor' => decrypt($request->idAutor),
                'fecha' => $request->fecha
            ]);
            $autorArticulo->save();
            return redirect()->route('indexAutorArticulo')->with('success', 'AutorArticulo creado éxitosamente.');
        }
        catch(\Illuminate\Validation\ValidationException $e) {
            //DB::rollBack();
            return back()->withErrors($e->validator->errors())->withInput();
        }

    }

    public function storeConsumible(Request $request)
    {
        $nuevoRegistro = new AutorArticulo([
            'idArticulo' => $request->idArticulo,
            'idAutor' => $request->idAutor,
            'fecha' => $request->fecha
        ]);
        $nuevoRegistro->save();
        return response()->json(['message' => 'Registro creado con éxito', 'data' => $nuevoRegistro], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
