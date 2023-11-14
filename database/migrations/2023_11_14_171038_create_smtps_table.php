<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smtps', function (Blueprint $table) {
            $table->id();
            $table->string('host', 255);
            $table->string('port', 255);
            $table->string('encryption', 255);
            $table->string('username', 255);
            $table->string('password', 255);
            $table->string('from_address', 255);
            $table->string('from_name', 255);
            $table->string('sender_email', 255);
            $table->string('sender_name', 255);
            $table->enum('status', ['active', 'inactive'])->default('inactive');
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
        Schema::dropIfExists('smtps');
    }
};
