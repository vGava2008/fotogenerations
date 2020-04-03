<?php

namespace App\Http\Controllers\Ajax;
use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Request as RequestFacade;
use Mail;
class GiftcardController extends Controller
{
    public function send(Request $request)
    {
        //dd($request->all());
        $result = false;
        if($request->ajax() && !empty($request->all()))
        {
            $sender = $request;
            
            Mail::send('emails.default', ['sender' => $sender], function($message) use ($sender) {

                //$message->from($sender->email, $sender->name);MAIL_FROMSEND
                $message->from(env('MAIL_USERNAME'), env('MAIL_FROMSEND'));
                //$message->from(env('MAIL_USERNAME'));
                $message->to(env('MAIL_ADMIN_EMAIL'));
                $message->subject($sender->name_from);
                $message->subject($sender->name_to);
                $message->subject($sender->triumph);
                $message->subject($sender->nominal);
               	$message->subject($sender->date_send);
                $message->subject($sender->congratulation_text);
            });
            
            $result = true;
        }
        
        return response()->json(['result' => $result]);
    }
}
