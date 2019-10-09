<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
                [
                    'HoTen' => 'Hỗ trợ',
                    'username' => 'hotro',
					'password' => '$10$i/.VtYHYyFQMYtJf2vd.LeXHhvMvUBb9I0uisP9GghzNppsejIQtK'
                ]
        );
    }
}
