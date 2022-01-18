<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerRegisterTest extends TestCase
{
    use WithFaker;
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
    public function customer_register_fail_unique_email()
    {
        $customer = [
            "name" => 'test',
            "email" => 'test@test.com',
            "password" => 'password',
            "password_confirmation" => 'password'
        ];
        $response = $this->post('/api/customer/register', $customer);

        $response->assertStatus(422)->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "email" => [
                    "The email has already been taken."
                ]
            ]
        ]);
    }

    /** @test */
    public function customer_register_success()
    {
        $customer = [
            "name" => $this->faker->name('male'),
            "email" =>  $this->faker->unique()->safeEmail,
            "password" => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
            "password_confirmation" => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ];
        $response = $this->post('/api/customer/register', $customer);

        $response->assertStatus(201)->assertJson([
            'message' => 'your operation has been submitted successfully'
        ]);
    }
}
