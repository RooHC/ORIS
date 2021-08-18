<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presentacion;
use App\Pregunta;

class PreguntaController extends Controller
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

    /**
     * Devuelve la vista para crear una nueva pregunta.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Presentacion $presentacion)
    {
        $this->authorize('update', $presentacion);
        return view('pregunta.create', compact('presentacion'));
    }

    /**
     * Almacena la nueva pregunta.
     *
     * @return Pregunta
     */
    public function store()
    {
        $data = request()->validate([
            'question' => 'required',
            'option_A' => 'required',
            'option_B' => 'required',
            'option_C' => 'required',
            'solution' => 'required',
            'presentacion_id' => '',
        ]);

        $pregunta = new Pregunta;
        $pregunta->question = $data['question'];
        $pregunta->option_A = $data['option_A'];
        $pregunta->option_B = $data['option_B'];
        $pregunta->option_C = $data['option_C'];
        $pregunta->solution = $data['solution'];
        $pregunta->presentacion_id = $data['presentacion_id'];
        $pregunta->correct_answers = 0;

        if ($pregunta->save()) {
            if (request()->has('finalizar')) {
                return redirect('/' . auth()->user()->role->name . '/' . auth()->user()->id);
            }
            if (request()->has('nueva_pregunta')) {
                return redirect('/pregunta/create/' . $pregunta->presentacion_id);
            }
        } else {
            return redirect()->back()->with('fail', 'La pregunta no se pudo crear.');
        }
    }

    /**
     * Devuelve la vista para editar una pregunta
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Presentacion $presentacion)
    {
        $this->authorize('update', $presentacion);
        if (!$presentacion->completed) {
            return view('pregunta.edit', compact('presentacion'));
        } else {
            return view('presentacion.show-estadisticas', compact('presentacion'));
        }
    }

    /**
     * Actualizar datos de una pregunta.
     *
     * @return Pregunta
     */
    public function update(Pregunta $pregunta)
    {
        $this->authorize('update', $pregunta);
        $data = request()->validate([
            'question' => '',
            'option_A' => '',
            'option_B' => '',
            'option_C' => '',
            'solution' => '',
        ]);

        if ($pregunta->update($data)) {
            return redirect()->back()->with('success', 'Pregunta actualizada!');
        } else {
            return redirect()->back()->with('fail', 'La pregunta no se pudo actualizar.');
        }
    }

    /**
     * Eliminar una pregunta
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Pregunta $pregunta)
    {
        $this->authorize('delete', $pregunta);
        if (!$pregunta->presentacion->completed) {
            Pregunta::destroy($pregunta->id);
        }
        return redirect()->back();
    }
}
