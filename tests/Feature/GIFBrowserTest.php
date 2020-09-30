<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GIFBrowserTest extends TestCase
{
    /**
     * Test GIF Engine Search.
     *
     * @return void
     */
    public function testSearchTest()
    {
        $response = $this->get('/api/search?query=hi&limit=2&offset=2', [
            'api-key' => env('API_KEY')
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test GIF Engine Trending.
     * @return void
     */

    public function testTrendingTest()
    {
        $response = $this->get('/api/trending?limit=2&offset=2', [
            'api-key' => env('API_KEY')
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test GIF Engine get GIF by id.
     */

    public function testGetGifByIdTest()
    {
        $response = $this->get('/api/get-gif/l4FB5yXHoVSheWQ5a', [
            'api-key' => env('API_KEY')
        ]);

        $response->assertStatus(200);
    }
}
