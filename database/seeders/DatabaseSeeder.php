<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use App\Models\Manager;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
        ]);
        \App\Models\User::factory(499)->create();
        \App\Models\Company::factory(500)->create();
        \App\Models\Branch::factory(500)->create();
        \App\Models\Manager::factory(500)->create();
        \App\Models\Employee::factory(500)->create();
        \App\Models\Vendor::factory(500)->create();
        \App\Models\ClassRoom::factory(500)->create();
        \App\Models\Course::factory(500)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        foreach (range(1, 500) as $i) {
            Manager::find($i)->update(['company_id' => $i]);
            Employee::find($i)->update(['user_id' => $i]);
        }
    }
}
