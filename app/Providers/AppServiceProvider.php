<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register(\Reliese\Coders\CodersServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view)
        {
            $data['user_role'] = UserRole::with('role')->get();
            $data['menus'] = Menu::with('childs', 'menuRole')
                            ->where('status_id', 1)
                            ->where('parent_id', 0)
                            ->orderBy('menu_order', 'asc')
                            ->select('id', 'name', 'icon', 'menu_url')
                            ->get();
            /*for notification*/
            if(isset(Auth::user()->id)) {
                $data['notifications'] = Notification::where('to_user', Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->get()->take(20);
                $data['notification_count'] = Notification::where('to_user', Auth::user()->id)
                    ->where('is_seen','!=','true')
                    ->count();
            }
            /*for notification*/

            $view->with('data', $data);
        });
    }
}
