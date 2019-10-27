<?php

use Illuminate\Database\Seeder;
use App\Pigeon;

class PigeonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // And now let's generate a few dozen pigeons for our app:
        Pigeon::create([
            'name' => 'Antonio',
            'speed' => '70',
            'range' => '600',
            'cost' => '2',
            'downtime' => '2',
            'status' => '0',
        ]);
        Pigeon::create([
            'name' => 'Bonito',
            'speed' => '80',
            'range' => '500',
            'cost' => '2',
            'downtime' => '3',
            'status' => '0',
        ]);
        Pigeon::create([
            'name' => 'Carillo',
            'speed' => '65',
            'range' => '1000',
            'cost' => '2',
            'downtime' => '3',
            'status' => '0',
        ]);
        Pigeon::create([
            'name' => 'Alejandro',
            'speed' => '70',
            'range' => '800',
            'cost' => '2',
            'downtime' => '2',
            'status' => '0',
        ]);
        Pigeon::create([
            'name' => 'Pigeon With Jetpack',
            'speed' => '700',
            'range' => '6000',
            'cost' => '18',
            'downtime' => '10',
            'status' => '0',
        ]);

    }
}
