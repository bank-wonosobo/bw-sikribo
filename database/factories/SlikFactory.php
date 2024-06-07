<?php

namespace Database\Factories;

use App\Models\PermohonanSlik;
use Illuminate\Database\Eloquent\Factories\Factory;

class SlikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'nik' => $this->faker->name,
            'status' => 'ADA',
            'identitas_slik' => 'DEBITUR',
            'no_ref_slik' => 'xxx',
            'permohonan_slik_id' => null ?? PermohonanSlik::factory()->create()->id,
        ];
    }
}
