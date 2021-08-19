<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User as ModelUser;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    public function testStudentTest()
    {
        $user = factory(ModelUser::class)->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get('/students');

        $this->assertEquals(200, $response->status());
    }
}
