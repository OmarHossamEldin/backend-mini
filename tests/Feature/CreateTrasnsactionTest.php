<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use stdClass;

class CreateTransactionTest extends TestCase
{
    /** @test */
    public function create_transaction_fail_unauthorized()
    {
        $response = $this->post('/api/admin/transactions');

        $response->assertStatus(401)->assertJson(["message" => "Unauthenticated."]);
    }

    /** @test */
    public function create_transaction_fail()
    {
        $token = User::FindOrFail(1)->createToken('admin-token')->plainTextToken;
        $response = $this->post(uri: '/api/admin/transactions', headers: ['Authorization' => "Bearer ${token}"]);

        $response->assertStatus(422)->assertJson(
            [
                "message" => "The given data was invalid.",
                "errors" => [
                    "category_id" => [
                        "The category id field is required."
                    ],
                    "amount" => [
                        "The amount field is required."
                    ],
                    "customer_id" => [
                        "The customer id field is required."
                    ],
                    "due_on" => [
                        "The due on field is required."
                    ],
                    "vat" => [
                        "The vat field is required."
                    ],
                    "is_vat_inclusive" => [
                        "The is vat inclusive field is required."
                    ]
                ]
            ]
        );
    }

    /** @test */
    public function create_overdue_transaction__successfully()
    {
        $token = User::FindOrFail(1)->createToken('admin-token')->plainTextToken;
        $transaction = [
            "category_id" => 1,
            "subcategory_id" => 2,
            "amount" => 100,
            "customer_id" => 2,
            "due_on" => "2022-1-4",
            "vat" => 50.00,
            "is_vat_inclusive" => 0.2,
            "status" => "paid",
            "paid" => 50
        ];

        $response = $this->post(uri: '/api/admin/transactions', data: $transaction, headers: ['Authorization' => "Bearer ${token}"]);

        $response->assertStatus(201)->assertJson([
            'message' => 'overdue transaction has been saved'
        ]);
    }

    /** @test */
    public function create_paid_transaction__successfully()
    {
        $token = User::FindOrFail(1)->createToken('admin-token')->plainTextToken;
        $transaction = [
            "category_id" => 1,
            "subcategory_id" => 2,
            "amount" => 100,
            "customer_id" => 2,
            "due_on" => "2022-1-4",
            "vat" => 50.00,
            "is_vat_inclusive" => 0.2,
            "status" => "paid",
            "paid" => 100
        ];

        $response = $this->post(uri: '/api/admin/transactions', data: $transaction, headers: ['Authorization' => "Bearer ${token}"]);

        $response->assertStatus(201)->assertJson([
            'message' => 'paid transaction has been saved'
        ]);
    }
}
