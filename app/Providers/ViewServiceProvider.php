<?php
/**
 * Created by IntelliJ IDEA.
 * User: Asus
 * Date: 5/23/2019
 * Time: 8:11 AM
 */

namespace App\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(
            'layouts.app', 'App\Http\View\Composers\AppComposer'
        );
    }

}
