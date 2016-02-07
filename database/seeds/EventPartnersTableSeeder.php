<?php

use Illuminate\Database\Seeder;

use App\Event;
use App\Partner;

class EventPartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 3; $i++) {
        	$partner = Partner::find( $i );
        	$event = Event::find(1);

        	$event->partners()->save($partner);
        }
    }
}
