<?php

namespace App\Http\Controllers;

use App\FloatingChatMessage;
use App\FloatingChatUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class MessageController extends Controller
{
    public function index()
    {
        if(env('CHAT_MODULE') == 'yes')
        {
            $objUser = Auth::user();
            //        $users   = User::where('users.id', '!=', $objUser->id)->get();
            $users = FloatingChatUser::where('is_end', '!=', '1')->orderBy('id', 'DESC')->get();

            return view('admin.chats.index', compact('users'));
        }
        else
        {
            return redirect()->back();
        }
    }

    public function getMessage($user_id)
    {
        $my_id = 0;

        // Make read all unread message
        FloatingChatMessage::where(
            [
                'from' => $user_id,
                'to' => $my_id,
            ]
        )->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = FloatingChatMessage::where(
            function ($query) use ($user_id, $my_id){
                $query->where('from', $user_id)->where('to', $my_id);
            }
        )->oRwhere(
            function ($query) use ($user_id, $my_id){
                $query->where('from', $my_id)->where('to', $user_id);
            }
        )->get();

        $messagehtml = view('admin.chats.message', compact('messages'))->render();

        $deletehtml = '';
        if($messages->count() > 0)
        {
            $deletehtml .= '<a href="#" class="btn btn-xs btn-outline-danger float-right" data-confirm="' . __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') . '" data-confirm-yes=document.getElementById("delete-chat-' . $user_id . '").submit()>' . __('Delete') . '</a>
                            <form id="delete-chat-' . $user_id . '" action="' . route('admin.delete.user.message', $user_id) . '" method="POST" style="display: none;">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                            </form>';
        }

        $response = [
            'messagehtml' => $messagehtml,
            'deletehtml' => $deletehtml,
        ];

        return json_encode($response);
    }

    public function sendMessage(Request $request)
    {
        $from    = 0;
        $to      = $request->receiver_id;
        $message = $request->message;

        $data          = new FloatingChatMessage();
        $data->from    = $from;
        $data->to      = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        // pusher
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), $options
        );

        $data = [
            'from' => $from,
            'to' => $to,
        ]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    // For Floating Chat
    public function store(Request $request)
    {
        if(!empty($request->email))
        {
            $floatingUser = FloatingChatUser::create(['email' => $request->email]);

            $floatingUser = [
                'email' => $floatingUser->email,
                'id' => $floatingUser->id,
            ];

            return $floatingUser;
            // return 'true';
        }
        else
        {
            return 'false';
        }
    }

    public function getFloatingMessage()
    {
        $cookie_val = json_decode($_COOKIE['chat_user']);

        $user_id = $cookie_val->id;
        $my_id   = 0;

        // Make read all unread message
        FloatingChatMessage::where(
            [
                'from' => $user_id,
                'to' => $my_id,
            ]
        )->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = FloatingChatMessage::where(
            function ($query) use ($user_id, $my_id){
                $query->where('from', $user_id)->where('to', $my_id);
            }
        )->oRwhere(
            function ($query) use ($user_id, $my_id){
                $query->where('from', $my_id)->where('to', $user_id);
            }
        )->get();

        return view('admin.chats.floating_message', ['messages' => $messages]);
    }

    public function sendFloatingMessage(Request $request)
    {
        $cookie_val = json_decode($_COOKIE['chat_user']);

        $from    = empty($_COOKIE['chat_user']) ? 0 : $cookie_val->id;
        $to      = (!empty($request->receiver_id)) ? $request->receiver_id : 0;
        $message = $request->message;

        $data          = new FloatingChatMessage();
        $data->from    = $from;
        $data->to      = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();

        // pusher
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), $options
        );

        $data = [
            'from' => $from,
            'to' => $to,
        ]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    // End Floating Chat

    public function deleteUserMessage(Request $request, $user_id)
    {
        FloatingChatMessage::where('from', $user_id)->oRwhere('to', $user_id)->delete();

        return redirect()->back()->with('success', __('Chat deleted Successfully'));
    }
}
