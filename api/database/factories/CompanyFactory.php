<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {  
        $company = fake('pt_BR')->company();
        $arr = explode(' ', $company);
        $firstLetters = '';

        if (count($arr) > 1) { 
            foreach ($arr as $value) {
                $firstLetters .= substr($value, 0, 1);
            }
        } else {
            $firstLetters = substr($company, 0, 1);
        }

        return [
            'codigo'       => fake()->unique()->numberBetween(1000, 9999),
            'empresa'      => fake()->unique()->numberBetween(1000, 9999),
            'sigla'        => $firstLetters,
            'razao_social' => $company,
        ];
    }
}
