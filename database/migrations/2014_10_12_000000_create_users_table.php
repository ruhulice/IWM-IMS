<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('user_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_admin')->default(1);
            $table->string('password');
            $table->rememberToken();
            $table->string('code')->nullable();
            $table->integer('role_id')->default(1);
            $table->string('user_photo')->nullable();
            $table->dateTime('last_login_time')->useCurrent();
            $table->string('last_login_ip')->nullable();
            $table->boolean('is_active')->default(1);
            $table->integer('status_id')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('users');
    }
}
