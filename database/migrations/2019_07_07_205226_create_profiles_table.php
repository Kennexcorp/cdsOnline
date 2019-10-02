<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('group_id')->nullable()->default(null);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dob')->nullable()->default(null);
            $table->string('ppa')->nullable()->default(null);
            $table->string('avatar')->nullable()->default(null);
            $table->string('state_code')->nullable()->default(null);
            $table->string('state');
            $table->string('lga');
            $table->string('phone_number');
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
        Schema::dropIfExists('profiles');
    }
}
