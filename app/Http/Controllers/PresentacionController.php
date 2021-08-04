<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\Opinion;
use App\Pregunta;
use App\Presentacion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PresentacionController extends Controller
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
        return view('presentacion.create', compact('subject_id', 'asignaturas'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'subject' => 'required',
            'file' => 'required|mimes:pdf|max:10000',
        ]);

        $meetingId = Str::upper(Str::random(9));
        $isCompleted = 0;
        $participants = 0;
        $filePath = request('file')->store('uploads', 'public');
        $asignatura = Asignatura::query()->where('id', $data['subject'])->first();

        $presentacion = auth()->user()->presentaciones()->create([
            'title' => $data['title'],
            'subject_id' => $asignatura['id'],
            'meeting_id' => $meetingId,
            'completed' => $isCompleted,
            'file' => $filePath,
            'participants' => $participants,
        ]);

        if ($presentacion) {
            return redirect('/pregunta/create/' . $presentacion->id);
        } else {
            return redirect()->back()->with('fail', 'La presentación no se pudo crear.');
        }
    }

    public function show(Presentacion $presentacion)
    {
        $opiniones = Opinion::where('presentacion_id', $presentacion->id)->paginate(4);
        $asignatura = Asignatura::where('id', $presentacion->subject_id)->first();
        if ((Auth::user()->id != $presentacion->user_id) && (Auth::user()->id != $asignatura->user_id)) {
            return view('presentacion.show-cuestionario', compact('presentacion', 'asignatura'), ['opiniones' => $opiniones]);
        } else if ((Auth::user()->id == $presentacion->user_id) || (Auth::user()->id == $asignatura->user_id)) {
            return view('presentacion.show-estadisticas', compact('presentacion', 'asignatura'), ['opiniones' => $opiniones]);
        }
    }

    public function edit(Presentacion $presentacion)
    {
        $this->authorize('update', $presentacion);
        if (!$presentacion->completed) {
            return view('presentacion.edit', compact('presentacion'));
        } else {
            return view('presentacion.show-estadisticas', compact('presentacion'));
        }
    }

    public function update(Presentacion $presentacion)
    {
        $this->authorize('update', $presentacion);
        $data = request()->validate([
            'title' => '',
            'file' => 'mimes:pdf|max:10000',
        ]);

        if (request('file')) {
            $data['file'] = request('file')->store('uploads', 'public');
        }

        if ($presentacion->update($data)) {
            return redirect('/pregunta/' . $presentacion->id . '/edit');
        } else {
            return redirect()->back()->with('fail', 'La presentación no se pudo actualizar.');
        }
    }

    public function destroy(Presentacion $presentacion)
    {
        $this->authorize('delete', $presentacion);
        if (!$presentacion->completed) {
            Presentacion::destroy($presentacion->id);
        }
        return redirect()->back();
    }

    public function search()
    {
        $data = request()->validate([
            'inputIDSala' => 'required',
        ]);
        $data = request()->input('inputIDSala');
        $presentacion = Presentacion::query()->where('meeting_id', 'LIKE', "%{$data}%")->first();
        if ($presentacion) {
            $opiniones = Opinion::where('presentacion_id', $presentacion->id)->paginate(4);
            $asignatura = Asignatura::where('id', $presentacion->subject_id)->first();
            if ((Auth::user()->id != $presentacion->user_id) && (Auth::user()->id != $asignatura->user_id)) {
                return view('presentacion.show-cuestionario', compact('presentacion', 'asignatura'), ['opiniones' => $opiniones]);
            } else if ((Auth::user()->id == $presentacion->user_id) || (Auth::user()->id == $asignatura->user_id)) {
                return view('presentacion.show-estadisticas', compact('presentacion', 'asignatura'), ['opiniones' => $opiniones]);
            }
        } else {
            return redirect()->back()->with('fail', 'No se pudo encontrar la reunión.');
        }
    }

    public function detail(Pregunta $pregunta)
    {
        $this->authorize('viewDetail', $pregunta->presentacion);
        return view('presentacion.detail', compact('pregunta'));
    }
}
