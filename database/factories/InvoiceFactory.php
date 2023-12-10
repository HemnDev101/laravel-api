<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        $status = $this->faker->randomElement(['B' , 'P' , 'V']) ;  php
        $status =  fake()->randomElement(['B' , 'P' , 'V']) ;  //laravel
        return [

            'customer_id' => Customer::factory() ,
            'amount' => fake()->numberBetween(100,20000) ,
            'status' => fake()->randomElement(['B' , 'P' , 'V']) ,
            'billed_date' => fake('en_US')->dateTimeThisDecade() ,
            'paid_date' => $status == 'P' ? fake()->dateTimeThisDecade()  : NULL,

        ];
    }
}
