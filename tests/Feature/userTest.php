<?php

namespace Tests\Feature;

use App\Models\Student;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class userTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_user_can_be_added()
    {
        $student = Student::factory()->create();
        $this->post('/add-student',$student->toArray());
        $this->assertDatabaseHas('students',$student->toArray());
    }

    public function test_user_can_be_edited()
    {
        $student = Student::factory()->create();
        $student['email'] == "demo";
        $this->post('/edit-student',$student->toArray());

        $this->assertDatabaseHas('students',$student->toArray());
    }
    public function test_user_can_be_deleted()
    {
        $student = Student::factory()->create();
        $this->get('/delete-student/'.$student['id'],$student->toArray());

        $this->assertDatabaseMissing('students',$student->toArray());
    }
}
