<?php

use LaravelForum\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = Channel::create([
            'name' => 'Angular 9',
            'slug' => str_slug('Angular 9')
        ]);

        Channel::create([
            'name' => 'Vue js 3',
            'slug' => str_slug('Vue js 3')
        ]);

        Channel::create([
            'name' => 'Laravel',
            'slug' => str_slug('Laravel')
        ]);

        Channel::create([
            'name' => 'Chatbot',
            'slug' => str_slug('Chatbot')
        ]);
    }
}
