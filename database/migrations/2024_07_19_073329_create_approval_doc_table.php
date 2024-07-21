<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('approval_doc', function (Blueprint $table) {
            $table->id('doc_idx');
            
            $table->string('doc_key')->unique();
            $table->json('doc_line_data');
            $table->json('doc_refinfo_list');
            
            $table->unsignedBigInteger('doc_form_idx');
            $table->string('doc_form_key');
            $table->string('doc_form_title');
            $table->json('doc_form_data');
            $table->json('doc_form_layout_data')->nullable();
            $table->json('doc_form_extend_data')->nullable();
            
            $table->json('doc_official_data')->nullable();
            $table->string('doc_official_data1')->nullable();
            $table->string('doc_official_data2')->nullable();

            $table->unsignedTinyInteger('doc_number_type')->default(0);
            $table->string('doc_number')->nullable();
            
            $table->unsignedTinyInteger('doc_screen_out')->default(5);
            $table->unsignedTinyInteger('doc_open_used')->default(0);

            $table->string('doc_open_type')->default('N');
            $table->string('doc_report_type')->default('N');
            $table->string('doc_report_date')->nullable()->default('N');

            $table->string('doc_erp_code')->nullable();
            
            $table->string('doc_type')->default('A');
            $table->string('doc_title');
            $table->longText('doc_content')->nullable();

            $table->unsignedTinyInteger('doc_status')->default(0);
            $table->unsignedTinyInteger('doc_hold')->default(0);
            

            
            $table->unsignedTinyInteger('doc_finish_flag')->default(0);
            $table->datetime('doc_finish_at')->nullable();
            
            $table->datetime('doc_withdraw_at')->nullable();
            
            $table->unsignedTinyInteger('doc_reject_view_flag')->nullable()->default(0);
            $table->datetime('doc_reject_date')->nullable();

            $table->unsignedTinyInteger('doc_re_submit_flag')->default(0);

            $table->text('doc_process_last_msg')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_doc');
    }
};
