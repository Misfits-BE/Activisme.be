<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Standaard seed voor de nieuwsberichten hun categorieen. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Database table data 
        $data = [
            // TEMPLATE = ['slug' => '', 'name' => '', 'description' => ''],
            ['slug' => 'manifestaties', 'name' => 'Manifestaties', 'description' => 'Nieuws berichten omtrent manifestaties.'],
            ['slug' => 'mobiel-kapsalon', 'name' => 'Mobiel kapsalon', 'description' => 'Nieusberichten omtrent ons mobiel kapsalon.'], 
            ['slug' => 'bck', 'name' => 'BCK', 'description' => 'Nieuwsberichten omtrent het BCK.'], 
            ['slug' => 'bck', 'name' => 'Belgische coalitie tegen kernwapens', 'description' => 'Nieuwsberichten omtrent het BCK.'], 
            ['slug' => 'armoedebestrijding', 'name' => 'Armoedebestrijding', 'description' => 'Nieuwsberichten omtrent armoede bestrijding.'], 
            ['slug' => 'evenementen', 'name' => 'Evenementen', 'description' => 'Nieuws berichten omtrent onze evenementen.'], 
            ['slug' => 'vzw', 'name' => 'VZW', 'description' => 'Nieuws berichten omtrent de VZW.'], 
            ['slug' => 'sponsering', 'name' => 'Sponsering', 'description' => 'Nieuws berichten omtrent sponsering.'], 
            ['slug' => 'andere', 'name' => 'Andere', 'description' => 'Nieuwsberichten die niet geplaatst kunnen worden onder de andere cats.'],
            ['slug' => 'andere', 'name' => 'Andere', 'description' => 'Nieuwsberichten die niet geplaatst kunnen worden onder de andere categorieen.'],
            ['slug' => 'acties-en-petities', 'name' => 'Petities en acties', 'description' => 'Nieuws berichten omtrent acties en petities.'],
        ];

        // Database table operations. 
        $table = DB::table('tags');
        $table->delete(); 
        $table->insert($data);
    }
}
