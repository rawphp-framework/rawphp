<?php

use \App\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Sample extends Migration
{

    public function up()
    {
        $this->schema->create('sample', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('sample');
    }

}
