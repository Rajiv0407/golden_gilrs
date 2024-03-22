<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Group;

use App\Events\MessageEvent;  

class MessageController extends Controller
{
    public function __construct()
    {
        //$this->middleware('member');
    }

    //show messages from a group   
    // public function show_messages($id)
    // {
    //     $group = Group::find($id);

    //     $messages = $group->messages()->with(['group', 'user'])->get();

    //     $user_loggedIn = auth()->user();
    //     return view('messages.index', compact(['group', 'messages']));
    //    // return ['messages' => $messages, 'user_loggedIn' => $user_loggedIn];
    // }

    public function isread($id)
    {
        $my_id = Auth::id();  
        $messages = message::where(['user_id' => $my_id])->get();
        foreach($messages as $value) {
            message::where(['user_id' => $my_id])->update(['is_read' => 1]);
            return redirect()->back();
        }
    }

    public function send_message(Request $request, $id)
    {
        $this->validate($request, [
            'message' => 'required',
        ]);

        $message = Message::create([
            'user_id' => auth()->user()->id,
            'group_id' => $id,
            'message' => $request->message,
            'is_read' => 0
        ])->with(['group', 'user'])->latest()->first();
        
        // $t=array(
        //     'user_id' => auth()->user()->id,
        //     'group_id' => $id,
        //     'message' => $request->message,
        //     'is_read' => 0
        // );
      
        //update the group. The update_at date will help list groups from the most recent to the oldest
        $group = Group::find($message->group_id);

        $group->update(['updated_at' => $message->updated_at]);
        
        
      
       return redirect('/home')
      
    }
}
