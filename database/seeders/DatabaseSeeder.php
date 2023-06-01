<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // DB::table('doctors')->insert([
        //     'name' => 'Hùng Mạnh',
        //     'email'=>'hungmanh@gmail.com',
        //     'password'=>Hash::make('123456'),
        //     'is_active'=>1
        // ]);
        for($i=1;$i<=100;$i++){
            DB::table('posts')->insert([
                'name' => Str::random(10),
                'description' => Str::random(100),
                'user_id' => 1,
            ]);
        }

    }
}
