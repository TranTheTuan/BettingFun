<?php
/**
 * Created by IntelliJ IDEA.
 * User: Asus
 * Date: 5/23/2019
 * Time: 8:14 AM
 */

namespace App\Http\View\Composers;


use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AppComposer
{
    public function compose(View $view)
    {
        $view->with('user', Auth::user());
    }

}
