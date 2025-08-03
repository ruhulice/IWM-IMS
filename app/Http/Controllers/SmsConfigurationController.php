<?php

namespace App\Http\Controllers;

use App\Models\SmsConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SmsConfigurationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sms_configs = SmsConfiguration::orderBy('id', 'desc')->take('5')->get();
        $last_sms_configs = SmsConfiguration::orderBy('id', 'desc')->first();

        return view('sms_configuration.sms_config', compact('sms_configs', 'last_sms_configs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$sms_configs = SmsConfiguration::count();*/

        if($request->feedback_sms) {
            $feedback = 1;
        }
        else {
            $feedback = 0;
        }

        SmsConfiguration::create([
            'feedback_sms' => $feedback,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        /*if($sms_configs>0) {
            $smsConfigurationUpdate = SmsConfiguration::findOrFail(1);
            $smsConfigurationUpdate->update([
                'feedback_sms' => $feedback,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        else {
            SmsConfiguration::create([
                'feedback_sms' => $feedback,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }*/


        $status = array(
            'message'    => 'SMS Confuration updated successfully !',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.SmsConfiguration.create')->with($status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
