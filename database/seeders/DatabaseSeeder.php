<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '0600000000',
            'usertype' => 'Admin'
        ]);

        // User::factory()->create([
        //     'name' => 'Maxwell',
        //     'email' => 'employee@example.com',
        //     'phone' => '0609876543',
        //     'usertype' => 'Employee'
        // ]);

        // User::factory()->create([
        //     'name' => 'Bingus',
        //     'email' => 'employee2@example.com',
        //     'phone' => '0609876542',
        //     'usertype' => 'Employee'
        // ]);

        // User::factory()->create([
        //     'name' => 'Fortune',
        //     'email' => 'employee3@example.com',
        //     'phone' => '0609876541',
        //     'usertype' => 'Employee'
        // ]);

        // User::factory()->create([
        //     'name' => 'Monke',
        //     'email' => 'customer@example.com',
        //     'phone' => '0612345678',
        //     'usertype' => 'Customer'
        // ]);

        // User::factory()->create([
        //     'name' => 'Harambe',
        //     'email' => 'customer2@example.com',
        //     'phone' => '0612345677',
        //     'usertype' => 'Customer'
        // ]);

        // User::factory()->create([
        //     'name' => 'Dodge',
        //     'email' => 'customer3@example.com',
        //     'phone' => '0612345676',
        //     'usertype' => 'Customer'
        // ]);

        // Product::factory()->create([
        //     'name' => 'Red One [Red]',
        //     'description' => 'Red One is a red product',
        // ]);

        // Product::factory()->create([
        //     'name' => 'Red One [Blue]',
        //     'description' => 'Red One is a blue product',
        // ]);

        // Product::factory()->create([
        //     'name' => 'Red One [Black]',
        //     'description' => 'Red One is a black product',
        // ]);

        // Appointment::factory()->create([
        //     'date' => now(),
        //     'time' => '09:00',
        //     'comment' => 'I would like to book an appointment for a haircut',
        //     'employee_id' => 2,
        //     'customer_id' => 5,
        //     'status' => 'Pending',
        // ]);

        // Appointment::factory()->create([
        //     'date' => now(),
        //     'time' => '11:00',
        //     'comment' => 'I would like to book an appointment for a haircut',
        //     'employee_id' => 3,
        //     'customer_id' => 6,
        //     'status' => 'Approved',
        // ]);

        // Appointment::factory()->create([
        //     'date' => now(),
        //     'time' => '13:00',
        //     'comment' => 'I would like to book an appointment for a haircut',
        //     'employee_id' => 4,
        //     'customer_id' => 7,
        //     'status' => 'Declined',
        // ]);
    }
}
