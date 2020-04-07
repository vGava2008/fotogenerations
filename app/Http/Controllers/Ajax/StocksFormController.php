<?php

namespace App\Http\Controllers\Ajax;
use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Request as RequestFacade;
use Mail;
class StocksFormController extends Controller
{
    public function send(Request $request)
    {
        //dd($request->all());
        $result = false;
        if($request->ajax() && !empty($request->all()))
        {
            $sender = $request;
            Mail::send('emails.stocksCelebrates', ['sender' => $sender], function($message) use ($sender) {
                $message->from(env('MAIL_USERNAME'), env('MAIL_FROMSEND'));
                $message->to(env('MAIL_ADMIN_EMAIL'));
                $message->subject($sender->date_1);
                $message->subject($sender->celebrate_1);
                $message->subject($sender->date_2);
                $message->subject($sender->celebrate_2);
            });
            $result = true;
        }
        return response()->json(['result' => $result]);
    }
}