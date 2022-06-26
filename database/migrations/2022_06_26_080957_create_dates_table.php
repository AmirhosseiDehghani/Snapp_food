<?php

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
        $Week=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday',];
        
        Schema::create('dates', function (Blueprint $table) use($Week) {
            $table->id();
            foreach ($Week as  $day) {
                $table->time($day.'_S');
                $table->time($day.'_E');
                $table->boolean($day.'_isActive')->default(1);
            }
            $table->foreignIdFor(Restaurant::class)->constrained();
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
        Schema::dropIfExists('dates');
    }
};
