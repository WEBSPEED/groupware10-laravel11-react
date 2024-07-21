<?php

namespace Database\Factories\Approval;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Approval\Approval>
 */
class ApprovalFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'doc_key'               => Str::random(10),
            'doc_line_data'         => '[]',
            'doc_refinfo_list'      => '[]',
            'doc_form_idx'          => 1,
            'doc_form_key'          => '11111',
            'doc_form_title'        => '폼 양식명',
            'doc_form_data'         => '[]',
            'doc_form_layout_data'  => '[]',
            'doc_form_extend_data'  => '[]',

            'doc_number_type'       => 0,

            'doc_title'             => '결재문서 제목 ' . random_int(3, 10),
            'doc_content'           => '결재문서 내용 ' . random_int(3, 10),

            'doc_status'            => random_int(0, 4)
        ];
    }

}
