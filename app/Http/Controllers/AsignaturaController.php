<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\Presentacion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AsignaturaController extends Controller
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

    public function create()
    {
        $this->authorize('create', asignatura::class);
        return view('asignatura.create');
    }

    public function store()
    {
        $data = request()->validate([
            'subject_name' => 'required',
            'subject_id' => 'required',
        ]);

        $asignatura = auth()->user()->asignaturas()->create([
            'subject_name' => $data['subject_name'],
            'subject_id' => $data['subject_id'],
        ]);

        if ($asignatura) {
            return redirect('/asignatura/' . $asignatura->id);
        } else {
            return redirect()->back()->with('fail', 'La asignatura no se pudo crear.');
        }
    }

    public function show(Asignatura $asignatura)
    {
        $this->authorize('view', $asignatura);
        $presentaciones = Presentacion::where('subject_id', $asignatura['id'])->orderBy('created_at', 'DESC')->paginate(6);
        return view('asignatura.show', compact('asignatura', 'subject_id', 'asignaturas'), ['presentaciones' => $presentaciones]);
    }
}
