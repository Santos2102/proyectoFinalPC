<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutorArticulo;
use App\Models\Articulo;
use App\Models\Autor;
use Illuminate\Support\Facades\Token;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

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
        try {
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);

            $autorArticulos = AutorArticulo::with('autor', 'articulo') // Assuming the relationships are named 'autor' and 'articulo'
                ->whereBetween('fecha', [$startDate, $endDate])
                ->get();

            if ($autorArticulos->isEmpty()) {
                return response()->json(['message' => 'No se encontraron resultados.'], 404);
            }

            return response()->json($autorArticulos);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        DB::beginTransaction();
        try{
            $request->validate([
                'autores' => 'required|array|min:1',
                'titulo' => 'required|string|max:50',
                'resumen' => 'required|string|max:100',
                'contenido' => 'required|string|max:200',
                'fecha' => 'required|date',
            ]);
            

            $articulo = new Articulo([
                'titulo' => $request->input('titulo'),
                'resumen' => $request->input('resumen'),
                'contenido' => $request->input('contenido'),
                'activo' => 1,
            ]);
            $articulo->save();

            $idArticulo = $articulo->idArticulo;

            $autoresSeleccionados = $request->input('autores');

            for($i = 0; $i < count($autoresSeleccionados); $i++){
                $informacion = ['idAutor'=>decrypt($autoresSeleccionados[$i]), 'idArticulo'=>$idArticulo, 'fecha' => $request -> fecha, 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()];
                DB::table('autorarticulo')->insert($informacion);
            }

            DB::commit();
            return redirect()->action([ArticuloController::class, 'index'])->with('success', __('Articulo registrado exitosamente'));

        }
        catch(\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
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
