<?php

use Illuminate\Database\Seeder;

class Setting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Language::create([
            'name' => 'en',
            'dir' => 'en',
            'select' => 1,
        ]);

        \App\Setting::create([
            'name' => 'name',
            'summary' => '',
            'language_id' => 1,
        ]);
    }
}
