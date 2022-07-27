<?php

use App\Models\Discounts;
use App\Models\Restaurant;
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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->boolean('is_foodparty')->default(false);
            $table->foreignIdFor(Discounts::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Restaurant::class)->constrained();
            $table->string('make_of')->nullable();
            $table->float('score',3,2)->default(0.00);
            $table->integer('count')->default(0);
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
        Schema::dropIfExists('food');
    }
};
