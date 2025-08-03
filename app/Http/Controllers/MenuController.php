<?php

namespace App\Http\Controllers;

use App\Models\LogInfo;
use App\Models\Menu;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $menus = Menu::orderBy('id','asc')->get();
        $parent_menus = Menu::getAllMenuParentArray();

        return view('menus.index', compact('menus', 'parent_menus'));
    }

    public function FilteredMenuData(Request $request){
        $menu_id   = $request->menu_option;
        $menu      = (new Menu())->newQuery();
        if($menu_id == 'all'){
            $menus = $menu->orderBy('id','asc')->get();
            return view('menus.index_filter_data', compact('menu_id', 'menus'));
        }else{
            $menus = $menu->where('parent_id', $menu_id)->orderBy('menu_order', 'asc')->orderBy('status_id', 'desc')->get();
            return view('menus.index_filter_data', compact('menu_id', 'menus'));
        }
    }

    public function create()
    {
        $menus = Menu::where('parent_id',0)->orderBy('name','asc')->get();

        return view('menus.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon'      => 'required',
            'name'      => 'required',
            'menu_order' => 'required',
            'status_id'   => 'required'
        ]);

        /*if($request->icon) {
            $fileName = 'menu_icon' . '_' . time() . '.'.$request->icon->extension();
            $iconPath = public_path('assets\uploads\menu_icons');
        }*/

        Menu::create([
            /*'icon' => $fileName?:'',*/
            'icon' => $request->icon,
            'name' => $request->name,
            'menu_url' => $request->menu_url,
            'url_link' => $request->url_link?:'',
            'menu_order' => $request->menu_order,
            'parent_id' => $request->parent_id,
            'status_id' => $request->status_id,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        /*if ($request->icon) {
            $request->icon->move($iconPath, $fileName);
        }*/

        $notification = array(
            'message'    => 'Menu created successfully !',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.menus.index')->with($notification);
    }

    public function edit(Menu $menu)
    {
        $url_result  = unserialize($menu->url_link);

        $menus = Menu::where('parent_id',0)->orderBy('name','asc')->get();

        return view('menus.edit', compact('menu', 'url_result', 'menus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'icon'      => 'required',
            'name'      => 'required',
            'menu_order' => 'required',
            'status_id'   => 'required'
        ]);

        /*if($request->icon) {
            $fileName = 'menu_icon' . '_' . time() . '.'.$request->icon->extension();
            $iconPath = public_path('assets\uploads\menu_icons');
        }*/

        $menu->update([
            /*'icon'       => $request->icon ? $fileName : $menu->icon,*/
            'icon'       => $request->icon,
            'name'       => $request->name,
            'menu_url'   => $request->menu_url,
            'url_link'   => $request->url_link?:'',
            'menu_order' => $request->menu_order,
            'parent_id'  => $request->parent_id,
            'status_id'  => $request->status_id,
            'updated_by' => Auth::id(),
            'updated_at' => Carbon::now()
        ]);

        /*if ($request->icon) {
            $request->icon->move($iconPath, $fileName);
        }*/

        /*$user = User::findOrFail(Auth::id());

        LogInfo::create([
            'who_do'     =>  $user->user_name.'['.$user->name.']',
            'what_do'    =>  'Update menu ## Table{menus} ## ID{'.$menu->id.'}',
            'when_do'    =>  Carbon::now(),
            'ip_addr'    =>  request()->ip(),
            'created_by' =>  $user->id
        ]);*/

        $notification = array(
            'message'    => 'Menu updated successfully !'
        );

        return redirect()->route('admin.menus.index')->with($notification);
    }

    public function destroy(Menu $menu)
    {
        $user = User::findOrFail(Auth::id());

        LogInfo::create([
            'who_do'     =>  $user->user_name.'['.$user->name.']',
            'what_do'    =>  'Delete menu ## Table{menus} ## ID{'.$menu->id.'}',
            'when_do'    =>  Carbon::now(),
            'ip_addr'    =>  request()->ip(),
            'created_by' =>  $user->id
        ]);

        $menu->delete();

        return back()->with(['message' => 'Menu deleted successfully.']);
    }

    public function MenuSwitchUpdate(Request $request){
        $menu_id    = $request->menu_id;
        $status     = $request->checkStatus;
        $menu       = Menu::findOrFail($menu_id);
        $user       = User::findOrFail(Auth::id());

        if($status == 1){
            $menu->update([
                'status_id'    => 0,
                'updated_by'    => Auth::id(),
                'updated_at'    => Carbon::now()
            ]);

            LogInfo::create([
                'who_do'     =>  $user->user_name.'['.$user->name.']',
                'what_do'    =>  'Status Update menu ## Table{menus} ## ID{'.$menu->id.'}',
                'when_do'    =>  Carbon::now(),
                'ip_addr'    =>  request()->ip(),
                'created_by' =>  $user->id
            ]);

            return response()->json(0);
        }else{
            $menu->update([
                'status_id'    => 1,
                'updated_by'    => Auth::id(),
                'updated_at'    => Carbon::now()
            ]);

            LogInfo::create([
                'who_do'     =>  $user->user_name.'['.$user->name.']',
                'what_do'    =>  'Status Update menu ## Table{menus} ## ID{'.$menu->id.'}',
                'when_do'    =>  Carbon::now(),
                'ip_addr'    =>  request()->ip(),
                'created_by' =>  $user->id
            ]);

            return response()->json(1);
        }
    }

    public function GetSortMenuData(Request $request){
        $menu_id   = $request->menu_option;
        $menu = (new Menu())->newQuery();
        if($menu_id == 'all'){
            $menus = $menu->orderBy('id','asc')->get();
        }else{
            $menus = $menu->where('status_id', true)->where('parent_id', $menu_id)->orderBy('menu_order', 'asc')->get();
        }
        $set_row = 15;
        $set_row = ceil(count($menus)/2);

        return view('menus.sort_data', compact('menu_id', 'menus', 'set_row'));
    }

    public function MenuSortListSubmit(Request $request){
        $hrch_list   = $request->hrch_list;
        $menu_id     = $request->menu_id;
        $hrch_array  = explode(',', $hrch_list);
        $user        = User::findOrFail(Auth::id());

        if($menu_id == 'all'){

        } else{
            foreach ($hrch_array as $key => $hrch) {
                $query = "update menus set menu_order = $key+1 where id = $hrch and parent_id = $menu_id";
                DB::update(DB::raw($query));

                LogInfo::create([
                    'who_do'     =>  $user->user_name.'['.$user->name.']',
                    'what_do'    =>  'Hierarchy Update menu ## Table{menus} ## ID{'.$hrch.'}',
                    'when_do'    =>  Carbon::now(),
                    'ip_addr'    =>  request()->ip(),
                    'created_by' =>  $user->id
                ]);
            }
        }

        return response()->json(['success'=>'Successfully Updated Hierarchy!']);
    }

    public function menu_list(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $formatted_tags = [];

        if(!empty($term)){
            $formatted_tags[] = ['id' => $term, 'text' => $term];
        }

        return response()->json($formatted_tags);
    }
}
