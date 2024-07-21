<?php

namespace Database\Seeders;

use App\Models\SiteMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SiteMenu::factory()->create([
            'code'          => "cug",
            'title'         => '고객업무지원',
            'stitle'        => '',
            'url'           => '',
            'used'          => 1,
            'show_used'     => 1,
            'left_title'    => 0,
            'global_bar'    => 1,

            'content_div'   => 0,
            'content_title' => 0,
            'menu_toggle'   => 0,
            'show_toggle'   => 0,

            'level_check'    => 0,
            'local_level'    => 0,
            'user_level'   => 0,
            'left_menus'    => null,
			'created_at' => now(),
			'updated_at' => now()
        ]);
        
        SiteMenu::factory()->create([
            'code'          => 'company',
            'title'         => '업체관리',
            'stitle'         => '',
            'url'           => '',
            'used'          => 1,
            'show_used'     => 1,
            'left_title'    => 1,
            'global_bar'    => 1,

            'content_div'   => 0,
            'content_title' => 0,
            'menu_toggle'   => 0,
            'show_toggle'   => 0,

            'level_check'    => 0,
            'local_level'    => 0,
            'user_level'   => 0,
            'left_menus'    => null,
			'created_at' => now(),
			'updated_at' => now()
        ]);
        
        SiteMenu::factory()->create([
            'code'          => 'approval',
            'title'         => '전자결재',
            'stitle'         => '',
            'url'           => '',
            'used'          => 1,
            'show_used'     => 1,
            'left_title'    => 1,
            'global_bar'    => 0,

            'content_div'   => 0,
            'content_title' => 0,
            'menu_toggle'   => 0,
            'show_toggle'   => 0,

            'level_check'    => 1,
            'local_level'    => 1,
            'user_level'   => 0,
            'left_menus'    => json_encode([
				'approval' => [
                    'id'=>'appr','title'=>'전자결재','menuToggle'=>1,'showToggle'=>1,'smenu'=>
                    [
                        'stand'		=> ['id'=>'approval_list_stand','type'=>'link','title'=>'결재대기함','stitle'=>'결재대기함','link'=>'/index.php/approval/list/stand','target'=>'_self','code'=>'stand','cnt'=>1],
                        'ing'		=> ['id'=>'approval_list_ing','type'=>'link','title'=>'결재진행함','link'=>'/index.php/approval/list/ing','target'=>'_self','code'=>'ing','cnt'=>1],
                        'finish'	=> ['id'=>'approval_list_finish','type'=>'link','title'=>'완료문서함','link'=>'/index.php/approval/list/finish','target'=>'_self','code'=>'finish','cnt'=>0],
                        'reject'	=> ['id'=>'approval_list_reject','type'=>'link','title'=>'반려문서함','link'=>'/index.php/approval/list/reject','target'=>'_self','code'=>'reject','cnt'=>1],
                        'reference'	=> ['id'=>'approval_list_reference','type'=>'link','title'=>'참조/열람문서함','link'=>'/index.php/approval/list/reference','target'=>'_self','code'=>'reference','cnt'=>1]
                    ]
                ],
				'myAppr' => ['id'=>'myAppr','title'=>'개인문서함','menuToggle'=>1,'showToggle'=>1,'smenu'=>[
					'myRequest'	=> ['id'=>'approval_list_myRequest','type'=>'link','title'=>'결재요청함','link'=>'/index.php/approval/list/myRequest','target'=>'_self','code'=>'myRequest','cnt'=>0],
					'temp'		=> ['id'=>'approval_list_temp','type'=>'link','title'=>'임시문서함','link'=>'/index.php/approval/list/temp','target'=>'_self','code'=>'temp','cnt'=>1]
				]],
				'setup' => [
                    'id'=>'setup','title'=>'환경설정','menuToggle'=>1,'showToggle'=>1,'smenu'=>[
					    'mySetup'	=> ['id'=>'mySetup','type'=>'link','title'=>'개인설정','link'=>'/index.php/approval/mySetup','target'=>'_self','code'=>'mySetup','cnt'=>0]
                    ]
                ],
				'admin' => [
                    'id'=>'admin','mnLevel'=>'99','isAdmin'=>1,'title'=>'관리자 메뉴','menuToggle'=>1,'showToggle'=>1,'smenu'=>[
					    'apprConfig'	=> ['id'=>'apprConfig','type'=>'link','title'=>'전자결재설정','link'=>'/index.php/approval/apprConfig','target'=>'_self','code'=>'config','cnt'=>0],
					    'apprAdminLine'	=> ['id'=>'apprAdminLine','type'=>'link','title'=>'결재선관리','link'=>'/index.php/approval/apprAdminLine','target'=>'_self','code'=>'apprAdminLine','cnt'=>0],
					    'apprAdminForm'	=> ['id'=>'apprAdminForm','type'=>'link','title'=>'양식관리','link'=>'/index.php/approval/apprAdminForm','target'=>'_self','code'=>'apprAdminForm','cnt'=>0]
                    ]
                ]
            ], true),
			'created_at' => now(),
			'updated_at' => now()
        ]);
        
        SiteMenu::factory()->create([
            'code'          => 'diary',
            'title'         => '업무일지',
            'stitle'         => '',
            'url'           => '',
            'used'          => 1,
            'show_used'     => 1,
            'left_title'    => 1,
            'global_bar'    => 0,

            'content_div'   => 0,
            'content_title' => 0,
            'menu_toggle'   => 0,
            'show_toggle'   => 0,

            'level_check'    => 1,
            'local_level'    => 1,
            'user_level'   => 0,
            'left_menus'    => json_encode([
				'diary' => [
                    'id'=>'todo1',
                    'title'=>'To-Do',
                    'menuToggle'=>1,
                    'showToggle'=>1,
                    'smenu'=>[
                        ['id'=>'todo_01','type'=>'link','title'=>'전체 업무일지','link'=>'/index.php/diary','target'=>'_self'],
                        ['id'=>'todo_01','type'=>'link','title'=>'개인별 업무일지','link'=>'/index.php/diary#mydiary','target'=>'_self']
                    ]
                ]
            ], true),
			'created_at' => now(),
			'updated_at' => now()
        ]);
        
        SiteMenu::factory()->create([
            'code'          => 'schedule',
            'title'         => '일정관리',
            'stitle'         => '',
            'url'           => '',
            'used'          => 1,
            'show_used'     => 1,
            'left_title'    => 1,
            'global_bar'    => 0,

            'content_div'   => 0,
            'content_title' => 0,
            'menu_toggle'   => 0,
            'show_toggle'   => 0,

            'level_check'    => 1,
            'local_level'    => 1,
            'user_level'   => 0,
            'left_menus'    => null,
			'created_at' => now(),
			'updated_at' => now()
        ]);
        
        SiteMenu::factory()->create([
            'code'          => 'products',
            'title'         => 'products',
            'stitle'         => '',
            'url'           => '',
            'used'          => 1,
            'show_used'     => 1,
            'left_title'    => 1,
            'global_bar'    => 0,

            'content_div'   => 0,
            'content_title' => 0,
            'menu_toggle'   => 0,
            'show_toggle'   => 0,

            'level_check'    => 1,
            'local_level'    => 1,
            'user_level'   => 0,
            'left_menus'    => null,
			'created_at' => now(),
			'updated_at' => now()
        ]);
    }
}
