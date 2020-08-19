<?php

use \App\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class NewSampleTable extends Migration
{

    public function up()
    {
        $this->schema->create('new_sample', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('new_sample');
    }

}
