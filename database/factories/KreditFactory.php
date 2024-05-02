<?php

namespace Database\Factories;

use App\Models\KategoriKredit;
use Illuminate\Database\Eloquent\Factories\Factory;

class KreditFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_kredit' => $this->faker->numberBetween(),
            'nama_peminjam' => $this->faker->name(),
            'tanggal_akad' => $this->faker->date(),
            'kategori_id' => KategoriKredit::factory()->create()->id,
            'file' => $this->faker->imageUrl()
        ];
    }
}
