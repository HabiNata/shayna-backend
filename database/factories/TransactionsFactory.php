<?php

namespace Database\Factories;

use App\Models\Transactions;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transactions::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid'                  =>  $this->faker->uuid(),
            'name'                  =>  $this->faker->name(),
            'email'                 =>  $this->faker->email(),
            'number'                =>  $this->faker->phoneNumber(),
            'address'               =>  $this->faker->address(),
            'transaction_total'     =>  rand(20000, 500000),
            'transaction_status'    =>  '',
        ];
    }
}
