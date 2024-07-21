<?php

namespace Database\Seeders;

use App\Models\Approval\Approval;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Approval::factory()->count(100)->create();
            
        // Approval::factory()->create([
        //     'doc_key'               => Str::random(10),
        //     'doc_line_data'         => '[]',
        //     'doc_refinfo_list'      => '[]',
        //     'doc_form_idx'          => 1,
        //     'doc_form_key'          => '11111',
        //     'doc_form_title'        => '폼 양식명',
        //     'doc_form_data'         => '[]',
        //     'doc_form_layout_data'  => '[]',
        //     'doc_form_extend_data'  => '[]',

        //     'doc_number_type'       => 0,

        //     'doc_title'             => '결재문서 제목 2',
        //     'doc_content'           => '결재문서 내용 2'
        // ]);
        
        // Approval::factory()->create([
        //     'doc_key'               => Str::random(10),
        //     'doc_line_data'         => '[]',
        //     'doc_refinfo_list'      => '[]',
        //     'doc_form_idx'          => 1,
        //     'doc_form_key'          => '11111',
        //     'doc_form_title'        => '폼 양식명',
        //     'doc_form_data'         => '[]',
        //     'doc_form_layout_data'  => '[]',
        //     'doc_form_extend_data'  => '[]',

        //     'doc_number_type'       => 0,

        //     'doc_title'             => '결재문서 제목 2',
        //     'doc_content'           => '결재문서 내용 2'
        // ]);
        
        // Approval::factory()->create([
        //     'doc_key'               => Str::random(10),
        //     'doc_line_data'         => '[]',
        //     'doc_refinfo_list'      => '[]',
        //     'doc_form_idx'          => 1,
        //     'doc_form_key'          => '11111',
        //     'doc_form_title'        => '폼 양식명',
        //     'doc_form_data'         => '[]',
        //     'doc_form_layout_data'  => '[]',
        //     'doc_form_extend_data'  => '[]',

        //     'doc_number_type'       => 0,

        //     'doc_title'             => '결재문서 제목 3',
        //     'doc_content'           => '결재문서 내용 3'
        // ]);
        
            
    }
}
