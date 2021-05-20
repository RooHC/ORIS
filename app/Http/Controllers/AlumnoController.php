<?php

namespace App\Http\Controllers;

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
        $presentaciones = Presentacion::where('user_id', $user->id)->orderBy('created_at', 'DESC') ->paginate(6);
        return view('alumno.index', compact('user'), ['presentaciones' => $presentaciones]);
    }
}
