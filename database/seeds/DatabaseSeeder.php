<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(SettingsSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(PartnersTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(EventPartnersTableSeeder::class);
        $this->call(UserSeeder::class);

        Model::reguard();
    }
}