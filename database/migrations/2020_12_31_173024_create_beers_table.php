<?php

use App\Beer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeersTable extends Migration
{

    private function getFieldIfExists($dict, $field){
        if ( array_key_exists($field, $dict) ) {
            return $dict[$field];
        }

        return null;
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('style')->nullable();
            $table->string('category')->nullable();
            $table->string('brewer')->nullable();
            $table->string('country')->nullable();
            $table->string('www')->nullable();
            $table->decimal('alcohol', 4,2)->nullable();
            $table->decimal('lat', 10, 8)->default(0);
            $table->decimal('lon', 11, 8)->default(0);

            $table->timestamps();
        });

        $path = database_path('seeds/open-beer-database.json');
        $beers = json_decode(file_get_contents($path), true);

        foreach ($beers as $beer) {
            $fields = $beer['fields'];

            $b = new Beer();

            $b->name = $this->getFieldIfExists($fields, 'name');
            $b->description = $this->getFieldIfExists($fields, 'descript');
            $b->style = $this->getFieldIfExists($fields, 'style_name');
            $b->alcohol = $this->getFieldIfExists($fields, 'abv');
            $b->category = $this->getFieldIfExists($fields, 'cat_name');
            $b->brewer = $this->getFieldIfExists($fields, 'name_breweries');
            $b->country = $this->getFieldIfExists($fields, 'country');
            $b->www = $this->getFieldIfExists($fields, 'www');

            $coordinates = $this->getFieldIfExists($fields, 'coordinates');
            if($coordinates){
                $b->lat = $coordinates[0];
                $b->lon = $coordinates[1];
            }

            $b->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beers');
    }
}
