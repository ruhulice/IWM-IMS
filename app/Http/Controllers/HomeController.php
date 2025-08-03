<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
        //$results = DB::select('select dt.id, dt.name, count(d) as nod from doc_types dt left join documents d on dt.id = d.doc_type where d.is_active=1 group by dt.id, dt.name order by dt.id');
        return view('home');
    }

    public function noPageFound()
    {
        $notification = array(
            'message'    => 'Page does not exist !!!',
            'alert-type' => 'danger'
        );

        return redirect()->back()->with($notification);
    }


}
