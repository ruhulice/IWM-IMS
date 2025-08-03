<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RahulHaque\AdnSms\Facades\AdnSms;

class NotificationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifications = Notification::orderBy('id','desc')->get();

        return view('notifications.index', compact('notifications'));
    }

    public function notificationSeen(Request $request,$notificationId)
    {
        $notification = Notification::findOrFail($notificationId);

        $notification->update([
            'is_seen'       => true,
            'seen_time'     => Carbon::now(),
            'to_user'       => Auth::user()->id,
            'updated_by'    => Auth::user()->id,
            'updated_at'    => Carbon::now()
        ]);

        return response()->json(true);
    }


    public function addNotification(Request $request)
    {
        /*$request->validate([
            'notification_title'   => 'required',
            'notification_details' => 'required'
        ]);*/

        Notification::create([
            'notification_title'    => $request->notificationTitle,
            'notification_details'  => $request->notificationDetails,
            'action'                => $request->action,
            'to_user'               => $request->toUser,
            'created_by'            => Auth::id(),
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        return response()->json(true);
    }

    public function count()
    {
        $notification_count = Notification::where('to_user', Auth::user()->id)
            ->where('is_seen','!=','true')
            ->count();

        return response()->json($notification_count);
    }

    public static function resolveNotification($notificationTitle, $notificationDetails, $toUser)
    {
        Notification::create([
            'id' => '',
            'notification_title' => $notificationTitle,
            'notification_details' => $notificationDetails,
            'action' => '',
            'to_user' => $toUser,
            'created_by' => Auth::id(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return response()->json(true);
    }

    public static function smsNotification($toUser)
    {
        $phoneWithExt = User::where('id', $toUser)
            ->whereNotNull('phone_no')
            ->whereNotNull('country_extension')
            ->select('id','phone_no','country_extension')
            ->first();

        if(is_null($phoneWithExt)) {
            /*No phone number exists*/
        }
        else {
            $phoneNo = $phoneWithExt->country_extension.$phoneWithExt->phone_no;

            AdnSms::to($phoneNo)
                ->message('Your feedback on Land Zoning Portal has been resolved by the concern Authority.')
                ->send();
        }

        return response()->json(true);
    }
}
