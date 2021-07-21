<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAddFilds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Table('users',function($table){
            $table->string('cpfcnpj');
            $table->char('sexo', 2);
            $table->string('celular');
            $table->string('celfixo');
            $table->dateTime('dnascimento');
            $table->string('escolaridade');
            $table->string('profissao');
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
