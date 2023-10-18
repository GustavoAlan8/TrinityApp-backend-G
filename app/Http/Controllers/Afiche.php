// Manejar la subida del afiche
    if ($request->hasFile('afiche')) {
        $afiche = $request->file('afiche');
        $nombreAfiche = 'afiche_' . time() . '.' . $afiche->getClientOriginalExtension();
        $afiche->move(public_path('afiches'), $nombreAfiche);
        // Guarda $nombreAfiche en la base de datos o donde sea necesario
    }

    // Manejar la subida del croquis
    if ($request->hasFile('croquis')) {
        $croquis = $request->file('croquis');
        $nombreCroquis = 'croquis_' . time() . '.' . $croquis->getClientOriginalExtension();
        $croquis->move(public_path('croquis'), $nombreCroquis);
        // Guarda $nombreCroquis en la base de datos o donde sea necesario
    }