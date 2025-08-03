<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApiController;
use Closure;
use Illuminate\Http\Request;

class CheckAuthApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->grant_type == 'app_token' && $request->client_id == 2
            && $request->client_secret == 'UkYJ5IHKvnTxfCqazzEPSdx5iJownEoheDxUtj18'
            && $request->service == 'plot-data')
        {
            return $next($request);
        }
        else {

            $response = [
                            "error" => "Invalid Request",
                            "error_description" => "The request is missing required parameters, or includes invalid parameter value.",
                            "hint" => "Check the request parameters",
                            "message" => "The request is missing required parameters, or includes invalid parameter value.",
                            "status" => false
                        ];
            return response()->json($response, 401);
        }
    }
}
