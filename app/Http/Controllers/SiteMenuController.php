<?php

namespace App\Http\Controllers;

use App\Models\SiteMenu;
use Illuminate\Http\Request;

class SiteMenuController extends Controller
{
    //
    public function index()
    {
        $siteMenus = SiteMenu::where('show_used', 1)->orderBy('id','asc')->latest()->get();

        return response()->json([
            'siteMenus' => $siteMenus
        ], 200);
    }
}
