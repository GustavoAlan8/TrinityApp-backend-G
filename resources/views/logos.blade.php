@foreach ($patrocinadores as $patrocinador)
    <!--enviar la lista de patrocinadores con su url de donde esta el logo o solo la url-->
    <!--Cuando se envia con el nombre se debe especificar-->
    <!--el asset sirve cuando los logos estan almacenados en el storage -->
    <img src="{{asset($patrocinador->url)}}" alt="" width="150" height="150">
    <!-- Solo las url -->
    <img src="{{asset($patrocinador)}}" alt=""  width="150" height="150">
@endforeach
