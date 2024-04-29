<?php

namespace Tests\Feature\Services;

use App\Http\Requests\Kredit\StoreKreditReq;
use App\Models\KategoriKredit;
use App\Services\KreditService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KreditServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private KreditService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(KreditService::class);
    }

    public function test_enable_provider()
    {
        $this->assertTrue(true);
    }

    public function test_create_kredit_success() {
        $kategorikredit = KategoriKredit::factory()->create();

        $request = new StoreKreditReq([
            'no_kredit' =>'test',
            'nama_peminjam' => 'test',
            'kategori_id' => $kategorikredit->id,
            'tanggal_akad' => '2019-05-30',
        ]);

        $this->service->create($request);

        $this->assertDatabaseCount('kredit', 1);
        $this->assertDatabaseHas('kredit', [
            'no_kredit' =>'test',
            'nama_peminjam' => 'test',
            'kategori_id' => $kategorikredit->id,
            'tanggal_akad' => '2019-05-30',
        ]);

    }
}
