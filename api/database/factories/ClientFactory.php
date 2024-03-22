<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    private static $sequence = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $doc = fake()->randomElement(['PJ', 'PF']);

        if ($doc === 'PJ') {
            $typeDoc = fake('pt_BR')->cnpj(false);
        } else {
            $typeDoc = fake('pt_BR')->cpf(false);
        }


        return [
            'recnum'       => self::$sequence++,
            'empresa'      => function () {
                return Company::factory()->create()->codigo;
            }, 
            'codigo'       => fake()->unique()->numberBetween(1000, 9999),
            'razao_social' => fake('pt_BR')->company(),
            'tipo'         => $doc,
            'cpf_cnpj'     => $typeDoc,
        ];
    }
}
