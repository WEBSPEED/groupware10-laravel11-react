<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SiteMenu extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    
    protected $table = 'site_menus';
    
    protected $guarded = [
    ];
    
    public function getSiteMenu()
    {
        return SiteMenu::where('used', '1')
            ->where('show_used', '1')
            // ->where(function ($query1) {
            //     $query1->where('level_check', '0')
            //         ->orWhere(function ($query2) {
            //             $query2->where('level_check', '1');
            //                 ->where('local_level', Auth::user()->local_user);
            //         });
            // })
            // ->where('user_level', '<=', Auth::user()->level)
            ->orderBy('id','asc')
            ->get();
    }

}
