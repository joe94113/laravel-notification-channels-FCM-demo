<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\HelloNotification;
use Illuminate\Support\Facades\Auth;

class PushController extends Controller
{
    public function push()
    {
        $user = Auth::user();
        try {
            $user->notify(new HelloNotification());
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function fcmToken(Request $request)
    {
        try {
            if (Auth::user()->device_token == $request->token) {
                return response()->json(['success' => true], 200);
            } else {
                Auth::user()->update(['device_token' => $request->token]);
                return response()->json(['success' => true], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
