<?php

namespace App\Http\Controllers;

use App\Opinion;
use Illuminate\Http\Request;

class OpinionLikeController extends Controller
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

    public function store(Opinion $opinion)
    {
        $opinion->likes()->create([
            'user_id' => request()->user()->id,
        ]);
        return redirect('/presentacion/' . $opinion->presentacion_id . '#sugerencias');
    }

    public function destroy(Opinion $opinion)
    {
        request()->user()->likes()->where('opinion_id', $opinion->id)->delete();
        return redirect('/presentacion/' . $opinion->presentacion_id . '#sugerencias');
    }
}
