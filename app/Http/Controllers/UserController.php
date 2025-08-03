<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::orderBy('id','asc');

        return view('users.index', compact('users'));
    }

    public function FilteredUserData(Request $request){
        $filter_type   = $request->filter_type;
        $user_m        = (new User())->newQuery();

        if($filter_type == 'all'){
            $users = $user_m->orderBy('id', 'asc')->get();
        }

        if($filter_type == 'active'){
            $users = $user_m->where('is_active', 1)->orderBy('id', 'asc')->get();
        }

        if($filter_type == 'inactive'){
            $users = $user_m->where('is_active', 0)->orderBy('id', 'asc')->get();
        }

        return view('users.index_filter_data', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('status_id', 1)->get();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        /*$request->validate([
            'name'          => 'required|string|max:250',
            'user_name'     => 'required|string|max:50|unique:users',
            'email'         => 'required|string|email|max:230|unique:users',
            'password'      => 'required|string|min:8',
            'role_id'       => 'required|numeric'
        ]);*/

        $entry_user = User::create([
            'id'          => $request->id,
            'name'        => $request->name,
            'code'        => $request->code,
            'user_name'   => $request->user_name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'last_login_time'  => Carbon::now(),
            'is_active'      => $request->status,
            'created_by'  => Auth::id(),
            'updated_by'  => Auth::id(),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        $assigned_roles = $request->role_id;
        foreach($assigned_roles as $assigned_role) {
            UserRole::create([
                'user_id'        => $entry_user->id,
                'role_id'        => $assigned_role
            ]);
        }

        return redirect()->route('admin.users.index')->with(['message' => 'User created successfully.']);
    }

    public function edit($id)
    {
        $allRoles = [];
        $assigned_roles = [];

        $user = User::with('role')->findOrFail($id);
        /*$roles = Role::getAllUserGroupsArray();*/
        $roles = Role::where('status_id', 1)->orderBy('id', 'asc')->select('id', 'name')->get();
        foreach($roles as $i=>$role) {
            if($user->role->count()>0) {
                foreach($user->role as $i=>$user_role) {
                    if($role->id==$user_role->role_id) {
                        array_push($assigned_roles, ['id' => $role->id, 'name' => $role->name]);
                    }
                }
            }
            array_push($allRoles, ['id' => $role->id, 'name' => $role->name]);
        }

        $unassigned_arr = array_diff(array_map('serialize',$allRoles), array_map('serialize',$assigned_roles));
        $unassigned_roles = array_map('unserialize',$unassigned_arr);


        return view('users.edit', compact('user', 'roles', 'assigned_roles', 'unassigned_roles'));
    }

    public function update(Request $request, $id)
    {
        /*$request->validate([
            'name'          => 'required|string|max:250',
            'user_name'     => 'required|string|max:15|unique:users',
            'email'         => 'required|string|email|max:190|unique:users',
            'role_id'       => 'required|numeric'
        ]);*/

        $assigned_roles = $request->role_id;

        $user = User::findOrFail($id);

        $user->update([
            'name'        => $request->name,
            'code'        => $request->code,
            'user_name'   => $request->user_name,
            'email'       => $request->email,
            'is_active'   => $request->status,
            'updated_by'  => Auth::id(),
            'updated_at'  => Carbon::now()
        ]);

        $check_role = UserRole::where('user_id', $id)->get();

        if(isset($check_role) && $check_role->count()>0) {
            UserRole::where('user_id', $id)->delete();
        }
        foreach($assigned_roles as $assigned_role) {
            UserRole::create([
                'user_id'        => $id,
                'role_id'        => $assigned_role
            ]);
        }

        return redirect()->route('admin.users.index')->with(['message' => 'User updated successfully.']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $log_user = User::findOrFail(Auth::id());

        $user->delete();

        return back()->with(['message' => 'User deleted successfully!']);
    }

    public function UserSwitchUpdate(Request $request){
        $user_id    = $request->user_id;
        $status     = $request->checkStatus;
        $user       = User::findOrFail($user_id);

        if($status == 1){
            $user->update([
                'is_active'        => 0,
                'updated_by'    => Auth::id(),
                'updated_at'    => Carbon::now()
            ]);

            return response()->json(0);
        }else{
            $user->update([
                'is_active'        => 1,
                'updated_by'    => Auth::id(),
                'updated_at'    => Carbon::now()
            ]);

            return response()->json(1);
        }
    }

}
