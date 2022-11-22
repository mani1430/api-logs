<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiResponseLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_response_logs', function (Blueprint $table) {
            $table->id();
            $table->string('uu_id')->default(NUll)->nullable();
            $table->bigInteger('user_id')->default(NUll)->nullable();
            $table->string('ip_address')->default(NUll)->nullable();
            $table->string('browser')->default(NUll)->nullable();
            $table->string('api_type')->default(NUll)->nullable();
            $table->string('api_endpoint')->default(NUll)->nullable();
            $table->string('http_method')->default(NUll)->nullable();
            $table->string('full_url')->default(NUll)->nullable();
            $table->string('response_status')->default(NUll)->nullable();
            $table->longText('request_body')->default(NUll)->nullable();
            $table->longText('response_body')->default(NUll)->nullable();
            $table->longText('request_header')->default(NUll)->nullable();
            $table->longText('response_header')->default(NUll)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_response_logs');
    }
}
