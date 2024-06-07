<?php

namespace Tests\Feature\Services;

use App\Models\HasilSlik;
use App\Services\HasilSlikService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HasilSlikServiceTest extends TestCase
{
    private HasilSlikService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(HasilSlikService::class);
    }

    public function test_routin_deletion(){
        HasilSlik::factory(20)->create();

        $this->assertDatabaseCount('hasil_slik', 20);

        $hasil_sliks = $this->service->routinDeletion();

        $this->assertDatabaseCount('hasil_slik', 0);

    }
}
