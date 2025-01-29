<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 1) Create the new column
            $table->string('user_type')->default('customer');

            

            // 3) Drop the old column
            $table->dropColumn('is_admin');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // In case of rollback, re-add is_admin and remove user_type
            $table->boolean('is_admin')->default(false);
            $table->dropColumn('user_type');
        });
    }
};
