<?php

namespace App\Http\Controllers;

use App\Opinion;
use App\Respuesta;
use Illuminate\Http\Request;

class RespuestaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store()
    {
        $data = request()->input();
        $tam = (count($data) - 8) / 2;
        for ($i = 1; $i <= $tam; $i++) {
            $respuesta = new Respuesta();
            $respuesta->user_id = auth()->user()->id;
            $respuesta->pregunta_id = $data['pregunta_' . $i];
            $respuesta->answer = $data['respuesta_' . $i];
            if ($respuesta->answer == $respuesta->pregunta->solution) {
                $dataPregunta['correct_answers'] = $respuesta->pregunta->correct_answers + 1;
                $respuesta->pregunta->update($dataPregunta);
            }
            if (!$respuesta->save()) {
                return redirect()->back()->with('fail', 'La respuesta no se pudo guardar.');
            }
        }

        $opinion = new Opinion();
        $opinion->user_id = auth()->user()->id;
        $opinion->presentacion_id = $data['presentacion_id'];
        $opinion->contenido = $data['contenido'];
        $opinion->organizacion = $data['organizacion'];
        $opinion->exposicion = $data['exposicion'];
        $opinion->tiempo = $data['tiempo'];
        $opinion->valoracion = $data['valoracion'];
        $opinion->consejo = $data['consejo'];
        if (!$opinion->save()) {
            return redirect()->back()->with('fail', 'Tu opinión no se pudo guardar.');
        }

        $dataPresentacion['completed'] = $opinion->presentacion->completed = 1;
        $dataPresentacion['participants'] = $opinion->presentacion->participants + 1;
        $respuesta->pregunta->presentacion->update($dataPresentacion);

        return redirect('/presentacion/' . $data['presentacion_id'] . '#evaluacion');
    }
}