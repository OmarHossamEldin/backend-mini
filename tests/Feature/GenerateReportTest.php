<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class GenerateReportTest extends TestCase
{
    /** @test */
    public function generate_report_fail_unauthorized()
    {
        $response = $this->post('/api/admin/reports');

        $response->assertStatus(401)->assertJson(["message" => "Unauthenticated."]);
    }

    /** @test */
    public function create_report_fail()
    {
        $token = User::FindOrFail(1)->createToken('admin-token')->plainTextToken;
        $response = $this->post(uri: '/api/admin/reports', headers: ['Authorization' => "Bearer ${token}"]);

        $response->assertStatus(422)->assertJson(
            [
                "message" => "The given data was invalid.",
                "errors" => [
                    "start_date" => [
                        "The start date field is required."
                    ],
                    "end_date" => [
                        "The end date field is required."
                    ]
                ]
            ]
        );
    }


    /** @test */
    public function generate_report_successfully()
    {
        $token = User::FindOrFail(1)->createToken('admin-token')->plainTextToken;
        $report = [
            "start_date" => "2022-1-4",
            "end_date" => "2022-2-4"
        ];

        $response = $this->post(uri: '/api/admin/reports', data: $report, headers: ['Authorization' => "Bearer ${token}"]);

        $response->assertStatus(200)->assertJsonCount(3);
    }
}
