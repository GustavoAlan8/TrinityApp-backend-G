<?php

namespace App\Http\Controllers;

use App\Models\Fotografia;
use Illuminate\Http\Request;

class FotografiaController extends Controller
{

    public function index()
{
    // Obtener todas las fotografías.
    $fotografias = Fotografia::all();

    // Mostrar las fotografías.
    return view('fotografias.index', ['fotografias' => $fotografias]);
}

        public function create()
{
    // Mostrar el formulario para crear una nueva fotografía.
    return view('fotografias.create');
}

    public function store(Request $request)
{
    // Validar los datos de la petición.

    // Crear una nueva fotografía.
    $fotografia = new Fotografia;
    $fotografia->nombre = $request->input('nombre');
    $fotografia->descripcion = $request->input('descripcion');
    $fotografia->save();

    // Redireccionar a la página de la fotografía creada.
    return redirect()->route('fotografias.show', $fotografia);
}

public function show(Fotografia $fotografia)
{
    // Mostrar la fotografía.
    return view('fotografias.show', ['fotografia' => $fotografia]);
}

public function update(Request $request, Fotografia $fotografia)
{
    // Validar los datos de la petición.

    // Actualizar la fotografía.
    $fotografia->nombre = $request->input('nombre');
    $fotografia->descripcion = $request->input('descripcion');
    $fotografia->save();

    // Redireccionar a la página de la fotografía actualizada.
    return redirect()->route('fotografias.show', $fotografia);
}

public function edit(Fotografia $fotografia)
{
    // Mostrar el formulario para editar la fotografía.
    return view('fotografias.edit', ['fotografia' => $fotografia]);
}

public function destroy(Fotografia $fotografia)
{
    // Eliminar la fotografía.
    $fotografia->delete();

    // Redireccionar a la página de la lista de fotografías.
    return redirect()->route('fotografias.index');
}
}
