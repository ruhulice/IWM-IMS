<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::orderBy('id','asc')->get();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        // $menus      = Menu::where('parent_id', '=', 0)->where('status_id', 1)->orderBy('menu_order', 'asc')->get();
        // $menu_array = array();

        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'status_id' => 'required'
        ]);

        // $auth_serials       = 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:2:"15";}';

        // if(isset($request->authorization)){
        //     $auth_serials   = serialize($request->authorization);
        // }

        $role = Role::create([
            'name'             => $request->name,
            // 'authorization'    => $auth_serials,
            'status_id'        => $request->status_id,
            'created_by'       => Auth::id(),
            'updated_by'       => Auth::id(),
            'created_at'       => Carbon::now(),
            'updated_at'       => Carbon::now()
        ]);

        return redirect()->route('admin.user-roles.index')->with(['message' => 'User Role created successfully.']);
    }

    public function edit($id)
    {
        $role       = Role::findOrFail($id);
        // $menu_array = unserialize($role->authorization);
        // $menus      = Menu::where('parent_id', '=', 0)->where('status_id', 1)->orderBy('menu_order', 'asc')->get();

        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name'      => 'required',
            'status_id' => 'required'
        ]);

        $auth_serials   = $role->authorization;
        if(isset($request->authorization)){
            $auth_serials   = serialize($request->authorization);
        }

        $role->update([
            'name'          => $request->name,
            // 'authorization' => $auth_serials,
            'status_id'     => $request->status_id,
            'updated_by'    => Auth::id(),
            'updated_at'    => Carbon::now()
        ]);

        return redirect()->route('admin.user-roles.index')->with(['message' => 'User Role updated successfully.']);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $user = User::findOrFail(Auth::id());

        $role->delete();

        return back()->with(['message' => 'User Role deleted successfully!']);
    }

    public function RoleSwitchUpdate(Request $request){
        $role_id    = $request->role_id;
        $status     = $request->checkStatus;
        $role       = Role::findOrFail($role_id);
        $user       = User::findOrFail(Auth::id());

        if($status == 1){
            $role->update([
                'is_active'    => 0,
                'updated_by'   => Auth::id(),
                'updated_at'   => Carbon::now()
            ]);

            return response()->json(0);
        }else{
            $role->update([
                'is_active'    => 1,
                'updated_by'   => Auth::id(),
                'updated_at'   => Carbon::now()
            ]);

            return response()->json(1);
        }
    }
}
