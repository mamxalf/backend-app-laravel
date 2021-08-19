<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User as ModelUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function testHomeTest()
    {
        $user = factory(ModelUser::class)->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get('/home');

        $this->assertEquals(200, $response->status());
    }
}
