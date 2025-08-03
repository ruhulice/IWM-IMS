<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuRole;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function menuRolePermissions()
    {
        $menus = Menu::orderBy('id','asc')->get();

        return view('menu-role-permissions.index', compact('menus'));
    }

    public function AssignRolePermission($menuId)
    {
        $allRoles = [];
        $assigned_roles = [];

        $menu = Menu::with('menuRole')->findOrFail($menuId);
        $roles = Role::where('status_id', 1)->orderBy('id', 'asc')->select('id', 'name')->get();
        foreach($roles as $i=>$role) {
            if($menu->menuRole->count()>0) {
                foreach($menu->menuRole as $i=>$menu_role) {
                    if($role->id==$menu_role->role_id) {
                        array_push($assigned_roles, ['id' => $role->id, 'name' => $role->name]);
                    }
                }
            }
            array_push($allRoles, ['id' => $role->id, 'name' => $role->name]);
        }

        $unassigned_arr = array_diff(array_map('serialize',$allRoles), array_map('serialize',$assigned_roles));
        $unassigned_roles = array_map('unserialize',$unassigned_arr);

        return view('menu-role-permissions.assign_permission', compact('menu', 'roles', 'assigned_roles', 'unassigned_roles'));
    }

    public function UpdatePermission(Request $request, $menuId)
    {
        $assigned_roles = $request->role_id;
        $check_role = MenuRole::where('menu_id', $menuId)->get();
        if(isset($check_role) && $check_role->count()>0) {
            MenuRole::where('menu_id', $menuId)->delete();
        }
        if($assigned_roles) {
            foreach($assigned_roles as $assigned_role) {
                MenuRole::create([
                    'menu_id'        => $menuId,
                    'role_id'        => $assigned_role
                ]);
            }
        }

        return redirect()->route('admin.MenuRolePermission')->with(['message' => 'Permission updated successfully.']);
    }

    public function index()
    {
        $permissions = Permission::with('rolePermission')->orderBy('id','asc')->get();

        return view('menu-role-permissions.permission.index', compact('permissions'));
    }

    public function create()
    {
        $active_routes = [];

        $routes = array_map(function (\Illuminate\Routing\Route $route)
        {
            return $route->uri;
        }, (array) Route::getRoutes()->getIterator());

        foreach($routes as $i=>$routing) {
            if(!str_contains($routing, 'admin/') && !str_contains($routing, '_ignition') && !str_contains($routing, 'sanctum/')
                && !str_contains($routing, '{fallbackPlaceholder}')
                && !str_contains($routing, 'login') && !str_contains($routing, 'logout')) {
                array_push($active_routes, ['url' => $routing]);
            }
        }

        return view('menu-role-permissions.permission.create', compact('active_routes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'permission_name'   => 'required|unique:permissions',
            'url'               => 'required'
        ]);

        Permission::create([
            'permission_name' => $request->permission_name,
            'url' => $request->url,
            'created_by' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message'    => 'Permission created successfully !',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.permissions.index')->with($notification);
    }


    public function edit($permissionId)
    {
        $permission = Permission::with('rolePermission')->findOrFail($permissionId);

        $active_routes = [];
        $routes = array_map(function (\Illuminate\Routing\Route $route)
        {
            return $route->uri;
        }, (array) Route::getRoutes()->getIterator());

        foreach($routes as $i=>$routing) {
            if(!str_contains($routing, 'admin/') && !str_contains($routing, '_ignition') && !str_contains($routing, 'sanctum/')
                && !str_contains($routing, '{fallbackPlaceholder}')
                && !str_contains($routing, 'login') && !str_contains($routing, 'logout')) {
                array_push($active_routes, ['url' => $routing]);
            }
        }

        return view('menu-role-permissions.permission.edit', compact('permission', 'active_routes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'permission_name'   => 'required',
            'url'               => 'required'
        ]);

        $permission = Permission::findOrFail($id);

        $permission->update([
            'permission_name' => $request->permission_name,
            'url' => $request->url,
            'updated_by' => Auth::id(),
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('admin.permissions.index')->with(['message' => 'Permission updated successfully.']);
    }

    public function assignPermission($permissionId)
    {
        $allRoles = [];
        $assigned_roles = [];
        $permission = Permission::with('rolePermission')->findOrFail($permissionId);
        $roles = Role::where('status_id', 1)->orderBy('id', 'asc')->select('id', 'name')->get();

        foreach($roles as $i=>$role) {
            if($permission->rolePermission->count()>0) {
                foreach($permission->rolePermission as $i=>$role_permission) {
                    if($role->id==$role_permission->role_id) {
                        array_push($assigned_roles, ['id' => $role->id, 'name' => $role->name]);
                    }
                }
            }
            array_push($allRoles, ['id' => $role->id, 'name' => $role->name]);
        }

        $unassigned_arr = array_diff(array_map('serialize',$allRoles), array_map('serialize',$assigned_roles));
        $unassigned_roles = array_map('unserialize',$unassigned_arr);



        return view('menu-role-permissions.permission.assign', compact('permission', 'roles', 'assigned_roles', 'unassigned_roles'));
    }

    public function assignPermissionUpdate(Request $request, $permissionId)
    {
        $assigned_roles = $request->role_id;
        $check_role = RolePermission::where('permission_id', $permissionId)->get();
        if(isset($check_role) && $check_role->count()>0) {
            RolePermission::where('permission_id', $permissionId)->delete();
        }
        if($assigned_roles) {
            foreach($assigned_roles as $assigned_role) {
                RolePermission::create([
                    'permission_id'  => $permissionId,
                    'role_id'        => $assigned_role
                ]);
            }
        }

        return redirect('/admin/permissions')->with(['message' => 'Permission updated successfully.']);
    }

    public function test()
    {
        $menus = Menu::orderBy('id','asc')->get();
        return view('menu-role-permissions.index', compact('menus'));
    }
}
