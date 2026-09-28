<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        // 1. إضافة زبائن تجريبيين
        Customer::create(['name' => 'علي عباس', 'phone' => '0911111111']);
        Customer::create(['name' => 'محمد أحمد', 'phone' => '0922222222']);

        // 2. إضافة رحلة عادية (دمشق -> اللاذقية)
        Trip::create([
            'trip_number'    => 'TR-101',
            'origin'         => 'دمشق',
            'destination'    => 'اللاذقية',
            'departure_time' => now()->addDays(2),
            'base_price'     => 50000.00,
            'total_seats'    => 40,
            'type'           => 'standard',
        ]);

        // 3. إضافة رحلة VIP (دمشق -> حلب)
        Trip::create([
            'trip_number'    => 'TR-VIP-202',
            'origin'         => 'دمشق',
            'destination'    => 'حلب',
            'departure_time' => now()->addDays(3),
            'base_price'     => 100000.00,
            'total_seats'    => 30,
            'type'           => 'vip',
        ]);
    }
}
