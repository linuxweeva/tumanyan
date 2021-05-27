<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table -> string( 'title_am' );
            $table -> string( 'title_ru' ) -> default('');
            $table -> string( 'title_en' ) -> default('');
            $table -> unsignedBigInteger( 'author_id' );
            $table -> unsignedBigInteger( 'section_id' );
            $table -> string( 'publish_info_am' );
            $table -> string( 'publish_info_ru' ) -> default('');
            $table -> string( 'publish_info_en' ) -> default('');
            $table -> unsignedBigInteger( 'language_id' );
            $table -> unsignedBigInteger( 'type_id' );
            $table -> unsignedBigInteger( 'price' ) -> default( 0 );
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
