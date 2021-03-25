<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\account;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
use Session;
use DB;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('assign.guard:api');
    }

    public function index()
    {
        //$users = DB::select('select * from account');
        //dd(Session::get('5fb77f190b788f0029513b14')[0]->name);
        
        $users = DB::select("select account.id, account.username, account.url_avata, account.email, count(is_read) as unread 
        from account LEFT  JOIN  messages ON account.id = messages.from and is_read = 0 and messages.to = " . 1 . " 
        group by account.id, account.username, account.url_avata, account.email order by unread DESC");
       
        return view('Admin.Chat.viewAdminchat', ['users' => $users]);
        //return json_encode($result, true);
    }

    public function userchat()
    {
        //$users = DB::select('select * from account');
        //dd(Session::get('5fb77f190b788f0029513b14')[0]->name);
        
        $users = DB::select("select * from admins ");
        return view('Admin.Chat.home', ['users' => $users]);
        //return json_encode($result, true);
    }

    public function getMessage($user_id)
    {   
        $my_id = Session::get('5fb77f190b788f0029513b14')[0]->id; // auth('admin')->user()->id;
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);
        
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->orWhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();
        //dd($messages);
        return view('Admin.Chat.indexchat', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = 1;
        $to = $request->receiver_id; //Session::get('5fb77f190b788f0029513b14')[0]->id;

        $message = $request->message;
        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
       
        $data->save();
        
        $options = array(
            'cluster' => 'ap1',
            // 'useTLS' => true // HTTPS
        );
        
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
       
        $data = ['from' => $from, 'to' => $to, 'message' => $message];
        $pusher->trigger('my-channel', 'my-event', $data);

        ChatController::getMessage($to);
        
    }

    public function sendMessagetest(Request $request)
    {
        $from = auth('api')->user()->id;
        
        $to = 1; //Session::get('5fb77f190b788f0029513b14')[0]->id;

        $message = $request->message;
        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        
        $data->save();

        $options = array(
            'cluster' => 'ap1',
            // 'useTLS' => true // HTTPS
        );
        
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
       
        $data = ['from' => $from, 'to' => $to, 'message' => $message];
        $pusher->trigger('my-channel', 'my-event', $data);

        return $data;
    }


    public function getMessageAdmin($user_id)
    {   
        $my_id = 1; // auth('admin')->user()->id;
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);
        
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->orWhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();
        
        return  response()->json([

            'status' => false,

            'code' => 200,

            'message' => trans('message.get_success'),

            'data' => $messages

      ], 200);
        //return view('Admin.Chat.indexchat', ['messages' => $messages]);
    }


       
//  _____ _   _  ___ _____   _   _ _____ ___________    _    _ ___________ _____ _   _    _   _ _____ ___________ 
//  /  __ | | | |/ _ |_   _| | | | /  ___|  ___| ___ \  | |  | |_   _|  _  |_   _| | | |  | | | /  ___|  ___| ___ \
//  | /  \| |_| / /_\ \| |   | | | \ `--.| |__ | |_/ /  | |  | | | | | | | | | | | |_| |  | | | \ `--.| |__ | |_/ /
//  | |   |  _  |  _  || |   | | | |`--. |  __||    /   | |/\| | | | | | | | | | |  _  |  | | | |`--. |  __||    / 
//  | \__/| | | | | | || |   | |_| /\__/ | |___| |\ \   \  /\  /_| |_| |/ /  | | | | | |  | |_| /\__/ | |___| |\ \ 
//   \____\_| |_\_| |_/\_/    \___/\____/\____/\_| \_|   \/  \/ \___/|___/   \_/ \_| |_/   \___/\____/\____/\_| \_|
                                                                                                              
    public function getUserChat()
    {
        
        $users = DB::select("select account.id, account.username, account.url_avata, account.email, count(is_read) as unread 
        from account LEFT  JOIN  messages ON account.id = messages.from and is_read = 0 and messages.to = " . 1 . " 
        group by account.id, account.username, account.url_avata, account.email order by unread DESC");

        return  response()->json([

            'status' => true,

            'code' => 200,

            'message' => trans('message.success'),

            'data' => $users

        ], 200);
       
    }

    public function sendMessagesUser(Request $request, $id)
    {
        $from = auth('api')->user()->id;
        $to = $id;
        $message = $request->message;
        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        $mess = $data->save();
        $options = array(
            'cluster' => 'ap2',
            // 'useTLS' => true // HTTPS
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $data = ['from' => $from, 'to' => $to];
        $pusher->trigger('my-channel', 'my-event', $data);

        if($mess)
        {
            return  response()->json([

                'status' => true,
    
                'code' => 200,
    
                'message' => trans('message.success'),
    
                'data' => $data
    
            ], 200);
        }
        else{
            return  response()->json([

                'status' => false,
    
                'code' => 200,
    
                'message' => trans('message.unsuccess')
    
            ], 200);
        }

    }

    public function getMessagesUser(Request $request, $user_id)
    {
        $my_id = auth('api')->user()->id;
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return  response()->json([

            'status' => true,

            'code' => 200,

            'message' => trans('message.success'),

            'data' => $messages

        ], 200);
    }

}
