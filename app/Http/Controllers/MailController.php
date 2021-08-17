<?php

namespace App\Http\Controllers;

use App\Mail\MailRegistro;
use App\Mail\MailConfirmacion;
use App\Mail\MailContact;
use App\Mail\MailFail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMailRegistro($name, $email, $id)
    {
        $to = [['name' => 'ADMINISTRADOR', 'email' => 'roherca@usal.es']];
        Mail::to($to)->send(new MailRegistro($name, $email, $id));
        if (!Mail::failures()) {
            return view('auth.validating');
        } else {
            abort(404);
        }
    }

    public function sendMailConfirmacion($name, $email)
    {
        $to = [['name' => $name, 'email' => $email]];
        Mail::to($to)->send(new MailConfirmacion($name, $email));
        if (!Mail::failures()) {
            return view('auth.validate', ['success' => true]);
        } else {
            abort(404);
        }
    }

    public function sendMailFail($name, $email)
    {
        $to = [['name' => $name, 'email' => $email]];
        Mail::to($to)->send(new MailFail($name, $email));
        if (!Mail::failures()) {
            return view('auth.validate', ['success' => false]);
        } else {
            abort(404);
        }
    }

    public function contact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required'
        ]);
        $name = $request->get('name');
        $email = $request->get('email');
        $comment = $request->get('comment');
        $to = [['name' => 'ADMINISTRADOR', 'email' => 'roherca@usal.es']];
        Mail::to($to)->send(new MailContact($name, $email, $comment));
        if (!Mail::failures()) {
            return back()->with('success', 'Gracias por contactar, responderemos a tu mensaje tan pronto como sea posible!');
        } else {
            abort(404);
        }
    }
}
