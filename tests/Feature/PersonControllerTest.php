<?php

namespace Tests\Feature;

use App\Models\Family;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    
    /**
     * @test
     * GET 'api/person'
     */
    public function get_people_list()
    {
        Person::factory()->count(3)->create();

        $response = $this->get('/api/person');

        $response->assertSuccessful();
        $response->assertJsonCount(3);
    }

    /**
     * @test
     * GET 'api/person/{id}'
     */
    public function get_specific_person()
    {
        $person = Person::factory()->create();

        $url = '/api/person/'.$person->id;
        $response = $this->get($url);
        
        $response->assertSuccessful();

        $personFromResponse = $response->json();
        $this->assertEquals($personFromResponse["firstnames"], $person->firstnames);
    }

    /**
     * @test
     * POST 'api/person'
     */
    public function create_new_person()
    {
        $wrongPersonData = ["firstnames" => $this->faker->firstName];
        $correctPersonData = ["firstnames" => $this->faker->firstName, "lastname" => $this->faker->lastName];
        
        $response = $this->postJson('/api/person', $wrongPersonData);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['lastname']);
        
        $response = $this->postJson('/api/person', $correctPersonData);
        $response->assertSuccessful();
    }
    
    /**
     * @test
     * POST 'api/person'
     */
    public function relate_family_to_person()
    {
        $person = Person::factory()->create();
        $family = Family::factory()->create();
        
        $url = '/api/person/'.$person->id.'/relate-family';
        $response = $this->postJson($url, ["child_from_family_id" => $family->id]);
        $response->assertSuccessful();
    }

    /**
     * @test
     * PUT 'api/person/{id}'
     */
    public function update_person()
    {
        $person = Person::factory()->create();
        $wrongPersonData = [
            "firstnames" => $this->faker->firstName
        ];
        
        $url = '/api/person/'.$person->id;

        $response = $this->putJson($url, $wrongPersonData);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['lastname']);
        
        $correctPersonData = [
            "firstnames" => $this->faker->firstName,
            "lastname" => $this->faker->lastName
        ];

        $response = $this->putJson($url, $correctPersonData);
        $response->assertSuccessful();
    }
    
    /**
     * @test
     * PUT 'api/person/{id}'
     */
    public function delete_person()
    {
        $person = Person::factory()->create();

        $url = '/api/person/'.$person->id;
        $response = $this->delete($url);
        
        $response->assertSuccessful();
        $this->assertEmpty(Person::all());
    }
}
