<?php

namespace App\Http\Controllers;

use App\Models\SmsConfiguration;
use App\Models\User;
use App\Models\UserFeedback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = UserFeedback::orderBy('id','desc')->get();

        return view('feedback-management.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feedback = UserFeedback::where('id',$id)->first();

        return view('feedback-management.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resolve(Request $request)
    {
        $feedback = UserFeedback::findOrFail($request->feedback_id);

        $feedback->update([
            'admin_comments' => $request->admin_comments,
            'is_resolved' => true,
            'updated_by' => Auth::id(),
            'updated_at' => Carbon::now()
        ]);

        $notificationTitle = 'The Land Authority has resolved a Feedback on Land Use';
        $notificationDetails = 'Feedback on Plot-'.$request->plot_no.' for Land Use has been verified and resolved by the administrative team';
        $toUser = $request->to_user;

        NotificationController::resolveNotification($notificationTitle, $notificationDetails, $toUser);

        $last_sms_configs = SmsConfiguration::orderBy('id', 'desc')->first();
        if($last_sms_configs->feedback_sms == true) {
            NotificationController::smsNotification($toUser);
        }

        return redirect()->to('feedback-list');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
