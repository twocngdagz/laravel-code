<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('campus');
            $table->string('school');
            $table->string('division');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE passers ADD FULLTEXT fulltext_index (name, school, division)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('passers');
    }
}
