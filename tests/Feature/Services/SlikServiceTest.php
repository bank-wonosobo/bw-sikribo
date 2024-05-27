<?php

namespace Tests\Feature\Services;

use App\Http\Requests\Slik\StoreSlikReq;
use App\Models\PermohonanSlik;
use App\Models\Slik;
use App\Services\SlikService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SlikServiceTest extends TestCase
{
    use RefreshDatabase;

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

        $this->assertSame('1/600557/V/2024', $result['nomor_ref']);
    }

    public function test_generate_no_ref_with_data() {
        Slik::factory()->create(['no_ref_slik' => '1/600557/V/2024']);

        $result = $this->service->generateNoRef();
        $this->assertSame('2/600557/V/2024', $result['nomor_ref']);
    }

    public function test_generate_no_ref_with_data2() {
        Slik::factory()->create(['no_ref_slik' => '2/600557/V/2024']);

        $result = $this->service->generateNoRef();
        $this->assertSame('3/600557/V/2024', $result['nomor_ref']);
    }
}
