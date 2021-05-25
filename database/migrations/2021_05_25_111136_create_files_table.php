<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table -> string( 'type' );
            $table -> unsignedBigInteger( 'type_id' );
            $table -> unsignedBigInteger( 'size' ) -> nullable();
            $table -> string( 'path' ) -> nullable();
            $table -> string( 'url' ) -> nullable();
            $table -> string( 'absolute_url' ) -> nullable();
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
        Schema::dropIfExists('files');
    }
}
