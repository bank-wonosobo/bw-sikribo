<?php

namespace Tests\Feature\Services;

use App\Exceptions\KodeSLIKNotSet;
use App\Exceptions\KodeSLIKNotSetException;
use App\Http\Requests\PermohonanSlik\StorePermohohonanSlikReq;
use App\Models\KodeSlik;
use App\Services\PermohonanSlikService;
use App\Traits\NumberToRoman;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

class PermohonanSlikServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase, NumberToRoman;

    private PermohonanSlikService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(PermohonanSlikService::class);
    }

    public function test_enable_provider()
    {
        assertTrue(true);
    }

    // public function test_generate_nomor()
    // {
    //     $nomor = $this->service->generateNomorPengajuan(10, 'GRG');

    //     assertSame('10/600557/GRG/V/2024', $nomor);
    // }

    public function test_create_not_set_codeslik() {
        $this->expectException(KodeSLIKNotSetException::class);

        $request = new StorePermohohonanSlikReq([
            'peruntukan_ideb' => 'pengajuan'
        ]);

        $this->service->create($request, '1', 'test');
    }

    public function test_create_success() {
        KodeSlik::factory()->create([
            'user_id' => '1',
            'kode' => 'GRG'
        ]);

        $request = new StorePermohohonanSlikReq([
            'peruntukan_ideb' => 'pengajuan'
        ]);

        $this->service->create($request, '1', 'test');

        $this->assertDatabaseCount('permohonan_slik', 1);
        $this->assertDatabaseHas('permohonan_slik', [
            'nomor' => '1/600557/GRG/VI/2024'
        ]);

        $this->service->create($request, '1', 'test');

        $this->assertDatabaseHas('permohonan_slik', [
            'nomor' => '2/600557/GRG/VI/2024'
        ]);

    }

}
