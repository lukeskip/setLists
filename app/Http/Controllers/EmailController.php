<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setlist as Setlist;
use App\Song as Song;
use Mail;

class EmailController extends Controller
{
     public function send(Request $request)
    {
        $email =  $request->input('email');
        $id =  $request->input('id');

        Mail::send('emails.setlist', ['setlist' => Setlist::findOrFail($id),'songs'=>Song::where('setlist_id', '=',$id)->orderBy('position')->get()], function ($message)use ($email)
        {

            $message->from('contacto@reydecibel.com.mx', 'Rey Decibel')->subject('Tu Setlist by Rey Decibel');;

            $message->to($email);

        });

        return response()->json(['status' => 'success']);
    }


}
