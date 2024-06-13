<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->text('detalles');
            $table->integer('valor');
            $table->string('archivo');
            $table->unsignedBigInteger('idcliente');
            $table->foreign('idcliente')->references('id')->on('clientes');
            $table->unsignedBigInteger('idforma');
            $table->foreign('idforma')->references('id')->on('formasPago');
            $table->unsignedBigInteger('idestado');
            $table->foreign('idestado')->references('id')->on('estadosFacturas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
