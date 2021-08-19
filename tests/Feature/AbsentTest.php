<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User as ModelUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AbsentTest extends TestCase
{
    use RefreshDatabase;

    public function testAbsentTest()
    {
        $user = factory(ModelUser::class)->create(['role' => 'teacher']);

        $response = $this->actingAs($user)->get('/start-absent');

        $this->assertEquals(200, $response->status());
    }
}
