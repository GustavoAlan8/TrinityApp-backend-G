<?php

namespace App\Http\Controllers\Api;

use App\Models\Evento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Exception;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return $eventos;
    }

    public function create()
    {
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NOMBRE' => 'required|string|min:4|max:200|regex:/^[\pL\pN\s.,!?@:;\'-]+$/u',
            'MODALIDAD' => 'required|in:Presencial,Virtual,Mixto',
            'DIRECCION' => 'required|string|min:5|max:100|regex:/^[\pL\pN\s.,!?@:;\'-]+$/u',
            'TIPO DE EVENTO' => 'required|in:Reclutamiento,clasificatorios,talleres de programación competitiva,competencias,rondas de entrenamiento,Especial',
            'TIPO DE COMPETENCIA' => 'required|in:Individual,Equipo',
            'DESCRIPCION DEL EVENTO' => 'required|string|min:5|max:300|regex:/^[\pL\pN\s.,!?@:;\'-]+$/u',
            'BASES DEL EVENTO' => 'nullable',
            'IMAGEN CROQUIS' => 'nullable|mimes:jpg,png,ico',
            'IMAGEN AFICHE' => 'nullable|mimes:jpg,png,ico',
            'NOMBRE FECHA' => 'nullable|min:5|max:100|regex:/^[a-zA-Z0-9\s]+$/',
        ]);

        Evento::create($request->all());
        return redirect()->route('eventos.index')->with('success', 'Creado con exito.');
    }

    public function show(Evento $evento ) {
        return view('eventos.show', compact('evento'));
    }
 
    public function edit(Evento $evento) {
        return view('eventos.edit', compact('evento'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $rules = [
            'NOMBRE' => 'required|string|min:4|max:200|regex:/^[\pL\pN\s.,!?@:;\'-]+$/u',
            'MODALIDAD' => 'required|in:Presencial,Virtual,Mixto',
            'DIRECCION' => 'required|string|min:5|max:100|regex:/^[\pL\pN\s.,!?@:;\'-]+$/u',
            'TIPO DE EVENTO' => 'required|in:Reclutamiento,clasificatorios,talleres de programación competitiva,competencias,rondas de entrenamiento,Especial',
            'TIPO DE COMPETENCIA' => 'required|in:Individual,Equipo',
            'DESCRIPCION DEL EVENTO' => 'required|string|min:5|max:300|regex:/^[\pL\pN\s.,!?@:;\'-]+$/u',
            'BASES DEL EVENTO' => 'nullable',
            'IMAGEN CROQUIS' => 'nullable|mimes:jpg,png,ico',
            'IMAGEN AFICHE' => 'nullable|mimes:jpg,png,ico',
            'NOMBRE FECHA' => 'nullable|min:5|max:100|regex:/^[a-zA-Z0-9\s]+$/',
        ];

        // Mensajes de error personalizados en español
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'max' => 'El campo :attribute debe tener como máximo :max caracteres.',
            'regex' => 'El campo :attribute contiene caracteres no permitidos.',
            'mimes' => 'El campo :attribute contiene formato no permitido.',
            'in' => 'El campo :attribute es obligatorio.',
        ];

        $request->validate($rules, $messages);


        // Buscar el evento
        $evento = Evento::findOrFail($id);

        // Actualizar los datos del evento
        $evento->NOMBRE = $request->NOMBRE;
        $evento->MODALIDAD = $request->MODALIDAD;
        $evento->DIRECCION = $request->DIRECCION;
        $evento->TIPO_DE_EVENTO = $request->TIPO_DE_EVENTO;
        $evento->TIPO_DE_COMPETENCIA = $request->TIPO_DE_COMPETENCIA;
        $evento->DESCRIPCION_DEL_EVENTO = $request->DESCRIPCION_DEL_EVENTO;
        $evento->BASES_DEL_EVENTO = $request->BASES_DEL_EVENTO;
        $evento->IMAGEN_CROQUIS = $request->IMAGEN_CROQUIS;
        $evento->IMAGEN_AFICHE = $request->IMAGEN_AFICHE;
        $evento->NOMBRE_FECHA = $request->NOMBRE_FECHA;

        // Guardar el evento
        $evento->save();

        return response()->json([
            'message' => 'Evento editado con exito',
            'id' => $evento->id,
        ]);
    }


    public function destroy(Evento $evento) {
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Eliminacion exitosa..');
    }

}