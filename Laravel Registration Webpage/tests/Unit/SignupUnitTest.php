<?php

namespace Tests\Unit;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SignupUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    // 3) test user form validation
    public function test_form_validation(){
        $photo = UploadedFile::fake()->image('2.jpg');
        $response = $this->post('/signup', [
            'full_name' => 'Nahla02',
            'user_name' => 'Nahla02',
            'birthday' => '2003-02-01',
            'phone' => '01146910628',
            'address' => 'Ain Shams',
            'password' => 'nahla@2003', 
            'confirm_password' => 'nahla@2003',
            'email' => 'nahla@gmail.com',
            'photo' => $photo,
        ]);
        $response->assertSessionHasNoErrors();
    }

        // 4) test user form validation error
        public function test_form_validation_error(){
            $photo = UploadedFile::fake()->image('2.jpg');
            $response = $this->post('/signup', [
                'full_name' => '',   // full_name is required
                'user_name' => 'Nahla03',
                'birthday' => '2003-02-01',
                'phone' => '01146910628',
                'address' => 'Ain Shams',
                'password' => 'nahla',  //invalid password
                'confirm_password' => 'nahla',  
                'email' => 'nahla2003', //invalid email
                'photo' => $photo,
            ]);
            $response->assertSessionHasErrors(['full_name','password','email']);
        }

        // 5) Test DB Missing
        public function testDatabaseMissingData()
        {
            $this->assertDatabaseMissing('rejs', [
                'full_name' => 'Sayed'
            ]);
        }
}
