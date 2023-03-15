<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\customers>
 */
class customersFactory extends Factory
{
     /**
    * Define the model's default state.
    *
    * @return array<string, mixed>
    */
   public function definition(): array
   {
       return [
           'name' => fake()->name(),
           'address' => fake()->address(),
           'username' => fake()->unique()->safeEmail(),
           'password' =>Hash::make('welcome'),
           'balance' => rand(1,9).rand(0,9).rand(0,9).rand(0,9),
       ];
   }
}
