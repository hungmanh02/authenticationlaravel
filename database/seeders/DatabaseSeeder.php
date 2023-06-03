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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $groupId=DB::table('groups')->insertGetId([
                'name' => 'Administrator',
                'user_id'=>'0',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        if($groupId>0){
            $userId=DB::table('users')->insertGetId([
            'name' => 'Đỗ Hùng Mạnh',
            'email'=>'domanh462@gmail.com',
            'phone'=>'0376971481',
            'password'=>Hash::make('123456789'),
            'group_id'=>$groupId,
            'user_id'=>0,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            if($userId>0){
                for($i=1;$i<=10;$i++){
                    DB::table('posts')->insert([
                        'title' => Str::random(10),
                        'description' => Str::random(100),
                        'content' => Str::random(1000),
                        'user_id' => $userId,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                    ]);
                }

            }

        }
        // for($i=1;$i<=100;$i++){
        //     DB::table('posts')->insert([
        //         'name' => Str::random(10),
        //         'description' => Str::random(100),
        //         'user_id' => 1,
        //     ]);
        // }

    }
}
