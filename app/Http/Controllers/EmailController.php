<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setlist as Setlist;
use App\Song as Song;
use Illuminate\Support\Facades\Auth as Auth;
use Mail;

class EmailController extends Controller
{
     public function send(Request $request)
    {
        $email = explode(',',$request->input('email') );
        $id =  $request->input('id');

        


        if (Auth::check()) {
            
            $setlist = Setlist::findOrFail($id);
            
            if (Auth::user()->id === $setlist->user_id) {
                
                Mail::send('emails.setlist', ['setlist' => Setlist::findOrFail($id),'songs'=>Song::where('setlist_id', '=',$id)->orderBy('position')->get()], function ($message)use ($email)
                {

                $message->from('no_replay@reydecibel.com.mx', 'Rey Decibel')->subject('Tu Setlist by Rey Decibel');;

                $message->to($email);

                });
                 return response()->json(['status' => 'success']);

            }else{
                return "No estas autorizado para estar aquí";
            }
            
        }else{
            return redirect('/login');
        }

       
    }


}
