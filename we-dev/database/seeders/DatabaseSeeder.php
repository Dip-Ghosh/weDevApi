<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'title' => 'What is Laravel',
            'price' =>12.35,
            'description' => 'Laravel is a PHP framework...'
        ]);
        DB::table('products')->insert([
            'title' => 'What is Laravel',
            'price' =>12.35,
            'description' => 'Laravel is a PHP framework...'
        ]);
        DB::table('products')->insert([
            'title' => 'What is Laravel',
            'price' =>12.35,
            'description' => 'Laravel is a PHP framework...'
        ]);
        DB::table('products')->insert([
            'title' => 'What is Laravel',
            'price' =>12.35,
            'description' => 'Laravel is a PHP framework...'
        ]);
        DB::table('products')->insert([
            'title' => 'What is Laravel',
            'price' =>12.35,
            'description' => 'Laravel is a PHP framework...'
        ]);   DB::table('products')->insert([
        'title' => 'What is Laravel',
        'price' =>12.35,
        'description' => 'Laravel is a PHP framework...'
    ]);   DB::table('products')->insert([
        'title' => 'What is Laravel',
        'price' =>12.35,
        'description' => 'Laravel is a PHP framework...'
    ]);
    }
}
