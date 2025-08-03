<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /**
     * Show the form for getting auth token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tokenAuthenticate(Request $request)
    {
        $user = User::where('user_name', 'api_manager')
            ->where('email', 'api.manager@email.com')
            ->first();
        $token = $user->createToken('Token Name')->accessToken;

        $response = [
                        "token_type" => "Bearer",
                        "expires_in" => 86400,
                        "access_token" => $token,
                        "status" => true,
                        "status_code" => 200
                    ];

        return $response;
    }

    /**
     * Show the form for getting plot data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPlotData(Request $request)
    {
        $request->validate([
            'div_code'   => 'required|numeric|digits:2',
            'dist_code'  => 'required|numeric|digits:2',
            'upz_code'   => 'required|numeric|digits:2',
            'jl_no'      => 'required|numeric|digits:3',
            'plot_no'    => 'required|numeric'
        ]);

        $mod_geocode = $request->div_code.$request->dist_code.$request->upz_code;

        $data = DB::table('view_mg')->where('geocode_en','LIKE','%'.$mod_geocode.'%')
                                    ->where('jl_no_en', $request->jl_no)
                                    ->where('plot_no_en', $request->plot_no)
                                    ->first();

        if($data == null) {
            $response_err = [
                "error" => "No Plot Data Found",
                "hint" => "Check the request parameters",
                "message" => "No Plot Data Found",
                "status" => false
            ];
            return $response_err;
        }
        else {

            $response = [
                "plot_data" => $data,
                "status" => true,
                "status_code" => 200
            ];

            return $response;
        }

    }

    /**
     * Store a newly created response error.
     *
     * @return \Illuminate\Http\Response
     */
    public static function responseError()
    {
        $response_err = [
            "error" => "Invalid Request",
            "error_description" => "The request is missing required parameters, or includes invalid parameter value.",
            "hint" => "Check the request parameters",
            "message" => "The request is missing required parameters, or includes invalid parameter value.",
            "status" => false
        ];

        return $response_err;
    }

}
