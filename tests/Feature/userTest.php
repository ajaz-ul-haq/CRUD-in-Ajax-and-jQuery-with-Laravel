<?php

namespace Tests\Feature;

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
        $this->post('/add-student',[
            'name'=>'AjazUlHaq',
            'email'=>'demo@email.com',
            'phone'=>'9055713253'
        ]);

        $this->assertDatabaseHas('students',[
            'name'=>'AjazUlHaq',
            'email'=>'demo@email.com',
            'phone'=>'9055713253'
        ]);
    }

    public function test_user_can_be_edited()
    {
        $this->post('/edit-student',[
            'edit_id'=>1,
            'edit_name'=>'Mehran',
            'edit_email'=>'demo@email.com',
            'edit_phone'=>'9055713253'
        ]);

        $this->assertDatabaseHas('students',[
            'name'=>'Mehran',
            'email'=>'demo@email.com',
            'phone'=>'9055713253'
        ]);
    }
}
