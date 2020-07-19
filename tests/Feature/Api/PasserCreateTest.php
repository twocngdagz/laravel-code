<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PasserCreateTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_the_passer_on_successfully_creating_a_new_passer()
    {
        $data = [
            'passer' => [
                'name' => 'TOM CRUISE',
                'school' => 'MINDANAO STATE UNIVERSITY',
                'campus' => 'MAIN',
                'division' => 'ILIGAN CITY'
            ]
        ];

        $response = $this->postJson('/api/passers', $data);

        $response->assertStatus(200)
            ->assertJson([
                "passer" => [
                    'name' => 'TOM CRUISE',
                    'school' => 'MINDANAO STATE UNIVERSITY',
                    'campus' => 'MAIN',
                    'division' => 'ILIGAN CITY'
                ]
            ]);
    }

    /** @test */
    public function it_returns_appropriate_field_validation_errors_when_creating_a_new_article_with_invalid_inputs()
    {
        $data = [
            'loan' => [
                'name' => '',
                'school' => '',
                'campus' => '',
                'division' => '',
            ]
        ];

        $response = $this->postJson('/api/passers', $data);

        $response->assertStatus(422)
            ->assertJson([
                'name' => ['The name field is required.'],
                'school' => ['The school field is required.'],
                'campus' => ['The campus field is required.'],
                'division' => ['The division field is required.'],
            ]);
    }
}
