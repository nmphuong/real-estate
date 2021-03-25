<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'passwords' => Hash::make('123456')
        ]);
    }
}
