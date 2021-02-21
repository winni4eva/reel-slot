<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Symbol;
use Illuminate\Database\Eloquent\Factories\Factory;

class SymbolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Symbol::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'campaign_id' => Campaign::first()->id,
            'image' => $this->faker->imageUrl(160, 120, 'animals'),
            'options' => [ 
                ['numberOfSymbols' => 3, 'weight' => 10],
                ['numberOfSymbols' => 4, 'weight' => 5],
                ['numberOfSymbols' => 5, 'weight' => 1],
            ]
        ];
    }
}
