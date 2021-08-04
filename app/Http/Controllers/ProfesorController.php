<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\User;
use Illuminate\Http\Request;

class ProfesorController extends Controller
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
     * Show the teacher dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        $asignaturas = Asignatura::where('user_id', $user->id)->orderBy('created_at', 'DESC')->paginate(6);
        return view('profesor.index', compact('user'), ['asignaturas' => $asignaturas]);
    }
}
