<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserFeild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('birthday')->default(\Carbon\Carbon::now());
            $table->string('avatar')->default('/public/images/test.png');
            $table->string('phone_number')->default('0123456789');
            $table->string('address')->default('0123456789');
            $table->tinyInteger('is_admin')->default(0);
            $table->string('api_token')->nullable();
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
