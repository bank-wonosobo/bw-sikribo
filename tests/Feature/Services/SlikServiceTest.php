<?php

namespace Tests\Feature\Services;

use App\Http\Requests\Slik\StoreSlikReq;
use App\Models\HasilSlik;
use App\Models\PermohonanSlik;
use App\Models\Slik;
use App\Services\SlikService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SlikServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private SlikService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(SlikService::class);
    }

    public function test_enable_provider()
    {
        $this->assertTrue(true);
    }

    public function test_create_slik_all() {
        $permohonan_slik = PermohonanSlik::factory()->create();

        $request = new StoreSlikReq([
            'permohonan_slik_id' => $permohonan_slik->id,
            'nama' => ['nama1', 'nama2', 'nama3', 'nama4'],
            'nik' => ['nik1', 'nik2', 'nik3', 'nik4'],
            'identitas_slik' => ['identitas_slik1', 'identitas_slik2', 'identitas_slik3','identitas_slik4'],
        ]);

        $result = $this->service->create($request);

        $this->assertDatabaseCount('slik', 4);
    }

    public function test_create_slik_not_all() {
        $permohonan_slik = PermohonanSlik::factory()->create();

        $request = new StoreSlikReq([
            'permohonan_slik_id' => $permohonan_slik->id,
            'nama' => ['nama1', 'nama2', null, null],
            'nik' => ['nik1', 'nik2', null, null],
            'identitas_slik' => ['identitas_slik1', 'identitas_slik2', 'identitas_slik3','identitas_slik4'],
        ]);

        $result = $this->service->create($request);

        $this->assertDatabaseCount('slik', 2);

        $this->assertDatabaseHas('slik', [
            'nama' => 'nama1',
            'nik' => 'nik1',
            'permohonan_slik_id' => $permohonan_slik->id,
            'status' => 'PROSES',
        ]);
    }

    public function test_generate_no_ref_without_data() {
        $result = $this->service->generateNoRef();

        $this->assertSame('1/600557/VI/2024', $result['nomor_ref']);
    }

    public function test_generate_no_ref_with_data() {
        Slik::factory()->create(['no_ref_slik' => '1/600557/VI/2024']);

        $result = $this->service->generateNoRef();
        $this->assertSame('2/600557/VI/2024', $result['nomor_ref']);
    }

    public function test_generate_no_ref_with_data2() {
        Slik::factory()->create(['no_ref_slik' => '2/600557/VI/2024']);

        $result = $this->service->generateNoRef();
        $this->assertSame('3/600557/VI/2024', $result['nomor_ref']);
    }

    public function test_all_done() {
        $permohonan_slik = PermohonanSlik::factory()->create(['status'=> 'PROSES']);

        $jumlah_slik = 3;
        for ($i=0; $i < $jumlah_slik; $i++) {
            Slik::create( [
                'nama' => $this->faker->name,
                'nik' => $this->faker->name,
                'status' => 'SELESAI',
                'identitas_slik' => 'DEBITUR',
                'no_ref_slik' => 'xxx',
                'permohonan_slik_id' => $permohonan_slik->id,
            ]);
        }

        $slik = Slik::create([
            'nama' => $this->faker->name,
            'nik' => $this->faker->name,
            'status' => 'PROSES',
            'identitas_slik' => 'DEBITUR',
            'no_ref_slik' => 'xxx',
            'permohonan_slik_id' => $permohonan_slik->id,
        ]);

        $this->assertDatabaseCount('slik', $jumlah_slik + 1);
        $this->assertDatabaseCount('permohonan_slik', 1);
        $this->assertDatabaseHas('permohonan_slik', [
            'status' => 'PROSES'
        ]);
        $this->assertDatabaseHas('slik', [
            'status' => 'PROSES'
        ]);

        $this->service->done($slik->id);

        $this->assertDatabaseMissing('slik', [
            'status' => 'PROSES'
        ]);

        $this->assertDatabaseHas('permohonan_slik', [
            'status' => 'SELESAI'
        ]);

    }

    public function test_few_done() {
        $permohonan_slik = PermohonanSlik::factory()->create(['status'=> 'PROSES']);

        $jumlah_slik = 2;
        for ($i=0; $i < $jumlah_slik; $i++) {
            Slik::create( [
                'nama' => $this->faker->name,
                'nik' => $this->faker->name,
                'status' => 'SELESAI',
                'identitas_slik' => 'DEBITUR',
                'no_ref_slik' => 'xxx',
                'permohonan_slik_id' => $permohonan_slik->id,
            ]);
        }

        $slik = Slik::create([
            'nama' => $this->faker->name,
            'nik' => $this->faker->name,
            'status' => 'PROSES',
            'identitas_slik' => 'DEBITUR',
            'no_ref_slik' => 'xxx',
            'permohonan_slik_id' => $permohonan_slik->id,
        ]);

        $slik1 = Slik::create([
            'nama' => $this->faker->name,
            'nik' => $this->faker->name,
            'status' => 'PROSES',
            'identitas_slik' => 'DEBITUR',
            'no_ref_slik' => 'xxx',
            'permohonan_slik_id' => $permohonan_slik->id,
        ]);

        $this->assertDatabaseCount('slik', $jumlah_slik + 2);
        $this->assertDatabaseCount('permohonan_slik', 1);
        $this->assertDatabaseHas('permohonan_slik', [
            'status' => 'PROSES'
        ]);
        $this->assertDatabaseHas('slik', [
            'status' => 'PROSES'
        ]);

        $this->service->done($slik->id);

        $this->assertDatabaseHas('slik', [
            'status' => 'PROSES'
        ]);

        $this->assertDatabaseMissing('permohonan_slik', [
            'status' => 'SELESAI'
        ]);

    }

}
