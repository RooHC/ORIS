<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\Presentacion;
use App\User;
use Illuminate\Http\Request;

class AlumnoController extends Controller
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
     * Show the student dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        if (request()->subject != null) {
            switch (request()->submitbutton) {
                case 'filtrar':
                    $data = request()->validate([
                        'subject' => 'required',
                    ]);

                    $asignatura = Asignatura::where('id', $data['subject'])->first();
                    if ($asignatura) {
                        $presentaciones = Presentacion::where('user_id', auth()->user()->id)->where('subject_id', $asignatura['id'])->orderBy('created_at', 'DESC')->paginate(6);
                        return view('alumno.index', compact('subject_id', 'asignaturas'), ['presentaciones' => $presentaciones]);
                    }
                    break;

                case 'limpiar':
                    $presentaciones = Presentacion::where('user_id', $user->id)->orderBy('created_at', 'DESC')->paginate(6);
                    return view('alumno.index', compact('user', 'subject_id', 'asignaturas'), ['presentaciones' => $presentaciones]);
                    break;
            }
        } else {
            $presentaciones = Presentacion::where('user_id', $user->id)->orderBy('created_at', 'DESC')->paginate(6);
            return view('alumno.index', compact('user', 'subject_id', 'asignaturas'), ['presentaciones' => $presentaciones]);
        }
    }
}
