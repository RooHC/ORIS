<?php

namespace App\Http\Controllers;

use App\Opinion;
use App\Presentacion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Carbon\Carbon;

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
        return view('presentacion.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'subject' => 'required',
            'file' => 'required|mimes:pdf|max:10000',
        ]);

        $meetingId = Str::upper(Str::random(6));
        $isCompleted = 0;
        $participants = 0;
        $filePath = request('file')->store('uploads', 'public');

        $presentacion = auth()->user()->presentaciones()->create([
            'title' => $data['title'],
            'subject' => $data['subject'],
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
        return view('presentacion.show', compact('presentacion'), ['opiniones' => $opiniones]);
    }

    public function edit(Presentacion $presentacion)
    {
        $this->authorize('update', $presentacion);
        if (!$presentacion->completed) {
            return view('presentacion.edit', compact('presentacion'));
        } else {
            return view('presentacion.show', compact('presentacion'));
        }
    }

    public function update(Presentacion $presentacion)
    {
        $this->authorize('update', $presentacion);
        $data = request()->validate([
            'title' => '',
            'subject' => '',
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
            return view('presentacion.show', compact('presentacion'), ['opiniones' => $opiniones]);
        } else {
            return redirect()->back()->with('fail', 'No se pudo encontrar la reunión.');
        }
    }
}
