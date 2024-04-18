<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_categories_return_a_successful_response(): void
    {
        $category = Category::factory()->create();
        $response = $this->get('/api/categories');
        dd($response);
        $response->assertStatus(200);
    }
}
