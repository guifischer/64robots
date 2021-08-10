<?php

namespace Database\Factories;

use App\Models\Family;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Family::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $husband = Person::factory()->create();
        $wife = Person::factory()->create();

        return [
            "husband_id" => $husband->id,
            "wife_id" => $wife->id,
        ];
    }
}
