<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Evaluation;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EvaluationTest extends TestCase
{
    /**
     * Test Empty Response
     *
     * @return void
     */
    public function test_get_evaluations_empty()
    {
        $response = $this->getJson('/evaluations/fake-company');

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /**
     * Get all Company Evaluations
     *
     * @return void
     */
    public function test_get_company_evaluations()
    {
        $company = (string) Str::uuid();
        $evaluations = Evaluation::factory()
                            ->count(6)
                            ->create([
                                'company' => $company
                            ]);

        $response = $this->getJson("/evaluations/{$company}");

        $response->assertStatus(200)
            ->assertJsonCount(6, 'data');
    }

    /**
     * Test Validations
     *
     * @return void
     */
    public function test_validation_store_evaluation()
    {
        $company = 'fake-company';

        $response = $this->postJson("/evaluations/{$company}", []);
        $response->assertStatus(422);   //Will fail validations
    }

    /**
     * Test Store
     *
     * @return void
     */
    public function test_store_evaluation()
    {
        $company = 'fake-company';

        $response = $this->postJson("/evaluations/{$company}", [
                            'company' => (string) Str::uuid(),             
                            'comment' => 'New Comment',
                            'stars' => 5,
                        ]);
        $response->assertStatus(404);   //Will return 404 because the company doesn't exist
    }
}
