<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermohonanSlikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nomor' => $this->faker->name,
            'peruntukan_ideb' => $this->faker->name,
            'status' => 'Proses Pengajuan',
            'pemohon' => $this->faker->name,
        ];
    }
}
