<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User as ModelUser;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    use RefreshDatabase;

    public function testTeacherTest()
    {
        $user = factory(ModelUser::class)->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get('/teachers');

        $this->assertEquals(200, $response->status());
    }
}
