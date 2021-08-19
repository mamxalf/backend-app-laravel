<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User as ModelUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    public function testScheduleTest()
    {
        $user = factory(ModelUser::class)->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get('/schedules');

        $this->assertEquals(200, $response->status());
    }
}
