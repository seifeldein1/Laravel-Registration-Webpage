<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class SignupFeatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    
     // 1) test register status
    public function test_example(): void
    {
        $response = $this->get('/signup');

        $response->assertStatus(200);
    }
    


    // 2) Test user insertion into database.
    public function testUserInsertionIntoDatabase()
    {
        try{
        $photo = UploadedFile::fake()->image('2.jpg');
        $response = $this->post('/signup', [
            'full_name' => 'NAholaa',
            'user_name' => 'NAholaa',
            'birthday' => '2003-02-01',
            'phone' => '01146910628',
            'address' => 'Ain Shams',
            'password' => 'nahla@2003', 
            'confirm_password' => 'nahla@2003',
            'email' => 'nahla@gmail.com',
            'photo' => $photo,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('Rejs', ['user_name' => 'NAholaa']);
    }
    catch (\Exception $e) {
        // Log or dump the exception to debug the error
        $this->fail('Error occurred: ' . $e->getMessage());
    }
    }
    
}
