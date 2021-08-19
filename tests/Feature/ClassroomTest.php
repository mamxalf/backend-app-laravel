<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User as ModelUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClassroomTest extends TestCase
{
    use RefreshDatabase;

    public function testClasroomTest()
    {
        $user = factory(ModelUser::class)->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get('/classrooms');

        $this->assertEquals(200, $response->status());
    }
}
