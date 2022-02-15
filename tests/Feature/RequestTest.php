<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RequesetTest extends TestCase
{
    /** @test */
    public function get_all_users()
    {
        $response = $this->get('/api/user-list');
        $response->assertStatus(200);
        $this->assertEquals('success', $response['status']);
    }

    /** @test */
    public function get_all_projects()
    {
        $response = $this->get('/api/project-list');
        $response->assertStatus(200);
        $this->assertEquals('success', $response['status']);
    }

    /** @test */
    public function get_all_tools()
    {
        $response = $this->get('/api/tool-list');
        $response->assertStatus(200);
        $this->assertEquals('success', $response['status']);
    }

    /** @test */
    public function get_all_relevamientos()
    {
        $response = $this->get('/api/relevamiento-list');
        $response->assertStatus(200);
        $this->assertEquals('success', $response['status']);
    }

    /** @test */
    public function get_all_datas()
    {
        $response = $this->get('/api/data-list');
        $response->assertStatus(200);
        $this->assertEquals('success', $response['status']);
    }

    /** @test */
    public function get_all_countries()
    {
        $response = $this->get('/api/country-list');
        $response->assertStatus(200);
        $this->assertEquals('success', $response['status']);
    }

    /** @test */
    public function get_all_provinces()
    {
        $response = $this->get('/api/province-list');
        $response->assertStatus(200);
        $this->assertEquals('success', $response['status']);
    }

    /** @test */
    public function get_all_cities()
    {
        $response = $this->get('/api/city-list');
        $response->assertStatus(200);
        $this->assertEquals('success', $response['status']);
    }

    /** @test */
    public function get_all_tool_data()
    {
        $response = $this->get('/api/tool-data-list');
        $response->assertStatus(200);
        $this->assertEquals('success', $response['status']);
    }
    
    /** @test */
    public function get_all_data_answers()
    {
        $response = $this->get('/api/data-answer-list');
        $response->assertStatus(200);
        $this->assertEquals('success', $response['status']);
    }

    /** @test */
    public function get_all_answers()
    {
        $response = $this->get('/api/answer-list');
        $response->assertStatus(200);
        $this->assertEquals('success', $response['status']);
    }
}
