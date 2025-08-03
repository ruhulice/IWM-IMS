<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;

class MemoController extends Controller
{
    //
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        $users = User::orderBy('id','asc');
        return view('memos.index',compact('users'));
    }
}
