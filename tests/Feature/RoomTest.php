<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User as ModelUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    public function testRoomTest()
    {
        $user = factory(ModelUser::class)->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get('/rooms');

        $this->assertEquals(200, $response->status());
    }
}
