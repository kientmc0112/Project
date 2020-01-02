<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\TestNotification;
use App\Models\User;
use Pusher\Pusher;

class SendNotification extends Controller
{
    public function create()
    {
        return view('client.notification.send');
    }

    public function store(Request $request)
    {
        $user = User::find(1);
        $data = $request->only([
            'title',
            'content',
        ]);
        $user->notify(new TestNotification($data));
        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true,
            // 'authTransport' => 'jsonp',
            // 'authEndpoint'=> 'http://myserver.com/pusher_jsonp_auth'
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        // $auth = $pusher->socket_auth($_GET['channel_name'], $_GET['socket_id']);
        $pusher->trigger('NotificationEvent', 'send-message', $data);
        // dd($auth);
        return view('client.notification.send');
    }
}
