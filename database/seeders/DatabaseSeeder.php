<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\StatusEvent;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create([
           'name_role' => 'Admin'
        ]);

        Role::create([
            'name_role' => 'User'
        ]);

        User::create([
            'role_id' => 1,
            'name' => 'pratama',
            'email' => 'Pratama01@gmail.com',
            'password' => bcrypt("pratama")
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'user',
            'email' => 'User01@gmail.com',
            'password' => bcrypt("user")
        ]);

        StatusEvent::create([
            'name_status' => 'Approve'
        ]);

        StatusEvent::create([
            'name_status' => 'Pending'
        ]);

        StatusEvent::create([
            'name_status' => 'Rejected'
        ]);
    }
}
