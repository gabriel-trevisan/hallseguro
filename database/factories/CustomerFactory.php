<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Nonstandard\Uuid;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Uuid::uuid4(),
            'name' => $this->faker->name,
            'company_id' => 1,
            'voter' => Str::random(12),
            'rg' => Str::random(12),
            'work_card' => Str::random(13),
            'passport' => Str::random(8)
        ];
    }
}
