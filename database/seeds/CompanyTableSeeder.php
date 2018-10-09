<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
                'user_id' => 2,
                'name' => 'Acme',
                'description' => '',
            ],
            [
                'user_id' => 2,
                'name' => 'The Human Fund',
                'description' => 'Money for people',
            ]
        ];
        DB::table('companies')->insert($companies);
    }
}
