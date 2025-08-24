<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // nom et prénom / nom entreprise
            $table->date('birth_date')->nullable();    // date de naissance (clients)
            $table->string('email')->unique();
            $table->string('phone')->nullable();       // numéro téléphone
            $table->string('company_name')->nullable(); // nom entreprise (pros)
            $table->date('creation_date')->nullable(); // date création entreprise (pros)
            $table->string('password');
            $table->enum('role', ['admin', 'client', 'pro'])->default('client');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
