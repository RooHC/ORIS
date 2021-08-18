<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\User;
use Illuminate\Http\Request;

class SuscripcionController extends Controller
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
     * Guarda los datos de un alumno que se ha suscrito a una asignatura.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store()
    {
        $data = request()->validate([
            'inputIDAsig' => 'required',
        ]);
        $data = request()->input('inputIDAsig');

        $asignatura = Asignatura::query()->where('subject_id', 'LIKE', "%{$data}%")->first();

        if ($asignatura) {
            auth()->user()->suscrito()->toggle($asignatura);
            return redirect()->back()->with('success', 'Te has suscrito a la asignatura.');
        } else {
            return redirect()->back()->with('fail', 'No se pudo completar la suscripción.');
        }
    }

    /**
     * Elimina la suscripcion de un alumno de una asignatura.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(User $suscriptor, Asignatura $asignatura)
    {
        $asignatura = Asignatura::findOrFail($asignatura->id);
        $asignatura->suscriptores()->detach($suscriptor->id);
        return redirect()->back();
    }
}
