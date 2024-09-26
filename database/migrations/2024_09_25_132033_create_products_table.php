<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Colonne id
            $table->string('name'); // Colonne pour le nom du produit
            $table->decimal('price', 8, 2); // Colonne pour le prix
            $table->text('description')->nullable(); // Colonne pour la description, nullable
            $table->timestamps(); // Colonne pour created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

