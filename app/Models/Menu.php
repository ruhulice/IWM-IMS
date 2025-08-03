<?php

namespace App\Models;

//use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Menu extends Model
{
    use Notifiable;

    public $timestamps = true;

    protected $fillable = ['icon','name','menu_url', 'url_link', 'menu_order', 'parent_id', 'status_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id')->withDefault(Menu::class);
    }

    public function childs() {
        return $this->hasMany(Menu::class,'parent_id','id')->where('status_id', 1)->orderBy('menu_order', 'asc');
    }

    public static function getAllMenuParentArray() {
        $items = array();
        foreach (self::where('status_id', 1)->where('parent_id', 0)->orderBy('menu_order', 'asc')->get() as $item) {
            $items[$item->id] = $item->name;
        }

        return $items;
    }

    public static function getAllMenuArray() {
        $items = array();
        foreach (self::where('status_id', 1)->orderBy('menu_order', 'asc')->get() as $item) {
            $items[$item->id] = $item->name;
        }

        return $items;
    }

    public static function getAllMenuNameByIds($ids){
        $menu_names = '';
        $m_ids = unserialize($ids);
        $menus = self::whereIn('id', $m_ids)->get();
        foreach ($menus as $menu){
            $menu_names .= $menu->name.', ';
        }

        return $menu_names;
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function childMenu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function menuRole()
    {
        return $this->hasMany(MenuRole::class);
    }

    public function permission()
    {
        return $this->hasMany(Permission::class);
    }

    public function createdUser()
    {
        return $this->belongsTo('App\User', 'created_by', 'id')->withDefault(User::class);
    }

    public function updatedUser()
    {
        return $this->belongsTo('App\User', 'updated_by', 'id')->withDefault(User::class);
    }

    public function checkMenuPermission($menuUrl)
    {
        if(isset(Auth::user()->role)) {
            foreach(Auth::user()->role as $role) {
                if(isset($role->role->menuRole)) {
                    foreach($role->role->menuRole as $menu_role) {
                        if ($menuUrl == $menu_role->menu->menu_url) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

}
