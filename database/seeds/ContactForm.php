<?php

use Illuminate\Database\Seeder;

class ContactForm extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hp_contact_us')->insert([
            'email' => 'test@gmail.com',
        ]);
    }
}
