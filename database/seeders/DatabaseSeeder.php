<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\Hash;
use Database\Seeders\AdminSeeder;
=======
>>>>>>> 6f7eed0abc486500d07b7cc398c5c840bd7c88a5

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

<<<<<<< HEAD
        $this->call(AdminSeeder::class);
        
=======
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
>>>>>>> 6f7eed0abc486500d07b7cc398c5c840bd7c88a5
    }
}
