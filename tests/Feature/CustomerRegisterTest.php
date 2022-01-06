<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerRegisterTest extends TestCase
{
    /** @test */
    public function customer_register_fail()
    {
        $response = $this->post('/api/customer/register');

        $response->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => [
                        "The name field is required."
                    ],
                    "email" => [
                        "The email field is required."
                    ],
                    "password" => [
                        "The password field is required."
                    ]
                ]
            ]);
    }

    /** @test */
    public function customer_register_success()
    {
        $customer = [
            "name" => 'omar123',
            "email" => 'test123@test123.com',
            "password" => 'password',
            "password_confirmation" => 'password'
        ];
        $response = $this->post('/api/customer/register', $customer);

        $response->assertStatus(201)->assertJson([
            "message" => "your operation has been submitted successfully"
        ]);
    }
}
