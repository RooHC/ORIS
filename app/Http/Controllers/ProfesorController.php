<?php

namespace App\Http\Controllers;

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
        return view('profesor.index', compact('user'));
    }
}
