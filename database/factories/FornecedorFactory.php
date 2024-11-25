<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornecedor>
 */
class FornecedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'documento' => $this->faker->numerify('##############'),
            'razao_social' => $this->faker->company,
            'telefone' => $this->faker->numerify('##########'),
            'cep' => $this->faker->numerify('########'),
            'natureza_juridica' => $this->faker->name,
            'situacao_cadastral' => 'ATIVA',
        ];
    }
}
