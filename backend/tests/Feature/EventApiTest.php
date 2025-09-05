<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_paginated_events()
    {
        Event::factory()->count(3)->create();
        $response = $this->getJson('/api/events');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                 ]);
    }
}
