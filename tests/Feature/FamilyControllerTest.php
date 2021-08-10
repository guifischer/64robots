<?php

namespace Tests\Feature;

use App\Models\Family;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FamilyControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    
    /**
     * @test
     * GET 'api/family'
     */
    public function get_families_list()
    {
        Family::factory()->count(2)->create();

        $response = $this->get('/api/family');

        $response->assertSuccessful();
        $response->assertJsonCount(2);
    }

    /**
     * @test
     * GET 'api/family/{id}'
     */
    public function get_specific_family()
    {
        $family = Family::factory()->create();
        $familyArray = Family::with(["husband", "wife", "children"])->find($family->id)->toArray();
        
        $url = '/api/family/'.$family->id;
        $response = $this->get($url);
        
        $response->assertSuccessful();
        $this->assertEquals($response->json(), $familyArray);
    }

    /**
     * @test
     * POST 'api/family'
     */
    public function create_new_family()
    {
        $people = Person::factory()->count(2)->create();
        $data = [
            "husband_id" => $people[0]->id
        ];
        
        $response = $this->postJson('/api/family', $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['wife_id']);

        $data["wife_id"] = $people[1]->id;
        $response = $this->postJson('/api/family', $data);
        $response->assertSuccessful();
    }

    /**
     * @test
     * PUT 'api/family/{id}'
     */
    public function update_family()
    {
        $family = Family::factory()->create();
        $person = Person::factory()->create();
        $data = [
            "husband_id" => $person->id,
            "wife_id" => $family->wife_id
        ];
        
        $url = '/api/family/'.$family->id;
        $response = $this->putJson($url, $data);
        
        $response->assertSuccessful();
    }
    
    /**
     * @test
     * PUT 'api/family/{id}'
     */
    public function delete_family()
    {
        $family = Family::factory()->create();
        
        $url = '/api/family/'.$family->id;
        $response = $this->delete($url);
        
        $response->assertSuccessful();
        $this->assertEmpty(Family::all());
    }
}
